<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Duta');

        $this->get('/hello-again')
            ->assertSeeText('Hello Duta');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Duta');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Duta'])
            ->assertSeeText('Hello Duta');

        $this->view('hello.world', ['name' => 'Duta'])
            ->assertSeeText('World Duta');
    }


}
