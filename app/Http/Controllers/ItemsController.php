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
        $items = Item::with('category')
            ->where('user_id','=',Auth::user()->id)->orderBy('items.created_at','DESC')->get();
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
        if ($fave = Fave::where('item_id','=',$request->id)->where('user_id','=',Auth::user()->id)) {
             $fave->delete();
                 return 'true';
        }
        return 'false';
    }


    public function showUserHome(Request $request) {
        $categoryCount = DB::table('items')
          ->join('categories', 'items.category_id', '=', 'categories.id')
          ->where('user_id', '=', $request->selected_account->id)
          ->select('categories.name', DB::raw('count(*) as total'))
          ->groupBy('categories.name')
          ->orderBy('total', 'DESC')
          ->pluck('total','categories.name')->all();

        $categories = Category::all();

        return view('welcome', ['categoryCounts' => $categoryCount, 'categories' => $categories]);
    }

    public function showItemsPage(Request $request, $subdomain, $category = null) {

        if ($category = Category::where('slug','=',$category)->first()) {
            return view('pages/items')->with('category',$category);
        }

        return view('pages/items')->with('error','Invalid category');

    }

    public function showUserItems(Request $request, $subdomain, $category = null) {

        $items_array = array();
        $items = Item::with('category','faves');

        if ($category) {
            if ($category = Category::where('slug','=',$category)->first()) {
                $items = $items->where('category_id','=',$category->id);
            }
        }

        $items = $items->where('user_id','=',$request->selected_account->id)
            ->orderBy('items.created_at','DESC')
            ->get();

        $counter = 0;

        foreach ($items as $item) {
            $items_array[$counter]['id'] = $item->id;
            $items_array[$counter]['name'] = $item->name;
            $items_array[$counter]['liked'] = false;
            $items_array[$counter]['text'] = 'like';
            
            foreach ($item->faves as $faves) {
                if (Auth::check() && ($faves->id == Auth::user()->id)) {
                    $items_array[$counter]['liked'] = true;
                    $items_array[$counter]['text'] = 'unlike';
                    break;
                }
            }
            $items_array[$counter]['category'] = $item->category->name;
            $items_array[$counter]['description'] = $item->description;
            $counter++;
        }

        return $items_array;
        
    }

    public function showUserFaves() {
        $faves = Fave::where('user_id','=',Auth::user()->id)->with('items')->get();
        $items_array = array();

        foreach ($faves as $fave) {
            if ($fave->items) {
                $items_array['id'] = $fave->items->id;
                $items_array['name'] = $fave->items->name;
                $items_array['liked'] = true;
                $items_array['category'] = $fave->items->category->name;
                $items_array['description'] = $fave->items->description;
            }

        }

        return $items_array;
    }

    public function showUserFavesPage() {
            return view('faves');
    }


}
