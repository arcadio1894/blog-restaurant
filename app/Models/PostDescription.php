<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'description',
        'columns',
        'order'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
