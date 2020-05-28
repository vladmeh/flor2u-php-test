<?php

namespace Tests\Unit;

use App\Product;
use App\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_belong_to_vendor()
    {
        $vendor = factory(Vendor::class)->create();
        $product = factory(Product::class)->create([
            'vendor_id' => $vendor->id,
        ]);

        $this->assertInstanceOf(Vendor::class, $product->vendor);
        $this->assertEquals($vendor->email, $product->vendor->email);
    }
}
