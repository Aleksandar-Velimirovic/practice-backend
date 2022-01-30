<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfileByUser(Request $request)
    {
        $profile = Profile::where('user_id', $request->user_id)->with('images')->first();
        return response()->json(['profile' => $profile]);
    }

    public function getPopularProfiles(Request $request)
    {
        $limit = $request->search_term ? null : 18;
        $profiles = Profile::orderBy('followers', 'DESC')->where('username', 'LIKE', '%' . $request->search_term . '%')->where('id', '<>', $request->profile_id)->limit($limit)->get();
        return response()->json(['profiles' => $profiles]);
    }

    public function getProfile(Request $request)
    {
        $profile = Profile::with('images')->find($request->profile_id);
        return response()->json(['profile' => $profile]);
    }

    public function updateProfilePicture(Request $request)
    {
        $path = $request->file('profile_image')->store('images', ['disk' => 'public']);
        $profile = Profile::where('user_id', $request->user_id)->with('images')->first();
        $profile->image = 'http://localhost:8000/storage/' . $path;
        $profile->save();
        return response()->json(['profile' => $profile]);
    }
    
    public function follow(Request $request)
    {
        $profile = Profile::with('images')->find($request->profile_id);
        $userProfile = Profile::find($request->user_profile_id);
        $userProfile->follow($profile);
        
        $profile->followers = $profile->followers()->count();
        $profile->save();

        $userProfile->following = $userProfile->following()->count();
        $userProfile->save();
        return response()->json(['profile' => $profile]);
    }

    public function isFollowing(Request $request)
    {
        $profile = Profile::with('images')->find($request->profile_id);
        $userProfile = Profile::find($request->user_profile_id);
        
        return response()->json(['isFollowing' => $userProfile->isFollowing($profile)]);
    }
}