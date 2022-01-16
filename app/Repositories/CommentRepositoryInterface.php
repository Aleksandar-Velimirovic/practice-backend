<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface CommentRepositoryInterface {
    public function create(Request $request) : Comment;
    public function findByImage(int $imageId) : Collection;
}