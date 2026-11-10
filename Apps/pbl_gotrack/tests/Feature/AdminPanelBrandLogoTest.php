<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Providers\Filament\AdminPanelProvider;
use Filament\Panel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminPanelBrandLogoTest extends TestCase
{
    use RefreshDatabase;

    private function makePanel(): Panel
    {
        return (new AdminPanelProvider($this->app))->panel(Panel::make());
    }

    public function test_panel_registration_does_not_query_the_database(): void
    {
        $queries = 0;
        DB::listen(function () use (&$queries) {
            $queries++;
        });

        $this->makePanel();

        $this->assertSame(0, $queries);
    }

    public function test_brand_logo_uses_active_contact_logo(): void
    {
        Contact::create([
            'title' => 'Deenhag',
            'logo' => 'https://example.com/logo.png',
            'is_active' => true,
        ]);

        $this->assertSame('https://example.com/logo.png', $this->makePanel()->getBrandLogo());
    }

    public function test_brand_logo_falls_back_to_default_without_active_contact(): void
    {
        $this->assertSame(asset('images/logo_deenhag.png'), $this->makePanel()->getBrandLogo());
    }
}
