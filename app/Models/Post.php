<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'idea',
        'user_id',
        'date_posted',
        'image',
        'category_id',
        'slug'
    ];

    public function getKeywordsAttribute()
    {
        if ($this->tags->isNotEmpty()) {
            // Usar implode para concatenar los tags con comas
            return implode(', ', $this->tags->pluck('tag')->toArray());
        }
        return "";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function descriptions()
    {
        return $this->hasMany(PostDescription::class);
    }

    public function titles()
    {
        return $this->hasMany(PostTitle::class);
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function videos()
    {
        return $this->hasMany(PostVideo::class);
    }

    public function tags()
    {
        return $this->hasMany(PostTag::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $originalSlug = Str::slug($post->title, '-');
                $slug = $originalSlug;
                $count = 1;

                while (Post::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }

                $post->slug = $slug;
            }
        });

        static::updating(function ($post) {
            if (empty($post->slug)) {
                $originalSlug = Str::slug($post->title, '-');
                $slug = $originalSlug;
                $count = 1;

                while (Post::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }

                $post->slug = $slug;
            }
        });
    }

    protected $dates = ['date_posted'];
}
