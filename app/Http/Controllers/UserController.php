<?php

namespace App\Http\Controllers;

use App\Contracts\CounterContract;
use App\Http\Requests\UpdateUser;
use App\Image;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $counter;
    public function __construct(CounterContract $counter)
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
        $this->counter = $counter;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user'=>$user,
            'counter' => $this->counter->increment("user-{$user->id}")
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        if($request->hasFile('avatar')){
            $pathName = $request->file('avatar')->store('avatars');
            if($user->image){
                Storage::delete($user->image->path);
                $user->image->path = $pathName;
                $user->image->save();
            } else {
                $user->image()->save(Image::make(['path'=>$pathName]));
            }
        }
        // $user->save();
        return redirect()->back()->withStatus('User was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        dd($user);
    }
}
