<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showProfile(User $user)
    {
        $articles = $user->articles;
        return view('users.profile', compact('user', 'articles'));
    }

}
