<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Auth;
class SocialiteController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    
    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $db_user=User::firstOrNew(['provider' =>'google','provider_id' => $user->getId()]);
        $db_user->name = $user->getName();
        $db_user->email = $user->getEmail();
        if(!$db_user->exists){
            $db_user->provider_id = $user->getId();
        }
        $db_user->save();
        Auth::login($db_user);
        return redirect('/');
        
    }
}
