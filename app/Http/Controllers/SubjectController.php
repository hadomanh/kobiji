<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SubjectController extends Controller
{
    private $perPage = 8;
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
        $subject->target = $request->target;
        $subject->session = $request->session;
        $subject->to = $request->to;
        $subject->from = $request->from;
        $subject->description = $request->description;
        $subject->limit = $request->limit;
        
        $subject->save();
        $subject->refresh();


        for ($i=0; $i < count($request->skill); $i++) { 
            $skill = new Skill();
            $skill->name = $request->skill[$i];
            $skill->type = $request->type[$i];
            $skill->ratio = $request->ratio[$i];
            $skill->subject()->associate($subject);

            $skill->save();
            $skill->refresh();
        }

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

    public function studentShow(Subject $subject)
    {
        if (Auth::user()->role != 'student') {
            return Redirect::back()->withErrors([
                'error' => 'You are not authorized to view this page.'
            ]);
        }
        return view('subject.student-show')->with(compact('subject'));
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

        foreach ($request->skills as $skill) {
            foreach ($subject->skills as $subjectSkill) {
                if ($subjectSkill->id == $skill['id']) {
                    $subjectSkill->name = $skill['name'];
                    $subjectSkill->type = $skill['type'];
                    $subjectSkill->ratio = $skill['ratio'];
                    $subjectSkill->save();
                }
            }
        }
        
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

        if (count($students) > $subject->limit) {
            return Redirect::back()->withErrors([
                'error' => 'Over quota limit'
            ]);
        }

        $subject->students()->sync($students);
        
        foreach ($subject->skills()->get() as $skill) {
            $skill->students()->sync($students);
        }
        
        foreach ($subject->lessons()->get() as $lesson) {
            $lesson->students()->sync($students);
        }

        return redirect()->route('subjects.registration');
    }

    public function studentRegistration() {

        $subjects = Subject::orderBy('updated_at', 'desc')
                    ->whereDoesntHave('students', function($query) {
                        $query->where('student_id', auth()->user()->id);
                    })
                    ->withCount('students')
                    ->having('students_count', '<', DB::raw('subjects.limit'))
                    ->paginate($this->perPage);

        return view('subject.student-registration')->with(compact('subjects'));
    }

    public function studentRegistrationSubmit(Request $request, Subject $subject) {
        $subject->students()->attach(auth()->user()->id);

        foreach ($subject->skills()->get() as $skill) {
            $skill->students()->attach(auth()->user()->id);
        }

        foreach ($subject->lessons()->get() as $lesson) {
            $lesson->students()->attach(auth()->user()->id);
        }

        return redirect()->back();
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
                'attendance' => $student['attendance'],
            ];
        }
        $subject->students()->sync($students);

        foreach ($subject->skills()->get() as $skill) {
            $students = array();
            foreach ($request->students as $student) {
                $students[$student['id']] = [
                    'grade' => $student['skill'][$skill->id],
                ];
            }

            $skill->students()->sync($students);
        }
        
        return redirect()->route('subjects.grading');
    }
}
