<?php
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {   
    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('posts/{post}', function ($id) {    
    return view('post', [
        'post' => Post::findOrFail($id)
    ]);
});

