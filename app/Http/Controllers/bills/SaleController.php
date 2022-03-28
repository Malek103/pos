<?php

namespace App\Http\Controllers\bills;

use App\Models\Client;
use App\Models\Product;
use App\Models\fReceipt;
use App\Models\hReceipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        dd('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status', 'active')
            ->where('favare', '1')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')->paginate(8);
        $clients = Client::where('type', 'customer')->where('user_id',Auth::id())->get();
        return view('bills.sale.create', [
            'products' => $products,
            'clients' => $clients,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account = $request->total - $request->discount;
        if ($request->get('client_id') != null) {
            $clinet = Client::where('id', $request->client_id)->first();
            $currentclient = $clinet->account - $account;
            $clinet->update(['account' => $currentclient]);
        }
        $h_receipt = hReceipt::create([
            'id' => $request->id,
            'user_id' => Auth::id(),
            'name' => 'pos',
            'client_id' => $request->client_id,
            'type' => 'sale',
            'total' => $request->total,
            'discount' => $request->discount,

        ]);
        foreach ($request->itemArr as $key => $value) {
            $f_receipt = new fReceipt();

            $f_receipt->product_id = $value['id'];
            $f_receipt->price = $value['price'];
            $f_receipt->cost = $value['cost'];
            $f_receipt->quantity = $value['qty'];
            $f_receipt->profit = ($value['price'] * $value['qty']) - ($value['cost'] * $value['qty']);
            $totalCost = $value['cost'] * $value['qty'];
            $totalPrice = $value['price'] * $value['qty'];
            $totalProfit = $totalPrice - $totalCost;

            $product = Product::where('id', $value['id'])->first();

            $productProfit = $product->profits + $totalProfit;
            $productSold = $product->sold + $value['qty'];
            $totalQty = $product->quantity - $value['qty'];
            $product->update(['quantity' => $totalQty, 'sold' => $productSold, 'profits' => $productProfit]);
            $h_receipt->fReceipts()->save($f_receipt);
            $hprofit =  $f_receipt->profit;
            $f_receipt->header->increment('profit',$hprofit);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function chart()
    {
        return hReceipt::where('type', 'sale')
            ->where('client_id', null)
            ->get();
    }
}
