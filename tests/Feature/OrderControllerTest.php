<?php

namespace Tests\Feature;

use App\Events\OrderUpdated;
use App\Mail\OrderCompleted;
use App\Order;
use App\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
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
        Event::fake();
        $data = [
            'client_email' => "test@test.tt",
            'partner_id' => "2",
            'status' => "10"
        ];

        $this->patch('/api/orders/1', $data)
            ->assertSessionHasNoErrors()
            ->assertOk()
            ->assertJson(['message' => 'Заказ № 1 успешно обновлен']);

        $order = Order::find(1);
        $this->assertEquals($data['client_email'], $order->client_email);
        $this->assertEquals($data['partner_id'], $order->partner_id);
        $this->assertEquals($data['status'], $order->status);

        Event::assertDispatched(OrderUpdated::class);
    }

    /**
     * @test
     */
    public function it_can_be_send_email_after_updated_order()
    {
        Mail::fake();

        $data = [
            'client_email' => "test@test.tt",
            'partner_id' => '2',
            'status' => '20'
        ];

        $this->patch('/api/orders/1', $data)
            ->assertOk();

        Mail::assertSent(OrderCompleted::class);
    }

    /**
     * @test
     */
    public function it_can_be_no_send_email_after_updated_order()
    {
        Mail::fake();

        $data = [
            'client_email' => "test@test.tt",
            'partner_id' => '2',
            'status' => '10'
        ];

        $this->patch('/api/orders/1', $data)
            ->assertOk();

        Mail::assertNotSent(OrderCompleted::class);
    }

    /**
     * @test
     */
    public function it_return_error_required_data()
    {
        $data = [
            'client_email' => "",
            'partner_id' => "",
            'status' => ""
        ];

        $this->patch('/api/orders/1', $data)
            ->assertSessionHasErrors(['client_email', 'partner_id', 'status'])
            ->assertStatus(302);
    }

    /**
     * @test
     */
    public function it_return_error_invalid_data()
    {
        $data = [
            'client_email' => "test.test.test",
            'partner_id' => "",
            'status' => "30"
        ];

        $this->patch('/api/orders/1', $data)
            ->assertSessionHasErrors(['client_email', 'partner_id', 'status'])
            ->assertStatus(302);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->orders = factory(Order::class, 10)->create([
            'partner_id' => factory(Partner::class)
        ]);
    }


}
