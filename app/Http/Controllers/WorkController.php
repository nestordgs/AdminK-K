<?php

namespace App\Http\Controllers;

use Validator;
use App\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work = Work::with('typeWork', 'uniteOfMeasure')->get();

        return response()->json($work);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'direct_cost' => 'required|numeric',
            'admin_cost' => 'numeric',
            'utility' => 'numeric',
            'type_work' => 'required|integer',
            'unit_of_measure' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $work = new Work();

        $work->description = $request->get('description');
        $work->direct_cost = $request->get('direct_cost');
        $work->admin_cost = Work::calculateAdminCost($request->get('direct_cost'));
        $work->utility = Work::calculateUtility($request->get('direct_cost'));
        $work->type_work_id = $request->get('type_work');
        $work->unit_of_measure_id = $request->get('unit_of_measure');

        $work->save();

        return response()->json('Work created',201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $work = Work::with('typeWork', 'uniteOfMeasure')->find($id);

        if (count($work) == 0) {
            return response()->json('Client doesn\'t exist', 422);
        }

        return response()->json($work,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'direct_cost' => 'required|numeric',
            'admin_cost' => 'numeric',
            'utility' => 'numeric',
            'type_work' => 'required|integer',
            'unit_of_measure' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $work = Work::find($id);

        $work->description = $request->get('description');
        $work->direct_cost = $request->get('direct_cost');
        $work->admin_cost = Work::calculateAdminCost($request->get('direct_cost'));
        $work->utility = Work::calculateUtility($request->get('direct_cost'));
        $work->type_work_id = $request->get('type_work');
        $work->unit_of_measure_id = $request->get('unit_of_measure');

        $work->save();

        return response()->json('Work went updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
