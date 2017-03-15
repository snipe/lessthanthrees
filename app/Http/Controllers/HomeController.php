<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fave;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $faves = Fave::all();
        return $faves;
    }

    public function storeItem(Request $request) {
        $data = new Fave();
        $data->name = $request->name;
        $data->user_id = Auth::user()->id;
        $data->save();
        return $data;
    }

    public function deleteItem(Request $request) {
        Fave::find ( $request->id )->delete ();
    }
}
