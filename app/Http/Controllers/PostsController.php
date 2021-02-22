<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    //create middleware to prevent other user from be able to seeing this
    public function __construct()
    {
        $this->middleware('auth');
    }


    //
    public function create()
    {
        // return view('posts/create');
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            // 'image' => 'required|image',
            'image' => ['required', 'image',],
        ]);

        //what driver that we need to use (Amazon)
        $imagePath = request('image')->store('uploads', 'public');

        // $img = Image::make($request->file('photo')->getRealPath());

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        //this assign directly to the user id.
        // auth()->user()->posts()->create($data);
        auth()->user()->posts()->create(['caption' => $data['caption'], 'image' => $imagePath,]);

        // \App\Models\Post::create($data);


        // \App\Models\Post::create([
        //     'caption' => $data['caption']
        // ]);

        /*
        can also do like php artisan tinker run 
        $post=new \App\Models\Post();
        $post->caption=$data['caption'];
        $post->save();
        */

        // dd(request()->all());

        return redirect('/profile/'.auth()->user()->id);
    }

    
    public function show(\App\Models\Post $post){
        // dd($post);
        //can also do like this
        // return view('posts.show',['post' => $post]);
        return view('posts.show', compact('post'));
    }
}
