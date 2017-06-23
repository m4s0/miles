<?php

namespace AppBundle\Features\Context;

use Behat\Gherkin\Node\TableNode;
use AppBundle\Features\Context\Fixtures\Vine;
use AppBundle\Features\Context\Fixtures\Winery;

class SetupContext extends BaseContext
{
    /**
     * @Given There are Vines with the following attributes
     */
    public function thereAreVinesWithTheFollowingAttributes(TableNode $table)
    {
        $em = $this->getService('doctrine.orm.default_entity_manager');

        $hash = $table->getHash();
        foreach ($hash as $row) {
            $vineFixtures = new Vine($em);
            $vineFixtures->generate($row['name'], $row['grapes']);
        }
    }

    /**
     * @Given There is a Winery with the following attributes
     */
    public function thereIsAWineryWithTheFollowingAttributes(TableNode $table)
    {
        $em = $this->getService('doctrine.orm.default_entity_manager');

        $hash = $table->getHash();
        foreach ($hash as $row) {
            $vineFixtures = new Winery($em);
            $vineFixtures->generate($row['name'], $row['city'], $row['region'], $row['country']);
        }
    }
}
