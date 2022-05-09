<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index()
    {

        $users = User::all();

        return view('user.list', ['users' => $users]);
    }

    public function changestatus($id)
    {


        $user = User::find($id);

        if ($user->status == 1) {
            $user = User::find($id);
            $user->status = 0;
            $user->update();

            return back();
        } else {

            $user->status = 1;
            $user->update();

            return back();
        }
    }

    // public function enable($id){


    //     $user = User::find($id);
    //     $user->status=1;
    //     $user->update();

    //     return back();
    // }

    // public function disable($id){

    //     $user = User::find($id);
    //     $user->status=0;
    //     $user->update();

    //     return back();
    // }
}
