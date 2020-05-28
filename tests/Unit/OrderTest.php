<?php

namespace Tests\Unit;

use App\Order;
use App\Partner;
use App\Product;
use App\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_belong_to_partner()
    {
        $partner = factory(Partner::class)->create();
        $order = factory(Order::class)->create([
            'partner_id' => $partner->id,
        ]);

        $this->assertInstanceOf(Partner::class, $order->partner);
        $this->assertEquals($partner->email, $order->partner->email);
    }

    /**
     * @test
     */
    public function it_belong_to_many_products()
    {
        $products = factory(Product::class, 2)->create([
            'vendor_id' => factory(Vendor::class),
        ]);

        $order = factory(Order::class)->create([
            'partner_id' => factory(Partner::class),
        ]);

        $order->products()->saveMany($products);

        $this->assertCount(2, $order->products);
        $this->assertInstanceOf(Product::class, $order->products->first());
        $this->assertEquals($products->first()->name, $order->products->first()->name);
        $this->assertEquals($products->first()->price, $order->products->first()->price);
    }
}
