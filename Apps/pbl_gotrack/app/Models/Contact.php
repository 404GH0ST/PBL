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
        'logo',
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

    public static function active(): ?self
    {
        return static::where('is_active', true)->first();
    }

    public function getLogoUrlAttribute(): string
    {
        if ($this->logo) {
            if (\Illuminate\Support\Str::startsWith($this->logo, ['http://', 'https://', '/storage/', '/images/'])) {
                return \Illuminate\Support\Str::startsWith($this->logo, '/')
                    ? asset(ltrim($this->logo, '/'))
                    : $this->logo;
            }

            return \Illuminate\Support\Facades\Storage::disk('public')->url($this->logo);
        }

        return asset('images/logo_deenhag.png');
    }
}
