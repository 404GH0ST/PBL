<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit, quis nostrud exercitation ullamco laboris nisi ut aliquip ...',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pulvinar mattis nunc sed blandit libero volutpat. Egestas fringilla phasellus faucibus scelerisque eleifend. Iaculis massa id neque aliquam vestibulum morbi.',
            ],
            [
                'question' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque.',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore. 13 hendrerit semper vel taciti sapien sociis vel sem porttere. Quisque faucibus ex sapien vitae pellentesque.',
            ],
            [
                'question' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque.',
                'answer' => 'Pulvinar mattis nunc sed blandit libero volutpat. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate. Iaculis massa id neque aliquam vestibulum morbi blandit cursus risus.',
            ],
            [
                'question' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ...',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor. Egestas fringilla phasellus faucibus scelerisque eleifend. Iaculis massa id neque aliquam vestibulum morbi.',
            ],
            [
                'question' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit, quis nostrud exercitation ullamco laboris nisi ut aliquip ...',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore. Quisque faucibus ex sapien vitae pellentesque sem placerat. 13 hendrerit semper vel taciti sapien sociis porttere.',
            ],
            [
                'question' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ...',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. Egestas fringilla phasellus faucibus scelerisque eleifend donec. 13 hendrerit semper vel taciti sapien sociis vel porttere.',
            ],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::updateOrCreate(
                [
                    'question' => $faq['question'],
                    'sort_order' => $index + 1,
                ],
                [
                    'answer' => $faq['answer'],
                    'is_active' => true,
                ],
            );
        }
    }
}
