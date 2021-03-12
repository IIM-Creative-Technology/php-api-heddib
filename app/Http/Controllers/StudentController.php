<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Student::all());
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
            'age' => 'required|integer',
            'arrival_year' => 'required|integer',
            'promotion_id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $promotion = Promotion::find($request->promotion_id);

        if(!$promotion)
            return response()->json('Promotion not found!', 404);

        return response()->json(Student::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Récupère l'étudiant avec sa promotion
        $student = Student::where('id', $id)->with('promotion')->first();

        if(!$student)
            return response()->json('Student not found!', 404);

        return response()->json($student);
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
        $student = Student::where('id', $id)->with('promotion')->first();

        if(!$student)
            return response()->json('Student not found!', 404);

        // Validation des champs
        $validator = Validator::make($request->all(), [
            'firstname' => 'string',
            'lastname' => 'string',
            'age' => 'integer',
            'arrival_year' => 'integer',
            'promotion_id' => 'integer'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $promotion = Promotion::find($request->promotion_id);

        if(!$promotion && $request->promotion_id)
            return response()->json('Promotion not found!', 404);

        $student->update($request->all());
        // On appelle la méthode refresh pour rafraîchir le model, car la relation ne s'actualise pas directement
        $student->refresh();

        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        if(!$student)
            return response()->json('Student not found!', 404);

        return response()->json($student->delete());
    }
}
