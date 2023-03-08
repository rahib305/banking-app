<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class BankingTest extends TestCase
{
    use WithFaker;
    public function testDepositMoney()
    {
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);

        $amount = 100;
        $response = $this->post('/deposit/deposit', [
            'amount' => $amount,
        ]);
        $user = User::find($user->id);
        $this->assertEquals($user->balance, $amount);
    }

    public function testWithdrawMoney() {
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);

        //Deposit 100
        $amount = 100;
        $this->post('/deposit/deposit', [
            'amount' => $amount,
        ]);

        //withdraw 50
        $withdrawAmount = 50;
        $response = $this->post('/withdraw/withdraw', [
            'amount'=> $withdrawAmount
        ]);

        $userB = User::find($user->id);
        $this->assertEquals($userB->balance, $withdrawAmount);
    }

    public function testTransferMoney() {
        $sender = User::factory()->create();
        $recipient = User::factory()->create();

        $this->actingAs($sender);

        $amount = 100;
        $this->post('/deposit/deposit', [
            'amount' => $amount,
        ]);

        $transferAmount = 50;
        $this->post('transfer/transfer', [
            'amount'=>$transferAmount,
            'email'=>$recipient->email
        ]);

        $sender = User::find($sender->id);
        $this->assertEquals($sender->balance, $transferAmount);

        // Check the recipient's balance
        $recipient = User::find($recipient->id);
        $this->assertEquals($recipient->balance, $transferAmount);
    }
}
