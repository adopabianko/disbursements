<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Disbursement;

class DisbursementTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAccessPageFormDisbursement()
    {
        $user = User::factory()->create();

        $user->attachRole(1);

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->get('/disbursement/create');
        
        $response->assertStatus(200);
    }

    public function testAccessListDataDisbursement()
    {
        $user = User::factory()->create();

        $user->attachRole(1);

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->get('/disbursement/list');
        
        $response->assertStatus(200);
    }

    public function testCreateNewDisbursement() {
        $user = User::factory()->create();

        $user->attachRole(1);

        $data = [
            'bank_code' => 'bni',
            'account_number' => '111111111',
            'amount' => 100000,
            'remark' => 'Simple Test Remark'
        ];

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->json('POST', '/disbursement/store', $data);

        $response->assertStatus(200);
    }

    public function testCreateNewDisbursementWithValidation() {
        $user = User::factory()->create();

        $user->attachRole(1);

        $data = [
            'bank_code' => 'bni',
            'account_number' => '111111111',
            'amount' => '',
            'remark' => ''
        ];
        
        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->json('POST', '/disbursement/store', $data);

        $response->assertStatus(422);
    }

    public function testCheckStatusDisbursement() {
        $user = User::factory()->create();

        $user->attachRole(1);

        $disbursmentId = Disbursement::select('id')->orderBy('created_at', 'desc')->first()->id;

        $data = [
            'id' => $disbursmentId,
        ];
        
        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->json('POST', '/disbursement/updatestatus', $data);

        $response->assertStatus(200);
    }

    public function testCheckStatusDisbursementWithValidation() {
        $user = User::factory()->create();

        $user->attachRole(1);

        $disbursmentId = Disbursement::select('id')->orderBy('created_at', 'desc')->first()->id;

        $data = [
            'id' => '',
        ];
        
        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->json('POST', '/disbursement/updatestatus', $data);

        $response->assertStatus(422);
    }

    public function testCheckStatusDisbursementNotFound() {
        $user = User::factory()->create();

        $user->attachRole(1);

        $data = [
            'id' => '12112110',
        ];
        
        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->json('POST', '/disbursement/updatestatus', $data);

        $response->assertStatus(404);
    }
}
