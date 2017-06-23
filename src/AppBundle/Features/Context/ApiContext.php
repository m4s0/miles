<?php

namespace AppBundle\Features\Context;

use Symfony\Component\HttpKernel\Client;
use PHPUnit\Framework\Assert;

/**
 * Class ApiContext
 *
 * @package AppBundle\Features\Context
 */
class ApiContext extends BaseContext
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @When I send a :method request to :resource :content
     * @When I send a :method request to :resource
     */
    public function iSendARequestTo($method, $resource, $content = null)
    {
        $this->client = $this->getSession()->getDriver()->getClient();

        $this->client->request(
            $method,
            $resource,
            [],
            [],
            [ 'Content-Type' => 'application/json' ],
            null !== $content ? $content->getRaw() : null
        );
//        $this->client->request()->headers->get('User-Agent');7
    }

    /**
     * @Then I should get a response with code :code and message
     */
    public function iShouldGetAResponseWithCodeAndMessage($code, $message)
    {
        $response = $this->client->getResponse();

        Assert::assertEquals($code, $response->getStatusCode());
        Assert::assertEquals(json_encode(json_decode($message->getRaw(), true)), $response->getContent());
    }
}
