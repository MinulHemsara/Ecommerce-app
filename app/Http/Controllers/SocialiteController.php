<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthenticate(){
        
        try{

            $googleUser = Socialite::driver('google')->user();
            // dd($user->getName(), $user->getEmail(), $user->getAvatar());

            // Here, you can handle the authenticated user information as needed.
            // For example, you might want to create or update a user in your database
            // and log them in.

            $user = User::where('google_id', $googleUser->id)->first();

            if($user){
                Auth::login($user);
                return redirect()->route('dashboard');
            }else{
                $userData = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'username' => $googleUser->name,
                    'password' => Hash::make('Password@1234'),
                    'google_id' => $googleUser->id
                ]);

                if($userData){
                    Auth::login($userData);
                    return redirect()->route('dashboard');
                }
            }

        }catch(Exception $e){

        }

        // return redirect('/dashboard'); // Redirect to a desired location after authentication
    }
}
