<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    //Primary coding is like this. Good.
    // public function index($user)
    // {
    //     // dd($user);
    //     // dd(User::find($user));
    //     // \App\Models\User::find($user);
    //     // return view('home');
    //     // $user = User::find($user);


    //     $user = User::findOrFail($user);
    //     return view('profiles.index', ['user' => $user,]);
    // }

    //can delete 'index(\App\Models\' beacuse we already declare aboce
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        // dd($follows);
        //to make cache
        // $postCount = $user->posts->count();
        // $followersCount = $user->profile->followers->count();
        // $followingCount = $user->following->count();

        $postCount = Cache::remember(
            //this is the key
            'count.posts.' . $user->id,
            //how long the cache store
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            }
        );

        $followersCount = Cache::remember(
            //this is the key
            'count.followers.' . $user->id,
            //how long the cache store
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            }
        );

        $followingCount= Cache::remember(
            //this is the key
            'count.following.' . $user->id,
            //how long the cache store
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            }
        );


        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }
    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);
        //Dump and dunk
        // dd($data);

        //This has no protection
        // $user->profile->update($data);

        //this is the atleast we need to do for protection with regular image
        // auth()->user()->profile->update($data);

        //to inspect if the field does have value.
        if (request('image')) {
            //what driver that we need to use (Amazon)
            $imagePath = request('image')->store('profile', 'public');

            // $img = Image::make($request->file('photo')->getRealPath());

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];

            //this is the atleast we need to do for protection with  imagePath
            auth()->user()->profile->update(array_merge(
                $data,
                //This supposed to have problem like in Youtube, but working fine here.
                // ['image' => $imagePath]
                $imageArray ?? []
            ));
        } else {
            auth()->user()->profile->update($data);
        }



        return redirect("/profile/{$user->id}");
    }
}
