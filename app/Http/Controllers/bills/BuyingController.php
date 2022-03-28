<?php

namespace App\Http\Controllers\bills;

use App\Models\Client;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\fReceipt;
use App\Models\hReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Scope;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Console\Input\Input;

class BuyingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipts = hReceipt::where('type', 'buying')->where('status', 'notdeleted')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(5);


        return view('bills.buying.index', [
            'receipts' => $receipts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::where('status','active')->where('user_id',Auth::id())->get();
        $clients = Client::where('type', 'supplier')->where('user_id',Auth::id())->get();

        return view('bills.buying.create', [
            'products' => $products,
            'clients' => $clients
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
        // dd($request->discount);
        $currentAccount = Client::where('id', $request->client_id)->first();
        $account = $currentAccount->account + $request->total;
        $currentAccount->update(['account' => $account]);
        $rules = $this->rules();
        $request->validate($rules);
        $h_receipt = hReceipt::create([
            'id' => $request->id,
            'user_id' => Auth::id(),
            'name' => $request->name,
            'client_id' => $request->client_id,
            'total' => $request->total,
            'discount' => $request->discount,

        ]);
        $total = 0;
        foreach ($request->addmore as $key => $value) {

            $f_receipt = new fReceipt();
            $f_receipt->product_id = $value['product_id'];
            $f_receipt->cost = $value['cost'];
            $f_receipt->quantity = $value['quantity'];
            $h_receipt->fReceipts()->save($f_receipt);
            $f_receipt->product()->update(['cost' => $value['cost']]);
            $newQuantity = $value['quantity'];
            $currentQuantity = Product::select('quantity')
                ->where('id', $value['product_id'])->first();
            $quantity = $currentQuantity->quantity +  $newQuantity;
            $f_receipt->product()->update(['quantity' => $quantity]);
        }
        return redirect()->route('buying.index')->withSuccessMessage('تم اضافة الفاتورة بنجاح');
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
        $f_receipts = fReceipt::where('header_id', $id)->get();
        $h_receipt = hReceipt::where('id', $id)->first();
        return view('bills.buying.show', [
            'f_receipts' => $f_receipts,
            'h_receipt' => $h_receipt,
        ]);
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
        $h_receipt = hReceipt::findOrFail($id);
        $client = Client::where('id', $h_receipt->client_id)->first();
        $h_receipt->update(['status' => 'deleted']);
        $totalAccount = $client->account - $h_receipt->total;

        $client->update(['account' => $totalAccount]);
        $f_receipts = fReceipt::where('header_id', $h_receipt->id)->get();
        foreach ($f_receipts as $key => $value) {
            $quantity = $value->product['quantity'] - $value['quantity'];
            $product = Product::where('id', $value->product['id'])->first();

            $receipts = fReceipt::where('product_id', $value['product_id'])

                ->where('header_id', '<>', $h_receipt->id)

                ->orderBy('created_at', 'desc')
                ->first();

            if (empty($receipts->cost) || $receipts->header->status=='deleted'|| $receipts->header->type=='sale' ) {

                $product->update(['quantity' => $quantity, 'cost' => 0]);
            } else {


                $product->update(['quantity' => $quantity, 'cost' => $receipts->cost]);
            }
        }

        return redirect()->route('buying.index')->withSuccessMessage('تم حذف الفاتورة بنجاح');
    }
    public function showDelete()
    {
        $receipts = hReceipt::where('type', 'buying')->where('status', 'deleted')->where('user_id',Auth::id())->orderBy('updated_at', 'desc')->paginate(5);


        return view('bills.buying.index', [
            'receipts' => $receipts
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $receipts = hReceipt::where('type', 'buying')
            ->where('status', 'notdeleted')
            ->where('user_id',Auth::id())
            ->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('total', 'LIKE', "%{$search}%");
            })
            ->paginate(5);
        return view('bills.buying.index', [
            'receipts' => $receipts
        ]);
    }
    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:255'],

        ];
    }
    public function calendar($date)
    {

        $startDay = Carbon::createFromFormat('Y-d-m', $date)->format('Y-m-d 00:00:00');
        $endDay = Carbon::createFromFormat('Y-d-m', $date)->format('Y-m-d 23:59:59');

        $data =  hReceipt::where('type', 'sale')
        ->where('user_id',Auth::id())
            ->where('created_at', '>=', $startDay)
            ->where('created_at', '<=', $endDay)
            ->get(['total', 'profit']);
        $total = 0;
        $profit = 0;
        foreach ($data as $key => $value) {
            $total += $value['total'];
            $profit += $value['profit'];
        }
        return [$total, $profit];
    }
}
