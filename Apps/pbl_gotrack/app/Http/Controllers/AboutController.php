<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Support\Facades\Schema;

class AboutController extends Controller
{
    public function __invoke()
    {
        $faqFallback = collect([
            [
                'question' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ...',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore',
            ],
            [
                'question' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque.',
                'answer' => 'Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu.',
            ],
            [
                'question' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque.',
                'answer' => 'Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu.',
            ],
            [
                'question' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ...',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore',
            ],
            [
                'question' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ...',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore',
            ],
            [
                'question' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque.',
                'answer' => 'Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu.',
            ],
        ]);

        $faqs = Schema::hasTable('faqs')
            ? Faq::where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
            : collect();

        return view('about', [
            'faqs' => $faqs->isNotEmpty() ? $faqs : $faqFallback,
        ]);
    }
}
