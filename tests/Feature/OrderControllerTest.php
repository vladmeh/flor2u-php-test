<?php

namespace Tests\Feature;

use App\Order;
use App\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $orders;

    /**
     * @test
     */
    public function it_can_be_get_order_list_json()
    {
        $this->get('/api/orders')
            ->assertOk()
            ->assertJsonCount(10, 'data');
    }

    /**
     * @test
     */
    public function it_can_be_get_order_by_id_to_json()
    {
        $order = Order::find(1);

        $this->get('/api/orders/1')
            ->assertOk()
            ->assertJsonFragment([
                'id' => $order->id
            ]);
    }

    /**
     * @test
     */
    public function it_can_be_update_order()
    {
        $data = [
            'client_email' => "test@test.tt",
            'partner_id' => "2",
            'status' => "10"
        ];

        $this->patch('/api/orders/1', $data)
            ->assertOk()
            ->assertJson(['message' => 'Заказ успешно обновлен']);

        $order = Order::find(1);
        $this->assertEquals($data['client_email'], $order->client_email);
        $this->assertEquals($data['partner_id'], $order->partner_id);
        $this->assertEquals($data['status'], $order->status);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->orders = factory(Order::class, 10)->create([
            'partner_id' => factory(Partner::class)
        ]);
    }


}
