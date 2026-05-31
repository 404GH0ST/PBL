<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'whatsapp_number',
        'phone_number',
        'email',
        'address',
        'google_maps_url',
        'google_maps_embed_url',
        'facebook_url',
        'twitter_url',
        'tiktok_url',
        'instagram_url',
        'about_title',
        'about_tagline',
        'about_description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(function (Contact $contact): void {
            if (! $contact->is_active) {
                return;
            }

            static::query()
                ->whereKeyNot($contact->getKey())
                ->where('is_active', true)
                ->update(['is_active' => false]);
        });
    }
}
