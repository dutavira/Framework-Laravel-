<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $framework = env('FRAMEWORK');

        self::assertEquals('Programmer Zaman Old', $framework);
    }

    public function testDefaultEnv()
    {
        $author = Env::get('AUTHOR', 'Duta');

        self::assertEquals('Duta', $author);
    }


}
