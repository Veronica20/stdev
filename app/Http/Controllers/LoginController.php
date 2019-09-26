<?php
/**
 * Created by PhpStorm.
 * User: Veronica
 * Date: 25.09.2019
 * Time: 21:27
 */

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class LoginController
{
    public function login(Request $request){

        if($request->isMethod('post')){

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'remember' => [ Rule::in(['on'])],
            ]);

            $check = User::where('email',$request->input('email'))->first();

            if(empty($check)){
                return  Redirect::back()->withErrors([ 'Անվավեր Էլ Հասցե']);
            }else{
                if (Hash::check($request->input('password'), $check->password)) {

                    $remember = is_null($request->get('remember')) ? false : true;

                    Auth::login($check, $remember);

                    if($check->role){
                        return redirect()->route('questions');
                    }else{
                        return redirect()->route('game');
                    }
                }else{
                    return  Redirect::back()->withErrors([ 'Անվավեր Գաղտնաբառ']);
                }
            }


        }else{
            return view('auth.login');
        }

    }

    public function registration(Request $request){

        if($request->isMethod('post')){

            //validation
            $request->validate([
                'name' => 'required',
                'surname' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|max:12|min:6',
                'password_confirmation' => 'required|same:password|max:12|min:6',
            ]);

            $user = new User();
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->email = $request->input('email');
            $user->score = 0;
            $user->role = 0;
            $user->password  = Hash::make($request->input('password')); ;
            $user->save();

            return redirect()->route('login');
        }else{
            return view('auth.registration');
        }


    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}