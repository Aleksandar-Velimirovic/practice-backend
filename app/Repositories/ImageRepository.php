<?php

namespace App\Repositories;

use App\Models\Image;
use App\Repositories\ImageRepositoryInterface;
use Illuminate\Support\Collection;

class ImageRepository implements ImageRepositoryInterface
{
    private $model;

    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    public function getImagesByProfileId(int $profileId) : Collection 
    {
        return $this->model->where('profile_id', $profileId)->orderBy('created_at', 'DESC')->get();
    }

    public function create(int $profileId, string $path, ?string $description) : void 
    {
        $imagePath = 'http://localhost:8000/storage/' . $path;
        $this->model->create(['profile_id' => $profileId, 'image' => $imagePath, 'description' => $description]);
    }
}