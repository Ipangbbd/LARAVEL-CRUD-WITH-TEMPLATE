<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get the posts for the genre.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
