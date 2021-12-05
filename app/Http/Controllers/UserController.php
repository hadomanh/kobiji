<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
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
        $users = $this->user->where('role', $role)->orderBy('updated_at', 'desc')->paginate($this->perPage);
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
        return view('user.show', compact('user'));
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
        return redirect()->route('users.index', $user->role);
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
