<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'pageTitle' => "Admin Home",
            'items' => Item::paginate(4)
        ]);
    }

    public function view()
    {
        return view('admin.view', [
            'pageTitle' => "View Furniture",
            'items' => Item::paginate(4)
        ]);
    }

    public function profile()
    {
        return view('admin.profile', [
            'pageTitle' => "Profile"
        ]);
    }

    public function updateProfilePage()
    {
        return view('admin.updateProfile', [
            'pageTitle' => 'Update Profile'
        ]);
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;

        $user = User::find($id);

        Validator::make($request->all(), [
            'name' => ['required', 'regex:/^[a-zA-Z\s]*$/', 'max:15', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email:dns', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'min:5', 'max:20']
        ])->validate();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->password = Hash::make($user->password);

        $user->save();

        return redirect('/admin/profile')->with('updateMessage', 'Your data has been updated!');
    }

    public function viewAddItem()
    {
        $newItem = Item::all();
        return view('/admin/addItem', [
            'pageTitle' => 'Add Item'
        ]);
    }

    public function addItem(Request $request)
    {
        $item = new Item();

        Validator::make($request->all(), [
            'name' => ['required', 'unique:items', 'max:15'],
            'price' => ['required', 'numeric', 'min:5000', 'max:10000000'],
            'type' => ['required'],
            'color' => ['required'],
            'image' => ['required', 'mimes:jpeg,png,jpg']
        ])->validate();

        $storeImage = $request->file('image');
        $image = $storeImage->getClientOriginalName();
        Storage::putFileAs('public/images', $storeImage, $image);
        $image = 'images/' . $image;

        $item->name = $request->name;
        $item->price = $request->price;
        $item->type = $request->type;
        $item->color = $request->color;
        $item->image = $image;

        $item->save();
        return redirect()->back()->with('addMessage', 'Item has been added!');
    }

    public function search(Request $request)
    {
        $items = Item::where('name', 'like', '%' . $request->searchQuery . '%')->paginate(4);
        $items->appends(['searchQuery' => $request->searchQuery]);
        return view('admin.view', [
            "pageTitle" => "View Furniture",
            "items" => $items
        ]);
    }

    public function itemDetail(Item $item)
    {
        return view('admin.detail', [
            "pageTitle" => $item->name,
            "item" => $item
        ]);
    }

    public function updateItemPage(Item $item)
    {
        return view('admin.updateitem', [
            'pageTitle' => "Update Item",
            'item' => $item
        ]);
    }

    public function updateItem(Request $request, Item $item)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'max:15', Rule::unique('items')->ignore($item->id)],
            'price' => ['required', 'numeric', 'min:5000', 'max:10000000'],
            'type' => ['required'],
            'color' => ['required'],
            'image' => ['mimes:jpeg,png,jpg']
        ])->validate();

        $storeImage = $request->file('image');
        // $itemID = Item::find($item->id);

        if ($item->name  != null || $item->price != null || $item->type != null || $item->color != null) {
            $item->name = $request->name;
            $item->price = $request->price;
            $item->type = $request->type;
            $item->color = $request->color;
        } else {
            $item->name;
            $item->price;
            $item->type;
            $item->color;
        }

        if ($storeImage != NULL) {
            $image = $storeImage->getClientOriginalName();
            Storage::putFileAs('public/images', $storeImage, $image);
            $image = 'images/' . $image;
            $item->image = $image;
        } else {
            $item->image = $item->image;
        }

        $item->save();
        return redirect('/admin')->with('updateItem', 'Item has been updated!');
    }

    public function deleteItem(Item $item)
    {
        if (isset($item)) {
            Storage::delete('public/images' . $item->image);
            $item->delete();
        }

        return redirect('/admin')->with('deleteMessage', 'Item has been deleted');
    }

    public function history()
    {
        $transactions = Transaction::with('transactionDetails')->get();
        $users = User::with('transactions')->get();

        return view('admin.history', [
            'pageTitle' => "Transaction History",
            'transactions' => $transactions,
            'items' => Item::all(),
            'users' => $users
        ]);
    }
}
