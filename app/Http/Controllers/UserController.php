<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', [
            "pageTitle" => "Home",
            'items' => Item::paginate(4)
        ]);
    }

    public function view()
    {
        return view('user.view', [
            "pageTitle" => "View Furniture",
            'items' => Item::paginate(4)
        ]);
    }

    public function profile()
    {
        return view('user.profile', [
            "pageTitle" => "Profile"
        ]);
    }

    public function updateProfilePage()
    {
        return view('user.updateProfile', [
            "pageTitle" => "Update Profile"
        ]);
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;

        $user = User::find($id);

        Validator::make($request->all(), [
            'name' => ['required', 'regex:/^[a-zA-Z\s]*$/', 'max:15', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email:dns', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'min:5', 'max:20'],
            'address' => ['required', 'min:5', 'max:95'],
            'gender' => ['required']
        ])->validate();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->address = $request->address;
        $user->gender = $request->gender;

        $user->password = Hash::make($user->password);

        $user->save();

        return redirect('/user/profile')->with('updateMessage', 'Your data has been updated!');
    }

    public function search(Request $request)
    {
        $items = Item::where('name', 'like', '%' . $request->searchQuery . '%')->paginate(4);
        $items->appends(['searchQuery' => $request->searchQuery]);
        return view('user.view', [
            "pageTitle" => "View Furniture",
            "items" => $items
        ]);
    }

    public function itemDetail(Item $item)
    {
        return view('user.detail', [
            "pageTitle" => $item->name,
            "item" => $item
        ]);
    }

    public function cartPage()
    {
        return view('user.cart', [
            'pageTitle' => 'Cart'
        ]);
    }

    public function checkOutPage()
    {
        return view('user.checkout', [
            'pageTitle' => "Checkout"
        ]);
    }

    public function addToCart(Item $item)
    {
        $cart = Session::get('cart');
        $i = 0;
        $present = false;

        if ($cart === null) {
            $cart = [
                'userID' => Auth::user()->id,
                'itemID' => $item->id,
                'name' => $item->name,
                'quantity' => 1,
                'image' => $item->image,
                'price' => $item->price
            ];
            $i++;
            Session::push('cart', $cart);
        } else {
            for ($i = 0; $i < count($cart); $i++) {
                if ($cart[$i]['itemID'] === $item->id) {
                    $cart[$i]['quantity']++;
                    Session::put('cart', $cart);
                    Session::save();
                    $present = true;
                }
            }
            if (!$present) {
                $cart = [
                    'userID' => Auth::user()->id,
                    'itemID' => $item->id,
                    'name' => $item->name,
                    'quantity' => 1,
                    'image' => $item->image,
                    'price' => $item->price
                ];
                $i++;
                Session::push('cart', $cart);
            }
        }
        return redirect()->back()->with('itemAddedMessage', 'Item has been added to your cart!');
    }

    public function addQty($id)
    {
        $cart = Session::get('cart');

        $cart[$id]['quantity']++;

        Session::put('cart', $cart);
        Session::save();

        return redirect()->back();
    }

    public function minQty($id)
    {
        $cart = Session::get('cart');

        if ($cart[$id]['quantity'] === 1) {
            unset($cart[$id]);
        } else {
            $cart[$id]['quantity']--;
        }

        Session::put('cart', $cart);
        Session::save();

        return redirect()->back();
    }

    public function checkOut(Request $request)
    {
        $transaction = new Transaction();

        Validator::make($request->all(), [
            'payment' => 'required',
            'cardNumber' => ['required', 'numeric', 'digits:16']
        ])->validate();

        $cart = Session::get('cart');

        $transaction->user_id = Auth::user()->id;
        $transaction->transactionDate = Carbon::now()->toDateTimeString();
        $transaction->transactionMethod = $request->payment;
        $transaction->cardNumber = $request->cardNumber;
        $transaction->save();

        for ($i = 0; $i < count($cart); $i++) {
            $detail = new TransactionDetail();
            $detail->transaction_id = $transaction->id;
            $detail->item_id = $cart[$i]['itemID'];
            $detail->quantity = $cart[$i]['quantity'];
            $detail->save();
        }

        Session::forget('cart');

        return redirect('/user')->with('checkOutSuccess', 'Thank you for shopping with us! Your transaction has been confirmed!');
    }

    public function history()
    {
        $transactions = Transaction::where('user_id', '=', Auth::user()->id)
            ->with('transactionDetails')
            ->get();

        return view('user.history', [
            'pageTitle' => "Transaction History",
            'transactions' => $transactions,
            'items' => Item::all()
        ]);
    }
}
