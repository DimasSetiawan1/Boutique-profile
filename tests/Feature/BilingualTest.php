<?php

namespace Tests\Feature;

use Tests\TestCase;

class BilingualTest extends TestCase
{
    /**
     * Test the default locale (Indonesian) loading on landing page.
     */
    public function test_default_locale_is_indonesian()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Siapa Kami');
        $response->assertSee('Layanan Kami');
        $response->assertDontSee('Our Services');
    }

    /**
     * Test locale switching route redirects and sets session.
     */
    public function test_locale_switching_route()
    {
        $response = $this->get('/lang/en');

        $response->assertStatus(302); // Redirect back
        $response->assertSessionHas('locale', 'en');
    }

    /**
     * Test switching to English updates homepage translations.
     */
    public function test_english_locale_loads_correctly()
    {
        $response = $this->withSession(['locale' => 'en'])->get('/');

        $response->assertStatus(200);
        $response->assertSee('Our Services');
        $response->assertSee('grab even bigger ideas with us');
        $response->assertDontSee('Siapa Kami');
    }
}
