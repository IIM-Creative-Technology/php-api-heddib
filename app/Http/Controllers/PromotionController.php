<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Promotion::all());
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
        // Validation des champs
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'end_year' => 'required|integer'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $name = $request->name;
        $end_year = $request->end_year;

        $promotion = Promotion::where(['name' => $name], ['end_year', $end_year])->first();

        if($promotion)
            return response()->json('Promotion already exists!', 400);

        return response()->json(Promotion::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promotion = Promotion::find($id);

        if(!$promotion)
            return response()->json('Promotion not found!', 404);

        // with() permet d'ajouter la liste des étudiants
        return response()->json($promotion->with('students')->get());
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
        $promotion = Promotion::find($id);

        if(!$promotion)
            return response()->json('Promotion not found!', 404);

        // Validation des champs
        $validator = Validator::make($request->all(), [
            'end_year' => 'integer'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $promotion->update($request->all());

        return response()->json($promotion);
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
