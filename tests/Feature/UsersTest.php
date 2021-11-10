<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testGet()
    {
        $response = $this->get('/users');

        $response
            ->assertStatus(200)
            ->assertJsonCount(13);
    }

    /**
     * @runInSeparateProcess
     */
    public function testStore()
    {
        $response = $this->postJson('/users',
            [
                'usuario_id' => '99999',
                'leiloeiro_id' => '999999999'
            ]
        );

        $response
            ->assertStatus(201)
            ->assertCreated();
    }

    /**
     * @runInSeparateProcess
     */
    public function testUpdate()
    {
        $response = $this->putJson('/users/99999',
            [
                'leiloeiro_id' => '99999'
            ]
        );

        $response
            ->assertStatus(202)
            ->assertJson([
                "updated" => true
            ]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testDestroy()
    {
        $response = $this->deleteJson('/users/99999');

        $response
            ->assertStatus(202)
            ->assertJson([
                "deleted" => true
            ]);
    }
}
