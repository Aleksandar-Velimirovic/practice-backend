<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'profile_id', 'image_id'];

    use HasFactory;

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
