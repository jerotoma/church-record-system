<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function login(Request $request) {
        $http = new \GuzzleHttp\Client();

        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'password' => $request->password,
                    'username' => $request->username,
                ]
            ]);

            return $response->getBody();

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {

            $statusCode = $e->getResponse()->getStatusCode();

           // dd($e->getResponse()->getStatusCode());

            if($statusCode == 400) {
                return response()
                    ->json([
                        'success' => false,
                        'message' => 'Invalid request. Please enter a username or password.',
                    ], $statusCode);
            } else if($statusCode == 400) {
                return response()
                    ->json([
                        'success' => false,
                        'message' => 'Your credentials are incorrect. Please try again'
                ], $statusCode);
            }
            return response()
                ->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], $statusCode);
        }
    }
    //
}
