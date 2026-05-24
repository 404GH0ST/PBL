<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Faq;
use Illuminate\Support\Facades\Schema;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Schema::hasTable('contacts')
            ? Contact::where('is_active', true)->latest()->first()
            : null;
        $contactFallback = [
            'title' => 'Hubungi Kami',
            'subtitle' => 'Kontak Deenhag',
            'description' => 'Hubungi Deenhag untuk kebutuhan konveksi dan digital printing Anda. Konsultasi gratis, respons cepat.',
            'whatsapp_number' => '+62 23456789123',
            'phone_number' => '+62 23456789123',
            'email' => 'deenhag@gmail.com',
            'address' => '03240 Desa, Kecamatan, Ponorogo, Jawa Timur, Indonesia',
            'google_maps_url' => 'https://www.google.com/maps/search/?api=1&query=Ponorogo%2C%20Jawa%20Timur',
            'google_maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63267.53399981368!2d111.4172!3d-7.8684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79a0348daa7b05%3A0x301576d14feb980!2sPonorogo%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',
            'facebook_url' => '#',
            'twitter_url' => '#',
            'tiktok_url' => '#',
            'instagram_url' => '#',
        ];

        $faqFallback = [
            [
                'question' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit, quis nostrud exercitation ullamco laboris nisi ut aliquip ...',
                'answer'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pulvinar mattis nunc sed blandit libero volutpat. Egestas fringilla phasellus faucibus scelerisque eleifend. Iaculis massa id neque aliquam vestibulum morbi.',
            ],
            [
                'question' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque.',
                'answer'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore. 13 hendrerit semper vel taciti sapien sociis vel sem porttere. Quisque faucibus ex sapien vitae pellentesque.',
            ],
            [
                'question' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque.',
                'answer'   => 'Pulvinar mattis nunc sed blandit libero volutpat. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate. Iaculis massa id neque aliquam vestibulum morbi blandit cursus risus.',
            ],
            [
                'question' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ...',
                'answer'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor. Egestas fringilla phasellus faucibus scelerisque eleifend. Iaculis massa id neque aliquam vestibulum morbi.',
            ],
            [
                'question' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit, quis nostrud exercitation ullamco laboris nisi ut aliquip ...',
                'answer'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore. Quisque faucibus ex sapien vitae pellentesque sem placerat. 13 hendrerit semper vel taciti sapien sociis porttere.',
            ],
            [
                'question' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ...',
                'answer'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. Egestas fringilla phasellus faucibus scelerisque eleifend donec. 13 hendrerit semper vel taciti sapien sociis vel porttere.',
            ],
        ];

        $faqs = Schema::hasTable('faqs')
            ? Faq::where('is_active', true)->orderBy('sort_order')->get()
            : collect();

        if ($faqs->isEmpty()) {
            $faqs = collect($faqFallback);
        }

        return view('contact.index', compact('contact', 'contactFallback', 'faqs'));
    }
}
