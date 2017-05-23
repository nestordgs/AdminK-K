<?php

namespace App\Http\Controllers;

use Mockery\Matcher\Type;
use Validator;
use App\TypeWork;
use Illuminate\Http\Request;

class TypeWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeWork = TypeWork::all();

        return response()->json($typeWork);
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
            'name' => 'required|max:100|string',
            'abbreviation' => 'required|max:8|min:3|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $typeWork = new TypeWork();

        $typeWork->name = $request->get('name');
        $typeWork->abbreviation = $request->get('abbreviation');

        $typeWork->save();

        return response()->json('Type Work Created', 201);

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
        $typeWork = TypeWork::find($id);

        if (count($typeWork) == 0) {
            return response()->json('Type Work doesn\'t exist', 422);
        }

        return response()->json($typeWork, 200);
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
            'name' => 'required|max:100|string',
            'abbreviation' => 'required|max:8|min:3|string',
            'active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $typeWork = TypeWork::find($id);

        $typeWork->name = $request->get('name');
        $typeWork->abbreviation = $request->get('abbreviation');
        $typeWork->active = $request->get('active');

        $update = $typeWork->save();

        if (!$update) {
            return response()->json('Something Went Wrong', 422);
        }


        return response()->json('Type Work went updated successfully', 200);

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
