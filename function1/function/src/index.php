<?php

require_once(__DIR__ . '/../vendor/autoload.php');

// use Appwrite\Client;
// use Appwrite\Exception;
// use Appwrite\Services\Database;

// This is your Appwrite function
// It's executed each time we get a request
return function ($context) {

    if ($context->req->method === 'GET') {
        return $context->res->send('GET');
    }
    if ($context->req->method === 'POST') {
        return $context->res->send('POST');
    }
    exit;

    $client = new Client();
    $client
        ->setEndpoint('https://cloud.appwrite.io/v1') // Your Appwrite Endpoint
        ->setProject('66692697003daa21c377') // Your project ID
        ->setKey('210bc90bd7c717b23e87d4b72f37c454e731d6a9b82f9925acb35e3ee5cd3f25053983028f69ce161c87998a494f11ad9f6decc14f2dee18874d38f932c45abb8443cb6e2c8449b54f65188c33caf4a293e94de4ee15ca1256fe6ad6d49b559f8e64dcddbaff021a7b272254e0dd1c890536465c6ce743e05760df39a233e9b7'); // Your secret API key

    $collectionId = 'aw_urls';
    $documentData = [
        'full_url' => 'value1',
        'short_url' => 'value2',
        // Add more fields as needed
    ];

    function insertRecord($client, $collectionId, $documentData) {
        $database = new Database($client);
    
        try {
            $response = $database->createDocument($collectionId, uniqid(), $documentData);
            echo 'Record inserted successfully!';
            print_r($response);
            return $response;
        } catch (Exception $e) {
            echo 'Failed to insert record: ' . $e->getMessage();
            throw $e;
        }
    }

    try {
        $response = insertRecord($client, $collectionId, $documentData);
        // Handle successful insertion
        echo 'Record details: ';
        print_r($response);
    } catch (Exception $e) {
        // Handle insertion error
        echo 'Error inserting record: ' . $e->getMessage();
    }

};
