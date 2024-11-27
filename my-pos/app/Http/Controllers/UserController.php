<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = user::paginate(8);
        return view('users.index', ['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $users = new User;
         $users->name = $request->name;
         $users->email = $request->email;
         $users->password = md5($request->name);
         $users->is_admin = $request->is_admin;
         $users->save();

        if ($users) {
            return redirect()->back()->with('User Created');
        }
        return redirect()->back()->with('Fail');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!$user) {
            return back()->with('error', 'User not found');
        }

        $user->update($request->all());
        return back()->with('success', 'User updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

}
