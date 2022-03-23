<?php

namespace App\Http\Controllers\debentures;

use App\Models\Client;
use App\Models\Debenture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReceipthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debentures = Debenture::where('status', 'notdeleted')
            ->where('user_id', Auth::id())
            ->paginate(5);
        return view('debentures.index', [
            'debentures' => $debentures,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::where('type', 'customer')->get();
        return view('debentures.receipt.create', [
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
        $rules = $this->rules();
        $request->validate($rules);
        Debenture::create([
            'user_id' => Auth::id(),
            'client_id' => $request->client_id,
            'amount' => $request->amount,
            'type' => 'receive',
        ]);
        $client = Client::where('id', $request->client_id)->first();
        $account = $client->account + $request->amount;
        $client->update(['account' => $account]);
        return redirect()->route('receipt.index')->withSuccessMessage('تم اضافة السند بنجاح');
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
        $debenture = Debenture::findOrFail($id);
        if ($debenture->type === 'receive') {
            $amount = $debenture->client->account - $debenture->amount;
        } else if ($debenture->type === 'catch') {
            $amount = $debenture->client->account + $debenture->amount;
        }

        $client = Client::where('id', $debenture->client_id)->first();

        $client->update(['account' => $amount]);
        $debenture->update(['status' => 'deleted']);
        return redirect()->route('receipt.index')->withSuccessMessage('تم حذف السند بنجاح');
    }
    public function showDelete()
    {
        $debentures = Debenture::where('status', 'deleted')->paginate(5);
        return view('debentures.index', [
            'debentures' => $debentures,
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $debentures = Debenture::where('status', 'notdeleted')
            ->where(function ($q) use ($search) {
                $q->where('amount', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%");
            })
            ->paginate(5);
        return view('debentures.index', [
            'debentures' => $debentures,
        ]);
    }
    protected function rules()
    {
        return [
            'amount' => ['required', 'min:0.5'],
            'client_id' => ['required'],

        ];
    }
}
