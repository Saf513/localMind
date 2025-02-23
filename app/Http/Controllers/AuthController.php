<?php

namespace App\Http\Controllers;

use App\Models\BaseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function index(){
    return view('register');
   }

   public function store(Request $request)
   {
       $validated = $request->validate([
         'name' =>'required',
           'email' => 'required|email|unique:base_users',
           'password' => 'required|min:8'
       ]);
   
       BaseUser::create([
           'email' => $validated['email'],
           'password' => bcrypt($validated['password']) ,
           'name' =>$validated['name'],
           'user_type'=>'regular_user'
       ]);
   
       return redirect()->route('home')->with('success', 'Inscription réussie!');
   }

   public function showLogin(){
      return view('login');
   }

   public function login(Request $request){
      $email = $request ->email;
      $password = $request->password;
      $values =['email'=>$email , 'password'=>$password];
     if  ( Auth::attempt($values)){
      $request->session()->regenerate();
      return to_route('home');
     }
     else{
      return back()->withErrors(['email' => 'mots de passe ou email est incorrecte'])->onlyInput('email');
     }
 }

 public function logout(Request $request){
  Auth :: logout();
  $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');

  
 }
}
