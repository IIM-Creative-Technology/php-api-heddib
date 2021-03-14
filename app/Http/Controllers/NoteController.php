<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Note;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Note::with(['student', 'course'])->get());
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
            'note' => 'required|integer|between:0,20',
            'student_id' => 'required|integer',
            'course_id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $student = Student::find($request->student_id);

        if(!$student)
            return response()->json('Student not found!', 404);

        $course = Course::find($request->course_id);

        if(!$course)
            return response()->json('Course not found!', 404);

        return response()->json(Note::create($request->all()));
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
        $note = Note::where('id', $id)->with(['student', 'course'])->first();

        if(!$note)
            return response()->json('Note not found!', 404);

        return response()->json($note);
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
        $note = Note::where('id', $id)->with(['student', 'course'])->first();

        if(!$note)
            return response()->json('Note not found!', 404);

        // Validation des champs
        $validator = Validator::make($request->all(), [
            'note' => 'required|integer|between:0,20',
            'student_id' => 'required|integer',
            'course_id' => 'required|integer'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $student = Student::find($request->student_id);

        if(!$student && $request->student_id)
            return response()->json('Student not found!', 404);

        $course = Course::find($request->course_id);

        if(!$course && $request->course_id)
                return response()->json('Course not found!', 404);

        $course->update($request->all());
        // On appelle la méthode refresh pour rafraîchir le model, car la relation ne s'actualise pas directement
        $course->refresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);

        if(!$note)
            return response()->json('Note not found!', 404);

        return response()->json($note->delete());
    }
}
