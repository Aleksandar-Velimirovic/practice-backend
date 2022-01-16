<?php

namespace App\Repositories;

use App\Models\Profile;

interface ProfileRepositoryInterface {
    public function getProfileByUserId(int $userId) : Profile;
}