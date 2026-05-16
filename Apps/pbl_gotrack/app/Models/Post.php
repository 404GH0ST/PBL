<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_ARCHIVED = 'archived';

    public const STATUSES = [
        self::STATUS_DRAFT => 'Draft',
        self::STATUS_PUBLISHED => 'Published',
        self::STATUS_ARCHIVED => 'Archived',
    ];

    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'featured_image',
        'image_path',
        'status',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Resolve image URL. Supports:
     *  - Full http(s) URLs (e.g. picsum placeholders for seed data)
     *  - Storage paths (e.g. "posts/foo.jpg")
     *  - null (returns a generated placeholder)
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::get(function () {
            $path = $this->image_path ?: $this->featured_image;

            if (! $path) {
                $seed = $this->slug ?: ($this->id ?? 1);
                return "https://picsum.photos/seed/{$seed}/1200/720";
            }

            if (Str::startsWith($path, ['http://', 'https://'])) {
                return $path;
            }

            return asset('storage/' . ltrim($path, '/'));
        });
    }

    /**
     * Nicely formatted published date (Indonesian month names via translatedFormat).
     */
    protected function displayDate(): Attribute
    {
        return Attribute::get(function () {
            $date = $this->published_at ?: $this->created_at;
            return $date?->translatedFormat('j F Y');
        });
    }
}