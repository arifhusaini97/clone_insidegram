@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 p-5"><img style="height:250px;" src="{{ $user->profile->profileImage() }}"
                    class="rounded-circle w-250 h-250"></div>
            <div class="col-9 pt-5 pl-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <!-- <h1>Nur Arif Husaini Bin Norwaza</h1> -->
                    <!-- <h1><-?= $user ?-></h1> -->
                    <div class="d-flex align-items-center padding-bottom">
                        <div class="h4">{{ $user->name }}</div>
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    </div>
                    @can('update', $user->profile)
                        <a href="/p/create">Add New Post</a>
                    @endcan
                </div>
                @can('update', $user->profile)
                    <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
                @endcan
                <div class="d-flex">
                    <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                    <div class="pr-5"><strong>{{ $user->profile->followers->count() }}</strong> follower</div>
                    <div class="pr-5"><strong>{{ $user->following->count() }}</strong> following</div>
                </div>
                <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
                <div>{{ $user->profile->description }}</div>
                <div><a href="#">{{ $user->profile->url ?? 'N/A' }}</a></div>
            </div>
        </div>
        <div class="row">
            @foreach ($user->posts as $post)
                <div class="col-4 pt-5 pb-4"><a href="/p/{{ $post->id }}"><img src="/storage/{{ $post->image }}"
                            class="w-100 h-100"></div>
            @endforeach
        </div>
    </div>
@endsection
