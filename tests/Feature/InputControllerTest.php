<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Duta')
            ->assertSeeText('Hello Duta');

        $this->post('/input/hello', [
            'name' => 'Duta'
        ])->assertSeeText('Hello Duta');
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Duta",
                "last" => "Vira"
            ]
        ])->assertSeeText("Hello Duta");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Duta",
                "last" => "Vira"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Duta")
            ->assertSeeText("Vira");
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple Mac Book Pro",
                    "price" => 30000000
                ],
                [
                    "name" => "Samsung Galaxy S10",
                    "price" => 15000000
                ]
            ]
        ])->assertSeeText("Apple Mac Book Pro")
            ->assertSeeText("Samsung Galaxy S10");
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Agus',
            'married' => 'true',
            'birth_date' => '2000-10-10'
        ])->assertSeeText('Agus')->assertSeeText("true")->assertSeeText("2000-10-10");
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Duta",
                "middle" => "P",
                "last" => "Vira"
            ]
        ])->assertSeeText("Duta")->assertSeeText("Vira")
            ->assertDontSeeText("P");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "Vira",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("Vira")->assertSeeText("rahasia")
            ->assertDontSeeText("admin");
    }


    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "Vira",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("Vira")->assertSeeText("rahasia")
            ->assertSeeText("admin")->assertSeeText("false");
    }


}
