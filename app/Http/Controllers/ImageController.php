<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\ProfileRepositoryInterface;
use Illuminate\Http\Request;


class ImageController extends Controller
{
    private ProfileRepositoryInterface $profileRepository;
    private ImageRepositoryInterface $imageRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository, ImageRepositoryInterface $imageRepository)
    {
        $this->profileRepository = $profileRepository;
        $this->imageRepository = $imageRepository;
    }

    public function store(Request $request)
    {
        $profile = $this->profileRepository->getProfileByUserId($request->user_id);
        $path = $request->file('image')->store('images', ['disk' => 'public']);
        $this->imageRepository->create($profile->id, $path, $request->description);
        $images = $this->imageRepository->getImagesByProfileId($profile->id);
        return response()->json(['images' => $images]);
    }

    // public function getImagesByProfile(Request $request)
    // {
    //     $profile = $this->profileRepository->getProfileByUserId($request->user_id);
    //     return response()->json(['images' => $profile->images]);
    // }
}