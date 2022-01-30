<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Profile;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['errors' => ['credentials' => ['Invalid credentials.']]], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['errors' => 'Could not create token.'], 500);
        }

        $user = User::where('email', $request->email)->first();
        $profile = Profile::where('user_id', $user->id)->first();
        return response()->json(['token' => $token, 'user_profile_id' => $profile->id, 'username' => $profile->username, 'id' => $user->id]);
    }

    // public function test(Request $request)
    // {
    //     $profile = new Profile();
    //     $profile->user_id = 1;
    //     $profile->save();
    //     $path = $request->file('photo')->store('images', ['disk' => 'public']);
    //     $image = new Image();
    //     $image->profile_id = $profile->id;
    //     $image->image = 'http://localhost:8000/storage/' . $path;
    //     $image->save();
    //     // $images = Image::all();
    //     return $image;
    // }

    // public function test(Request $request)
    // {
    //     $alice = User::find(1);
    //     $bob = User::find(2);
    //     $tim = User::find(3);

    //     $alice->follow($bob);
    //     $alice->follow($tim);

    //     return User::followedBy($alice)->get();
    //     // $tim = User::where('name', 'Tim')->first();
    // }
}