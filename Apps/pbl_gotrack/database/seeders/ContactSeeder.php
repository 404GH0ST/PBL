<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::updateOrCreate(
            ['title' => 'Hubungi Kami'],
            [
                'subtitle' => 'Kontak Deenhag',
                'description' => 'Hubungi Deenhag untuk kebutuhan konveksi dan digital printing Anda. Konsultasi gratis, respons cepat.',
                'whatsapp_number' => '+62 812 3456 7890',
                'phone_number' => '+62 812 3456 7890',
                'email' => 'admin@deenhagprint.id',
                'address' => 'Jl. Sultan Agung No. 24, Ponorogo, Jawa Timur, Indonesia',
                'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=Ponorogo%2C%20Jawa%20Timur',
                'google_maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63267.53399981368!2d111.4172!3d-7.8684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79a0348daa7b05%3A0x301576d14feb980!2sPonorogo%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',
                'facebook_url' => 'https://facebook.com/deenhagprint',
                'twitter_url' => 'https://x.com/deenhagprint',
                'tiktok_url' => 'https://tiktok.com/@deenhagprint',
                'instagram_url' => 'https://instagram.com/deenhagprint',
                'is_active' => true,
                'about_title' => 'Tentang Deenhag',
                'about_tagline' => 'Solusi konveksi dan digital printing untuk kebutuhan komunitas, usaha, dan acara.',
                'about_description' => 'Deenhag membantu pelanggan membuat produk cetak dan apparel custom dengan proses yang lebih transparan. Setiap pesanan dapat dipantau melalui kode tracking sehingga pelanggan mengetahui progres produksi tanpa harus bertanya berulang kepada admin.',
            ]
        );
    }
}
