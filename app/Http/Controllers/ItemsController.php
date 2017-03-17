<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Fave;
use Auth;
use App\Category;
use DB;

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
        Item::where('id','=',$request->id)->where('user_id','=',Auth::user()->id)->delete();
    }

    public function faveItem(Request $request) {
        if ($item = Item::find($request->id)->get()) {
            return Fave::firstOrCreate(
                [
                    'item_id' => $request->id,
                    'user_id' => Auth::user()->id
                ]);
        }
    }

    public function unfaveItem(Request $request) {
        if ($fave = Fave::find($request->id)) {
             $fave->delete();
                 return true;
        }
        return false;
    }


    public function showUserHome() {
        return view('welcome');
    }

    public function showItemsPage(Request $request, $subdomain, $category = null) {

        if ($category = Category::where('slug','=',$category)->first()) {
            return view('pages/items')->with('category',$category);
        }

        return view('pages/items')->with('error','Invalid category');

    }

    public function showUserItems(Request $request, $subdomain, $category = null) {

        if ($category) {
            if ($category = Category::where('slug','=',$category)->first()) {
                return  Item::with('category')
                    ->where('category_id','=',$category->id)
                    ->where('user_id','=',$request->selected_account->id)->get();
            }
        } else {
                return  Item::with('category')
                    ->where('user_id','=',$request->selected_account->id)->get();
            
        }


    }

    public function showUserFaves() {
        return Auth::user()->faves;
    }

    public function showUserFavesPage() {
            return view('faves');
    }


}
