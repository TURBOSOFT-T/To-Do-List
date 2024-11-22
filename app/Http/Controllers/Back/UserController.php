<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Back\UserRequest;
use App\Http\Requests\MessagePost;
use App\Notifications\PostMessage;

use Carbon\Carbon;

use Cache;

use App\Repositories\ { PostRepository, MessageRepository };

class UserController extends ResourceController
{
    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Back\UserRequest  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
    */
    public function update($id)
    {
        $request = app()->make(UserRequest::class);

        $request->merge([
            'valid' => $request->has('valid'),
        ]);

        User::findOrFail($id)->update($request->all());

        return back()->with('ok', __('The user has been successfully updated'));
    }

    /**
     * Valid the user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function valid(User $user)
    {
        $user->valid = true;
        $user->save();

        return response()->json();
    }


    public function unvalid(User $user)
    {
        $user->valid = false;
        $user->save();

        return response()->json();
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    



}