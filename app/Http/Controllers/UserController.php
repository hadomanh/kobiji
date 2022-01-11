<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Throwable;

class UserController extends Controller
{

    private $perPage = 5;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($role)
    {
        if ($role === 'admin' && Auth::user()->role === 'manager') {
            return redirect()->route('home');
        }
        $users = $this->user->where([
            ['role', '=', $role],
            // ['id', '<>', Auth::user()->id]
        ])->orderBy('updated_at', 'desc')->paginate($this->perPage);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->avatar = 'bower_components/admin-lte/dist/img/user2-160x160.jpg';
            $user->active = true;
            $user->save();

            return redirect()->route('users.index', $user->role);
        } catch (Throwable $e) {
            return Redirect::back()->withErrors([
                'error' => $e->getMessage(),
                'email' => $request->email
            ]);
        }
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $typeAverage = array();
        $average = 0;
        for ($i = 0; $i <= 9; $i++) {
            $typeAverage[$i] = $user->getAverageByType($i);
            $average += $typeAverage[$i];
        }
        $average = $average / 10;

        $color = array(
            0 => '#f56954',
            1 => '#f39c12',
            2 => '#0073b7',
            3 => '#00c0ef',
            4 => '#00a65a',
            5 => '#3c8dbc',
        );
        $timetable = array();
        if ($user->role === 'student') {
            foreach ($user->lessons->toArray() as $lesson) {
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

        return view('user.show', compact('user', 'typeAverage', 'average', 'timetable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $currentMillis = round(microtime(true) * 1000);
        if($request->hasFile('avatar')){
            $avatarFileName = $currentMillis . '.' . $request->file('avatar')->extension();
            $user->avatar = 'storage/' . $request->file('avatar')->storeAs('avatar', $avatarFileName, 'public');
        }
        $user->name = $request->name;
        $user->save();
        return redirect()->route('home', $user->role);
    }

    public function editPassword(User $user)
    {
        return view('user.edit-password')->with(compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        if (Hash::check($request->oldPassword, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route('home');
        }

        return Redirect::back()->withErrors([
            'error' => 'Old Password Wrong',
            'email' => $user->email
        ]);
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

    public function toggle(User $user)
    {
        $user->active = !$user->active;
        $user->save();
        return redirect()->back();
    }
}
