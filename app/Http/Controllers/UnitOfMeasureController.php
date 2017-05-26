<?php

namespace App\Http\Controllers;

use Validator;
use App\UnitOfMeasure;
use Illuminate\Http\Request;

class UnitOfMeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unites= UnitOfMeasure::all();

        return response()->json($unites);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|string',
            'abbreviation' => 'required|max:8|min:2|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $unite = new UnitOfMeasure();

        $unite->name = $request->get('name');
        $unite->abbreviation = $request->get('abbreviation');

        $unite->save();

        return response()->json('Unite Of Measure Created', 201);

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
        $unite = UnitOfMeasure::find($id);

        if (count($unite) == 0) {
            return response()->json('Unite of Measure doesn\'t exist', 422);
        }

        return response()->json($unite, 200);
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
            'abbreviation' => 'required|max:8|min:2|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $unite = UnitOfMeasure::find($id);

        $unite->name = $request->get('name');
        $unite->abbreviation = $request->get('abbreviation');

        $update = $unite->save();

        if (!$update) {
            return response()->json('Something Went Wrong',422);
        }

        return response()->json('Unite of Measure went updated successfully', 200);

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
