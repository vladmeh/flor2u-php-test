<?php

namespace Tests\Feature;

use App\Product;
use App\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $products;

    /**
     * @test
     */
    public function it_can_be_get_product_list_json()
    {
        $this->get('/api/products')
            ->assertOk()
            ->assertJsonCount(25, 'data');
    }

    /**
     * @test
     */
    public function it_can_be_get_product_by_id_to_json()
    {
        $product = Product::find(1);

        $this->get('/api/products/1')
            ->assertOk()
            ->assertJsonFragment([
                'id' => $product->id
            ]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->products = factory(Product::class, 25)->create([
            'vendor_id' => factory(Vendor::class),
        ]);
    }
}
