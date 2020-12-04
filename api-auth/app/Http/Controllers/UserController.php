<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        return $user->save();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if($request->name != null){
            $user->name = $request->name;
        }
        if($request->email != null){
            $user->email = $request->email;
        }
        if($request->passowrd != null){
            $user->password = bcrypt($request->password);
        }

        return $user->save();
    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}
