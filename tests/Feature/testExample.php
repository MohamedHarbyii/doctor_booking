<?php

use Tests\TestCase;

class testExample extends TestCase 
{
    /** 
     @test 
     */
    public function example() {
        $response=$this->get('/');
        $response->assertStatus(200);
    }
}