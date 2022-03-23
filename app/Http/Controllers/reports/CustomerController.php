<?php

namespace App\Http\Controllers\reports;

use App\Models\Client;
use App\Models\Debenture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::where('type', 'customer')->where('user_id', Auth::id())->paginate(5);
        return view('reports.customers.index', [
            'clients' => $clients,
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
    public function show($id, Request $request)
    {
        $nowtime = now();
        if ($request->startDate == null) {

            $request->startDate = '1980-01-01';
        }
        if ($request->endDate == null) {
            $request->endDate = $nowtime;
        }
        $client = Client::find($id);
        $debentures = Debenture::where('client_id', $id)
            ->where('status', 'notdeleted')
            ->where('created_at', '>=', $request->startDate)->where('created_at', '<=',  $request->endDate)
            ->get();

        return view('reports.customers.show', [
            'client' => $client,
            'h_receipts' => $client->hreceipts->where('created_at', '>=', $request->startDate)->where('created_at', '<=',  $request->endDate),
            'debentures' => $debentures,
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
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $clients = Client::where('type', 'customer')
            ->where('user_id', Auth::id())
            ->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('account', 'LIKE', "%{$search}%");
            })
            ->paginate(5);
        return view('reports.customers.index', [
            'clients' => $clients,
        ]);
    }
}
