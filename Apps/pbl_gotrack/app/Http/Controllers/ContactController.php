<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Schema::hasTable('contacts')
            ? Contact::where('is_active', true)->latest()->first()
            : null;

        $faqs = Schema::hasTable('faqs')
            ? Faq::where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
            : collect();

        return view('contact.index', compact('contact', 'faqs'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string|max:2000',
        ]);

        $contact = Schema::hasTable('contacts')
            ? Contact::where('is_active', true)->latest()->first()
            : null;

        $storeEmail = $contact?->email ?: 'deenhag@gmail.com';

        \Illuminate\Support\Facades\Mail::to($storeEmail)->send(new \App\Mail\ContactMessage($validated));

        return redirect()
            ->back()
            ->with('contact_success', 'Terima kasih, pesan Anda telah berhasil dikirim ke email kami.');
    }
}
