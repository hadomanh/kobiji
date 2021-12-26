<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Subject;
use Illuminate\Http\Request;

class LessonController extends Controller
{

    public function __construct() {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Subject $subject)
    {
        return view('lesson.create')->with(compact('subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Subject $subject)
    {
        $lesson = new Lesson();
        $lesson->title = $request->title;
        $lesson->date = $request->date;
        $lesson->from = $request->from;
        $lesson->to = $request->to;
        $lesson->subject()->associate($subject);
        $lesson->save();
        $lesson->refresh();

        foreach ($subject->students as $student) {
            $lesson->students()->attach($student->id, [
                'status' => 'PRESENT',
            ]);
        }

        return redirect()->route('subjects.show', $subject->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->subject()->dissociate();
        $lesson->delete();
    }

    public function attendance(Lesson $lesson) {
        return view('lesson.attendance-detail')->with(compact('lesson'));
    }

    public function attendaceSubmit(Request $request, Lesson $lesson) {
        
        $students = array();
        
        foreach ($request->students as $student) {
            $students[$student['id']] = [
                'status' => $student['status'],
            ];
        }
        $lesson->students()->sync($students);

        return redirect()->route('subjects.show', $lesson->subject->id);
    }

}
