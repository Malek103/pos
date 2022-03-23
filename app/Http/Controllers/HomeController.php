<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\hReceipt;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->orderBy('sold', 'desc')->limit(5)->get();
        $productsNum = Product::where('user_id', Auth::id())->get()->count();
        $clientsNum = Client::where('user_id', Auth::id())->get()->count();
        $buyingNum = hReceipt::where('type', 'buying')
            ->where('user_id', Auth::id())
            ->get()->count();
        $saleNum = hReceipt::where('type', 'sale')->where('user_id', Auth::id())->get()->count();
        $cash = hReceipt::where('type', 'sale')
            ->where('client_id', null)->get()->where('user_id', Auth::id())->count();
        $debt = hReceipt::where('type', 'sale')->where('user_id', Auth::id())
            ->where('client_id', '<>', null)->get()->count();




        return view('home', [
            'products' => $products,
            'productsNum' => $productsNum,
            'clientsNum' => $clientsNum,
            'buyingNum' => $buyingNum,
            'saleNum' => $saleNum,
            'cash' => $cash,
            'debt' => $debt,
        ]);
    }
}
