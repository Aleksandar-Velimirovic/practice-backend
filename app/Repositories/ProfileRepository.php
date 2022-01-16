<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Repositories\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{
    private $model;

    public function __construct(Profile $model)
    {
        $this->model = $model;
    }

    public function getProfileByUserId(int $userId) : Profile 
    {
        return $this->model->where('user_id', $userId)->first();
    }
}