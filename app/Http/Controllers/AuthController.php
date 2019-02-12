<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {

        $headers = [
            'Accept' => 'application/json'
        ];
        $client = new Client([
            'headers' => $headers
        ]);
        $response = $client->request('POST', 'laravel-api.test/api/login', [
            'form_params' => [
                'email' => $request->credentials['email'],
                'password' => $request->credentials['password']
            ]
        ]);
        return $response->getBody()->getContents();
    }
}
