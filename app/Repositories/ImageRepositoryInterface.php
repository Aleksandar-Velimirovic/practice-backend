<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface ImageRepositoryInterface {
    public function getImagesByProfileId(int $userId) : Collection;
    public function create(int $profileId, string $path, string $description) : void;
}