<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\InviteUsers;
use App\Models\ScoreUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $userscore=ScoreUsers::create([
            'user_id'=>$user->id,
            'score'=>0
        ]);
        $inviteusers=InviteUsers::where('user_invite_email',$user->email)->first();
        if($inviteusers!=null){
            $scoreusers=ScoreUsers::where('user_id',$inviteusers->user_id)->first();
            if($scoreusers!=null){
                $sum=$scoreusers->score;
                $sum=$sum+1;
                $scoreusers->score=$sum;
                $scoreusers->save();
            }
        }

        $invusers=InviteUsers::all();
        if($invusers->count()>0){
        $inviteusers=InviteUsers::where('user_invite_email',$user->email)->first();
        $inviteuserss=InviteUsers::where('user_invite_email',$inviteusers->user_email)->first();
        if($inviteuserss!=null ){
            $scoreusers=ScoreUsers::where('user_id',$inviteuserss->user_id)->first();
            if($scoreusers!=null){
                $sum=$scoreusers->score;
                $sum=$sum+0.5;
                $scoreusers->score=$sum;
                $scoreusers->save();
            }
        }
    }
        return $user;
    }
}
