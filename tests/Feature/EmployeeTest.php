<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Generator as Faker;

class EmployeeTest extends TestCase
{
     protected $faker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

        /**
     * Tests shop index without params to see if it works
     *
     * @return void
     */
    // public function testEmployeeIndex()
    // {
    //     $response = $this->json('GET', '/api/v1/employees');
    //     $response->assertStatus(200);
    // }

    public function test_can_create_employee() {
        $data = [
            'emp_id' => '5654654',
            'epm_name' => 'Harihar',            
            'ip_address' => '192.168.10.10’',
        ];
        $this->post(route('employees.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }

}
