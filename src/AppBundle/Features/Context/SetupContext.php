<?php

namespace AppBundle\Features\Context;

use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use AppBundle\Features\Context\Fixtures\Vine;
use AppBundle\Features\Context\Fixtures\Winery;

class SetupContext extends BaseContext
{
    /**
     * @Given There is a Vine with the following attributes
     */
    public function thereIsAVineWithTheFollowingAttributes(TableNode $table)
    {
        $em = $this->getService('doctrine.orm.default_entity_manager');

        $fields = $table->getRow(1);

        $vineFixtures = new Vine($em);
        $vineFixtures->generate($fields[0], $fields[1]);

    }

    /**
     * @Given There is a Winery with the following attributes
     */
    public function thereIsAWineryWithTheFollowingAttributes(TableNode $table)
    {
        $em = $this->getService('doctrine.orm.default_entity_manager');

        $fields = $table->getRow(1);

        $vineFixtures = new Winery($em);
        $vineFixtures->generate($fields[0], $fields[1], $fields[2], $fields[3]);
    }
}
