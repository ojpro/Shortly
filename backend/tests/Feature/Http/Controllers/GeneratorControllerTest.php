<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class GeneratorControllerTest extends TestCase
{
    public function test_check_if_api_generate_valid_url()
    {
        $config = [
            'destination' => 'https://ojpro.me/'
        ];

        $http_response_header = $this->post(route('generate', $config));

        $this->assertTrue(URL::isValidUrl($http_response_header['short_link']));
    }

    public function test_the_generated_link_works(){
        $config = [
            'destination' => 'https://ojpro.me/'
        ];

        $data = $this->post(route('generate', $config));

        $http_response_header = $this->get($data['short_link']);

        $http_response_header->assertRedirect($config['destination']);

    }

}
