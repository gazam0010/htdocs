<?php
require 'vendor/autoload.php';

use Symfony\Component\Panther\Panther;

$client = Panther::createChromeClient();

try {
    $crawler = $client->request('GET', 'https://meet.google.com');

    // Start a new meeting
    $crawler = $client->click($crawler->selectLink('New meeting')->link());
    
    // Get the meet link
    $meetLink = $crawler->filter('div[data-tooltip="Copy joining info"]')->text();

    if ($meetLink) {
        echo 'Google Meet link: ' . $meetLink . PHP_EOL;
        // Store the meet link in a variable or perform further processing
    } else {
        echo 'Failed to retrieve Google Meet link.' . PHP_EOL;
    }
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage() . PHP_EOL;
} finally {
    $client->quit();
}
