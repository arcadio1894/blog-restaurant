<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'url',
        'description',
        'name',
        'columns',
        'order'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
