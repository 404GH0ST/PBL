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

        $faqs = Schema::hasTable('faqs')
            ? Faq::where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
            : collect();

        return view('contact.index', compact('contact', 'faqs'));
    }
}
