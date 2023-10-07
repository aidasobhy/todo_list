<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_product_without_auth()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
