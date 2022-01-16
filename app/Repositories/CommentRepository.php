<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CommentRepository implements CommentRepositoryInterface
{
    private $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function create(Request $request) : Comment 
    {
        return $this->model->create(['content' => $request->content, 'profile_id' => $request->profile_id, 'image_id' => $request->image_id]);
    }

    public function findByImage(int $imageId) : Collection 
    {
        return $this->model->where('image_id', $imageId)->with('profile')->get();
    }
}