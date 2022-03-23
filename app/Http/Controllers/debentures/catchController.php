<?php

namespace App\Http\Controllers\debentures;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Debenture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class catchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::where('type', 'supplier')->get();
        return view('debentures.catch.create', [
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
            'type' => 'catch',
        ]);
        $client = Client::where('id', $request->client_id)->first();
        $account = $client->account - $request->amount;
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
        //
    }
    protected function rules()
    {
        return [
            'amount' => ['required', 'min:0.5'],
            'client_id' => ['required'],

        ];
    }
}
