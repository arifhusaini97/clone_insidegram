<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    //

    public function index($user)
    {
        // dd($user);
        // dd(User::find($user));
        // \App\Models\User::find($user);
        // return view('home');
        // $user = User::find($user);
        $user = User::findOrFail($user);
        return view('profiles.index', ['user' => $user,]);
    }
}
