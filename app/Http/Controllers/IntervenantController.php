<?php

namespace App\Http\Controllers;

use App\Models\Intervenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IntervenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Intervenant::all());
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
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'arrival_year' => 'required|integer'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $intervenant = Intervenant::where(['firstname' => $request->firstname, 'lastname' => $request->lastname])->first();

        if($intervenant)
            return response()->json('Intervenant already exists!', 400);

        return response()->json(Intervenant::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Récupère l'intervenant
        $intervenant = Intervenant::find($id);

        if(!$intervenant)
            return response()->json('Intervenant not found!', 404);

        return response()->json($intervenant);
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
        $intervenant = Intervenant::find($id);

        if(!$intervenant)
            return response()->json('Intervenant not found!', 404);

        // Validation des champs
        $validator = Validator::make($request->all(), [
            'firstname' => 'string',
            'lastname' => 'string',
            'arrival_year' => 'integer',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $intervenant->update($request->all());

        return response()->json($intervenant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Même si pas demandé en consigne, je laisse la suppression
        $intervenant = Intervenant::find($id);

        if(!$intervenant)
            return response()->json('Intervenant not found!', 404);

        return response()->json($intervenant->delete());
    }
}
