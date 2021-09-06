<?php

declare(strict_types=1);

namespace Sjerd\LaravelRevenueCat;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class RevenueCatApi
{
    protected $apiKey = null;
    protected $authorizationHeader = null;
    protected $httpClient = null;
    protected $userId = null;
    protected $subscriber = null;

    /**
     * Create a new service instance with revenuecat server config.
     */
    public function __construct()
    {
        $this->apiKey = config('REVENUECAT_API_KEY');
        $this->authorizationHeader = sprintf('Bearer %s', $this->apiKey);

        $this->httpClient = new Client(['headers' => [
            'base_uri' => 'https://api.revenuecat.com/v1/',
            'Accept' => 'application/json',
            'Authorization' => $this->authorizationHeader,
            'Content-Type' => 'application/json',
            'X-Platform' => 'ios'
        ]]);
    }

    /**
     * check if user is subscribed to product
     *
     * @param string $userId            the user to return
     * @param string $subscriptiontype  optional, default is monthly
     *
     * @return string Returns the api response
     */
    public function isSubscribed($options = [
        'user_id' => null,
        'product_identifier' => 'monthly'
    ]): bool
    {
        $this->checkUserId($options['user_id']);

        if ($this->subscriber !== null) {
            $user = $this->subscriber;
        } else {
            $user = $this->getSubscriber($this->getUserId($options['user_id']));
        }

        return $user['subscriber']['subscriptions'][$options['product_identifier']]['ownership_type'] === "PURCHASED";
    }

    /**
     * Get or create a subscriber by user id
     *
     * @param string $userId the user to return
     *
     * @return string Returns the subscriber
     */
    public function getSubscriber(string $userId): object
    {
        $this->checkUserId($userId);

        $this->userId = $userId;

        $response = $this->getRequest(`subscribers/$this->userId`);

        $this->subscriber = $response->getBody();

        return $this->subscriber;
    }

    /**
     * Get or create a subscriber by user id
     *
     * @param string $userId the user to return
     *
     * @return string Returns the deleted user id
     */
    public function deleteSubscriber(string $userId = null): object
    {
        $this->checkUserId($userId);

        $response = $this->deleteRequest(`subscribers/` + $this->getUserId($userId));

        return $response->getBody();
    }

    /**
     * Makes a get request to RevenueCat api
     *
     * @param string $url the user to return
     *
     * @return object Returns the request response
     */
    protected function getRequest(string $url): object
    {
        try {
            return $this->client->request('GET', $url);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                throw new \Exception(Psr7\Message::toString($e->getResponse()));
            }
        }
    }

    /**
     * Makes a delete request to RevenueCat api
     *
     * @param string $url the url for the request
     *
     * @return object Returns the deleted request response
     */
    protected function deleteRequest(string $url): object
    {
        try {
            return $this->client->request('DELETE', $url);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                throw new \Exception(Psr7\Message::toString($e->getResponse()));
            }
        }
    }

    protected function checkUserId($userId)
    {
        if ($this->subscriber === null && $userId === null) {
            throw new \Exception('No user_id given or subscriber set.');
        }
    }

    protected function getUserId($userId)
    {
        return $userId === null ? $this->userId : $userId;
    }
}
