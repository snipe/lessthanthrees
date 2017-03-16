<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Auth;
use App\Category;

class ItemsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function readItems() {
        $items = Item::with('category')->where('user_id','=',Auth::user()->id)->get();
        return $items;
    }

    public function storeItem(Request $request) {
        $data = new Item();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->category_id = $request->category_id;
        $data->user_id = Auth::user()->id;
        $data->save();
        return $data;
    }

    public function deleteItem(Request $request) {
        Item::find($request->id)->where('user_id','=',Auth::user()->id)->delete();
    }


    public function showUserHome() {
        return view('welcome');
    }

    public function showUserItems(Request $request, $subdomain, $category = null) {

        $category = Category::where('slug','=',$category)->first();

        if ($category) {
            $items = Item::with('category')
                ->where('category_id','=',$category->id)
                ->where('user_id','=',$request->selected_account->id)->get();
            return view('pages/items')->with('items',$items)->with('category',$category);
        }

        return view('pages/home')->with('error','Invalid category');

    }
}
