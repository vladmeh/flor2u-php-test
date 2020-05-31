<?php

namespace Tests\Feature;

use App\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PartnerControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $partners;

    /**
     * @test
     */
    public function it_can_be_get_partner_list_json()
    {
        $this->get('/api/partners')
            ->assertOk()
            ->assertJsonCount(20, 'data');
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->partners = factory(Partner::class, 20)->create();
    }


}
