<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('guesthome', [
            'pageTitle' => "Home",
            'items' => Item::paginate(4)
        ]);
    }

    public function view()
    {
        return view('view', [
            'pageTitle' => "View Furniture",
            'items' => Item::paginate(4)
        ]);
    }

    public function detail(Item $item)
    {
        return view('detail', [
            'pageTitle' => $item->name,
            'item' => $item
        ]);
    }

    public function search(Request $request)
    {
        $items = Item::where('name', 'like', '%' . $request->searchQuery . '%')->paginate(4);
        $items->appends(['searchQuery' => $request->searchQuery]);
        return view('view', [
            "pageTitle" => "View Furniture",
            "items" => $items
        ]);
    }
}
