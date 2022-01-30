<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request) {
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();

      $profile = new Profile();
      $profile->user_id = $user->id;
      $profile->isActive = true;
      $profile->image = null;
      $profile->username = $request->name;
      $profile->followers = $profile->followers()->count();
      $profile->following = $profile->following()->count();
      $profile->save();

      return response()->json(['message' => 'Please check your email to verify your account!']);
    }
}