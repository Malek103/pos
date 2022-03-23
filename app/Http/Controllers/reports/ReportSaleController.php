<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\fReceipt;
use App\Models\hReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nowtime = now();
        if ($request->startDate == null) {

            $request->startDate = '1980-01-01';
        }
        if ($request->endDate == null) {
            $request->endDate = $nowtime;
        }
        $fheceipts = hReceipt::where('type', 'sale')
            ->where('user_id', Auth::id())
            ->where('created_at', '>=', $request->startDate)
            ->where('created_at', '<=',  $request->endDate)
            ->orderBy('created_at', 'desc')->paginate(5);

        return view('reports.sales.index', [
            'fheceipts' => $fheceipts,
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hreceipts = hReceipt::find($id);
        $freceipts = fReceipt::where('header_id', $id)->get();
        return view('reports.sales.show', [
            'hreceipts' => $hreceipts,
            'freceipts' => $freceipts,
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
        //
        // $client = Client::where('name', 'LIKE', "%{$search}%")->first();
        // $test=hReceipt::where('client_id',)
        // dd($client->id);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $fheceipts = hReceipt::where('type', 'sale')
            ->where('user_id', Auth::id())
            ->where(function ($q) use ($search) {
                $q->where('total', 'LIKE', "%{$search}%")
                    ->orWhere('client_id', 'LIKE', "%{$search}%");
            })
            ->paginate(5);
        return view('reports.sales.index', [
            'fheceipts' => $fheceipts,
        ]);
    }
}
