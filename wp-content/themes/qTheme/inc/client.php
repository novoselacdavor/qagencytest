<?php

require get_template_directory() . '/vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

$client = new GuzzleHttp\Client();

Class QAgencyAPIClient {
    private $client = null;
    const API_URL   = 'https://symfony-skeleton.q-tests.com/api/v2';
    var $auth_email;
    var $auth_pass;
    var $accessToken;

    public function __construct($email,$pass) {
        $this->auth_email   = $email;
        $this->auth_pass    = $pass;
        $this->client       = new Client();
    }

    /*
        curl -X 'POST' \
        'https://symfony-skeleton.q-tests.com/api/v2/token' \
        -H 'accept: application/json' \
        -H 'Content-Type: application/json' \
        -d '{
            "email": "ahsoka.tano@q.agency",
            "password": "Kryze4President"
        }'
    */
    public function userQLogin() {
        try {
            $guzzleResponse = $this->client->request('POST', "https://symfony-skeleton.q-tests.com/api/v2/token",[
                    'headers' => [
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/json'
                    ],
                    'json' => [
                        'email'     => $this->auth_email,
                        'password'  => $this->auth_pass,
                    ],
                    'verify' => false
                ]
            );

            if ($guzzleResponse->getStatusCode() == 200) {
                $response = json_decode($guzzleResponse->getBody()->getContents(), true);
                return $response;
            }
        }

        catch (GuzzleHttp\Exception\RequestException $e) {
            echo 'Something went wrong, please try to login again.';
        }
    }
}