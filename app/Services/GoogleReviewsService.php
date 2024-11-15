<?php

namespace App\Services;

use Google_Client;
use GuzzleHttp\Client;

class GoogleReviewsService
{
    protected $client;
    protected $myBusinessService;
    protected $accessToken;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setApplicationName('Rawf-res');
        $this->client->setDeveloperKey(env('GOOGLE_API_KEY')); // Set your API key

        // For OAuth
        $this->client->setAuthConfig(storage_path('app/google/client_secret_877188852963-eqaen2lgmsb7platbuuj1dc5njd6i5h7.apps.googleusercontent.com.json')); // Path to your credentials.json
        $this->client->setAccessType('offline');
        $this->client->addScope("https://www.googleapis.com/auth/business.manage");

        $this->authenticate(); // Authenticate user and fetch access token
    }

    private function authenticate()
    {
        // Check if we have a token already stored
        $tokenPath = storage_path('app/google/token.json');
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $this->client->setAccessToken($accessToken);

            // Refresh the token if it's expired
            if ($this->client->isAccessTokenExpired()) {
                
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));
            }
        } else {
            // Generate an authorization URL
            if (!$this->client->getAccessToken()) {
                // Please use authCode with temp code
                $authCode = "4/0AQlEd8zIcLdJM0dGRAH-2EEAnQk6CznwQLeEzhgNL9gb9yN99lcTzBKqQiGNeNsIsnqliQ";
                $accessToken = $this->client->fetchAccessTokenWithAuthCode($authCode);
                $this->client->setAccessToken($accessToken);

                // Save the token to a file
                if (!file_exists(dirname($tokenPath))) {
                    mkdir(dirname($tokenPath), 0700, true);
                }
                file_put_contents($tokenPath, json_encode($accessToken));
            }
        }

        $this->accessToken = $this->client->getAccessToken();
    }

    public function getReviews($accountId, $locationId)
    {
        $reviews = [];
        $url = "https://mybusiness.googleapis.com/v4/accounts/$accountId/locations/$locationId/reviews";

        do {
            // Get the response from the API
            $response = json_decode($this->makeApiRequest($url)); // Decode as object, not array
        
            // Check if 'reviews' exist in the response and merge them into the $reviews array
            if (isset($response->reviews)) {
                $reviews = array_merge($reviews, $response->reviews); // Use object notation
            }

            if (isset($response->nextPageToken)) {
                $nextPageToken = $response->nextPageToken;
        
                // Check if nextPageToken is not empty
                if (!empty($nextPageToken)) {
                    $url = "https://mybusiness.googleapis.com/v4/accounts/$accountId/locations/$locationId/reviews?pageToken=$nextPageToken";
                    sleep(2); // Delay 2 seconds to allow nextPageToken to become valid
                } else {
                    $url = null; // Break the loop if nextPageToken is empty
                }
            } else {
                $url = null; // Break the loop if there's no nextPageToken
            }
        
        } while ($url);

        return $reviews;
    }

    public function updateReply($accountId, $locationId, $reviewID, $comment, $updateTime)
    {
        $url = "https://mybusiness.googleapis.com/v4/accounts/$accountId/locations/$locationId/reviews/$reviewID/reply";
        
        // Define the variables $comment and $updateTime as necessary

        // Define $requestBody as an associative array
        $requestBody = [
            "comment" => $comment,
            "updateTime" => $updateTime
        ];

        $response = json_decode($this->makeApiRequest($url, 'PUT', $requestBody));

        return $response;
    }

    private function makeApiRequest($url, $method = 'GET', $data = [])
    {
        $ch = curl_init();
    
        // Set the URL
        curl_setopt($ch, CURLOPT_URL, $url);
    
        // Set the request method
        switch (strtoupper($method)) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, 1);
                if (!empty($data)) {
                    // Send the data as JSON
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                if (!empty($data)) {
                    // Send the data as JSON
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty($data)) {
                    // Send the data as JSON (not appended to URL like GET)
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
            default:
                curl_setopt($ch, CURLOPT_HTTPGET, 1); // Default to GET
                break;
        }
    
        // Set common options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->accessToken['access_token'],
            'Accept: application/json',
            'Content-Type: application/json',
        ]);
    
        // Execute the request
        $response = curl_exec($ch);
    
        // Check for errors
        if (curl_errno($ch)) {
            throw new \Exception('Request Error:' . curl_error($ch));
        }
    
        // Close cURL session
        curl_close($ch);
    
        return $response;
    }
}
