<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsAdmin;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function users()
    {
        $users = User::paginate(10);
        if(!auth()->user()->isAdmin() && !auth()->user()->isModerator()){
            $users = User::where('type','!=','1')->paginate(10);
        }else if(auth()->user()->isModerator()){
            $users = User::where('type','!=','3')->paginate(10);
        }
        return view('admin.users.index', compact('users'));
    }
    public function test(){
        dd(1);
    }

    public function categoriesIndex()
    {
        return view('admin.categories.index');
    }

    public function categoriesCreate()
    {
        return view('admin.categories.create');
    }

    public function threadsIndex()
    {
        return view('admin.threads.index');
    }
}
