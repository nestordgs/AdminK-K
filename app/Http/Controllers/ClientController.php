<?php

namespace App\Http\Controllers;

use Validator;
use App\Client;
use App\ClientPhone;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('type_doc')->get();

        return response()->json($clients,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $matches = [];
//        return response()->json($request->only('phones'),200);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|string',
            'id_type_doc' => 'required|numeric',
            'number_rif' => 'required|max:10|min:7|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $client = new Client;

        $client->name = $request->get('name');
        $client->id_type_doc = $request->get('id_type_doc');
        $client->number_rif = $request->get('number_rif');
        $client->address = $request->get('address');
        $client->email = $request->get('email');
        $client->contact = $request->get('contact');

        $client->save();

        if ($request->has('phones')) {

            $phones = json_decode($request->get('phones'));

            foreach ($phones as $phone) {

                if (is_numeric($phone->number)) {
                    $client->phones()->save(new ClientPhone((array) $phone));
                }
            }
        }

        return response()->json('Client created',201);
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
        $client = Client::with('phones')->find($id);

        if (count($client) == 0) {
            return response()->json('Client doesn\'t exist', 422);
        }

        return response()->json($client,200);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|string',
            'id_type_doc' => 'required|numeric',
            'number_rif' => 'required|max:10|min:7|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $client = Client::find($id);

        $client->name = $request->get('name');
        $client->address = $request->get('address');
        $client->contact = $request->get('contact');
        $client->id_type_doc = $request->get('id_type_doc');
        $client->number_rif = $request->get('number_rif');
        $client->email = $request->get('email');

        $saved = $client->save();

        if (!$saved) {
            return response()->json('Something went wrong', 422);
        }

        $phones = json_decode($request->get('phones'));

        foreach ($phones as $phone) {

            if (is_numeric($phone->number)) {

                if (isset($phone->id)){
                    $savePhone = ClientPhone::updateOrCreate(
                        ['id' => $phone->id],
                        ['number' => $phone->number]
                    );
                } else {
                    $client->phones()->save(new ClientPhone((array) $phone));
                }
            }
        }

        return response()->json('Client went updated successfully',200);
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
}
