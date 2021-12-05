<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    private $perPage = 5;
    private $subject;

    public function __construct(Subject $subject) {
        $this->subject = $subject;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::orderBy('updated_at', 'desc')->paginate($this->perPage);
        return view('subject.index')->with(compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->code = $request->code;
        $subject->teacher = $request->teacher;
        $subject->target = $request->teacher;
        $subject->session = $request->session;
        $subject->to = $request->to;
        $subject->from = $request->from;
        $subject->description = $request->description;
        $subject->limit = $request->limit;
        
        $subject->save();

        return redirect()->route('subjects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('subject.show')->with(compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subject.edit')->with(compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $subject->name = $request->name;
        $subject->code = $request->code;
        $subject->teacher = $request->teacher;
        $subject->target = $request->target;
        $subject->session = $request->session;
        $subject->to = $request->to;
        $subject->from = $request->from;
        $subject->description = $request->description;
        $subject->limit = $request->limit;
        $subject->midterm = $request->midterm;
        $subject->endterm = $request->endterm;
        
        $subject->save();

        return redirect()->route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->subject->findOrFail($id)->delete();
    }

    public function registration() {
        $subjects = Subject::orderBy('updated_at', 'desc')->paginate($this->perPage);
        return view('subject.registration')->with(compact('subjects'));
    }

    public function registrationDetail(Subject $subject) {
        $students = User::where('role', 'student')->where('active', true)->get();
        return view('subject.registration-detail')->with(compact('subject', 'students'));
    }

    public function registrationSubmit(Request $request, Subject $subject) {
        $students = $request->students;
        $subject->students()->sync($students);
        return redirect()->route('subjects.registration');
    }

    public function grading() {
        $subjects = Subject::orderBy('updated_at', 'desc')->paginate($this->perPage);
        return view('subject.grading')->with(compact('subjects'));
    }

    public function gradingDetail(Subject $subject) {
        $students = $subject->students()->get();
        return view('subject.grading-detail')->with(compact('subject', 'students'));
    }

    public function gradingSubmit(Request $request, Subject $subject) {
        $students = array();
        
        foreach ($request->students as $student) {
            $students[$student['id']] = [
                'midterm' => $student['midterm'],
                'endterm' => $student['endterm'],
            ];
        }
        $subject->students()->sync($students);
        
        return redirect()->route('subjects.grading');
    }
}
