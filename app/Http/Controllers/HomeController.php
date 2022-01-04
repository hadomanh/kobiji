<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $color = array(
            0 => '#f56954',
            1 => '#f39c12',
            2 => '#0073b7',
            3 => '#00c0ef',
            4 => '#00a65a',
            5 => '#3c8dbc',
        );
        $timetable = array();
        if (Auth::user()->role === 'student') {
            foreach (Auth::user()->lessons->toArray() as $lesson) {
                $randomColor = array_rand($color);
                array_push($timetable, array(
                    'title' => $lesson['title'],
                    'from' => $lesson['date'] . ' ' . $lesson['from'],
                    'to' => $lesson['date'] . ' ' . $lesson['to'],
                    'allDay' => false,
                    'backgroundColor' => $color[$randomColor],
                    'borderColor' => $color[$randomColor],
                ));
            }
        }
        $timetable = json_encode($timetable);
        return view('home')->with(compact('timetable'));
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

}
