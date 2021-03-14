<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Intervenant;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Course::with(['intervenant', 'promotion'])->get());
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
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'intervenant_id' => 'required|integer',
            'promotion_id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $intervenant = Intervenant::find($request->intervenant_id);

        if(!$intervenant)
            return response()->json('Intervenant not found!', 404);

        $promotion = Promotion::find($request->promotion_id);

        if(!$promotion)
            return response()->json('Promotion not found!', 404);

        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        if($start_date->diffInDays($end_date) >= 5)
            return response()->json('The two given dates are too far apart', 400);

        return response()->json(Course::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Récupère le cours avec l'intervenant et la promotion
        $course = Course::where('id', $id)->with(['intervenant', 'promotion'])->first();

        if(!$course)
            return response()->json('Course not found!', 404);

        return response()->json($course);
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
        $course = Course::where('id', $id)->with(['intervenant', 'promotion'])->first();

        if(!$course)
            return response()->json('Course not found!', 404);

        // Validation des champs
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'start_date' => 'date',
            'end_date' => 'date',
            'intervenant_id' => 'integer',
            'promotion_id' => 'integer'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $intervenant = Intervenant::find($request->intervenant_id);

        if(!$intervenant && $request->intervenant_id)
            return response()->json('Intervenant not found!', 404);

        $promotion = Promotion::find($request->promotion_id);

        if(!$promotion && $request->promotion_id)
                return response()->json('Promotion not found!', 404);

        // Vérification des dates (5 jours max)
        $start_date = $request->start_date ? Carbon::parse($request->start_date) : Carbon::parse($course->start_date);
        $end_date = $request->end_date ? Carbon::parse($request->end_date) : Carbon::parse($course->end_date);

        if($start_date->diffInDays($end_date) >= 5)
            return response()->json('The two given dates are too far apart', 400);

        $course->update($request->all());
        // On appelle la méthode refresh pour rafraîchir le model, car la relation ne s'actualise pas directement
        $course->refresh();

        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if(!$course)
            return response()->json('Course not found!', 404);

        return response()->json($course->delete());
    }
}
