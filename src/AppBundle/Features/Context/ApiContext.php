<?php

namespace AppBundle\Features\Context;

use Behat\Gherkin\Node\TableNode;
use Symfony\Component\HttpFoundation\Response;
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
     * @When I send a :method request to :resource with payload
     */
    public function iSendARequestToWithPayload($method, $resource, TableNode $table)
    {
        $this->client = $this->getSession()->getDriver()->getClient();

        $payload = $table->getHash()[0];

        $this->client->request($method, $resource, $payload);
    }

    /**
     * @Then I should get a success response
     */
    public function iShouldGetASuccessResponse()
    {
        $response = $this->client->getResponse();

        Assert::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    /**
     * @Then I should get a error response
     */
    public function iShouldGetAErrorResponse()
    {
        $response = $this->client->getResponse();

        Assert::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}
