<?php

namespace App\Http\Controllers\definition;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clients = Client::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(5);

        return view('definition.clientIndex', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.clientCreate', [
            'client' => new Client(),
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
        Client::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'place' => $request->place,
            'gender' => $request->gender,
            'type' => $request->type,
            'user_id' => Auth::id(),
            'description' => $request->description,

        ]);
        return redirect()->route('definition.index')->withSuccessMessage('تم اضافة العميل بنجاح');
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
        $client = Client::findOrFail($id);
        return view('definition.clientEdit', [
            'client' => $client,
        ]);
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
        $rules = $this->rules();
        $request->validate($rules);
        $client = Client::findOrFail($id);
        $client->update($request->all());
        return redirect()->route('definition.index')->withSuccessMessage('تم تعديل العميل بنجاح');
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

        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('definition.index')->withSuccessMessage('تم حذف العميل بنجاح');
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            // 'phone' => ['nullable',  'max:13'],
            'place' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],

        ];
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $clients = Client::where('user_id', Auth::id())
            ->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('account', 'LIKE', "%{$search}%");
            })
            ->paginate(5);
        return view('definition.clientIndex', [
            'clients' => $clients
        ]);
    }
}
