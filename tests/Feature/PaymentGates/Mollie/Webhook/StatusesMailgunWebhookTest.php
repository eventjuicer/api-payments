<?php

namespace Tests\Feature\PaymentGates\Mollie\Webhook;

use App\Enums\PaymentGates\Mollie\WebhookStatus;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use Database\Factories\PaymentFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusesMailgunWebhookTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        //this secret is dedicated for attached fixtures
        //config()->set('services.mailgun.secret', env('MAILGUN_WEBHOOK_FIXTURES_SECRET'));
    }

    protected function loadPayloadFromFile($status)
    {
        return json_decode(file_get_contents('tests/fixtures/payment_gates/mollie/webhook/'.$status.'.json'), true);
    }

    public function test_paid_status()
    {
        $paymentId = '300';

        Payment::factory()->create([
            'payment_id' => $paymentId,
            'status' => PaymentStatus::OPEN
        ]);
        $payload = $this->loadPayloadFromFile(WebhookStatus::PAID->value);

        $response = $this->postJson(route('payment_gates.mollie.webhook'), [
            'status' => WebhookStatus::PAID->value,
            'payment_id' =>$paymentId
        ]);

        $response->assertStatus(200);

        //dd(Payment::get()->toArray());

        $this->assertDatabaseHas('payments', [
            'payment_id' => $paymentId,
            'status' => PaymentStatus::PAID
        ]);
    }
}
