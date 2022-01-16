<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\Befriended\Contracts\Following;
use Rennokki\Befriended\Traits\Follow;

class Profile extends Model implements Following
{
    use HasFactory;
    use Follow;

    public function images()
    {
        return $this->hasMany(Image::class)->orderBy('created_at', 'DESC')->with('comments.profile');
    }
}
