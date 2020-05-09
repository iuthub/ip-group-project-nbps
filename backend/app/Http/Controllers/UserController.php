<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('user.create');
    }

    public function show(User $user)
    {
        return view('user.show', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|alpha',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'firstname' => 'nullable|alpha',
            'lastname' => 'nullable|alpha',
            'birthday' => 'nullable|date_format:Y-m-d',
            'phone' => 'nullable|regex:(^\+998[0-9]{2}[0-9]{7}$)',
            'country' => 'nullable|alpha',
            'city' => 'nullable|alpha',
            'postcode' => 'nullable|numeric',
            'address' => 'nullable',
            'admin_role' => 'nullable'
        ]);
        $request->password = Hash::make($request->password);
        $user = User::create($request->only(['name', 'email', 'password']));
        if ($request->get('admin_role')) {
            $user->assignRole('administrator');
        }
        $user->profile()->create($request->except(['name', 'email', 'password']));
        return redirect()->route('user.index')->with([
            'success' => __('flash.success.store', ['model' => 'User'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|alpha',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'firstname' => 'nullable|alpha',
            'lastname' => 'nullable|alpha',
            'birthday' => 'nullable|date_format:Y-m-d',
            'phone' => 'nullable|regex:(^\+998[0-9]{2}[0-9]{7}$)',
            'country' => 'nullable|alpha',
            'city' => 'nullable|alpha',
            'postcode' => 'nullable|numeric',
            'address' => 'nullable'
        ]);
        $user->profile->fill($request->only([
            'firstname',
            'lastname',
            'birthday',
            'phone',
            'country',
            'city',
            'postcode',
            'address',
        ]));
        $user->fill($request->only([
            'name',
            'email',
        ]));
        $user->push();
        return redirect()->route('user.index')->with([
            'success' => __('flash.success.update', ['model' => 'User'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        if (Auth::user() == $user) {
            Auth::logout();
        }
        return redirect()->route('user.index')->with([
            'success' => __('flash.success.destroy', ['model' => 'User'])
        ]);
    }

    public function editPassword(Request $request, User $user)
    {
        return view('user.editPassword', [
            'user' => $user
        ]);
    }

    public function updatePassword(Request $request, User $user)
    {
        $this->validate($request, [
            'password' => 'required|confirmed'
        ]);
        $password = Hash::make($request->get('password'));
        $user->update([
            'password' => $password
        ]);
        if (Auth::user()->email == $user->email) {
            Auth::logout();
        }
        return redirect()->route('user.index')->with([
            'success' => __('flash.success.update', ['model' => 'Password'])
        ]);
    }
}
