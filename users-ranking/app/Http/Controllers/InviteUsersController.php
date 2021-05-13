<?php

namespace App\Http\Controllers;

use App\Models\InviteUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class InviteUsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
        $user = Auth::user();
        $user_invite_email = $request->input('email_invite');  
        if (!User::where('email', '=', $user_invite_email)->exists() ||
        InviteUsers::where('user_invite_email','=',$user_invite_email)->count()==0) {
        $invite_users= InviteUsers::create([
            'user_id' => $user->id,
            'user_email' => $user->email,
            'user_invite_email' => $user_invite_email,
         
        ]);
        $invite_users->save();

        }
    
       // return redirect()->route('admin.users.index');
       return back()->withErrors(['message'=>'Record does not exist']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InviteUsers  $inviteUsers
     * @return \Illuminate\Http\Response
     */
    public function show(InviteUsers $inviteUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InviteUsers  $inviteUsers
     * @return \Illuminate\Http\Response
     */
    public function edit(InviteUsers $inviteUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InviteUsers  $inviteUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InviteUsers $inviteUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InviteUsers  $inviteUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(InviteUsers $inviteUsers)
    {
        //
    }
}
