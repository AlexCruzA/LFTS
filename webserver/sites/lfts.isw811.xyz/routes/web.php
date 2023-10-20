<?php
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {   
    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('posts/{post:slug}', function (Post $post) {    
    return view('post', [
        'post' => $post
    ]);
});

