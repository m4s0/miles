<?php

namespace AppBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Mink\Mink;
use Behat\MinkExtension\Context\MinkAwareContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class BaseContext
 *
 * @package AppBundle\Features\Context
 */
class BaseContext implements Context, KernelAwareContext, MinkAwareContext
{
    /**
     * @var KernelInterface
     */
    protected $kernel;
    /**
     * @var Mink
     */
    protected $mink;

    /**
     * Sets Kernel instance.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Sets Mink instance.
     *
     * @param Mink $mink Mink session manager
     */
    public function setMink(Mink $mink)
    {
        $this->mink = $mink;
    }

    /**
     * Sets parameters provided for Mink.
     *
     * @param array $parameters
     */
    public function setMinkParameters(array $parameters)
    {
        // TODO: Implement setMinkParameters() method.
    }

    /**
     * @param $serviceIdentifier
     *
     * @return object
     */
    public function getService($serviceIdentifier)
    {
        return $this->kernel->getContainer()->get($serviceIdentifier);
    }

    /**
     * @return \Behat\Mink\Session
     */
    public function getSession()
    {
        return $this->mink->getSession();
    }

    /**
     * @BeforeScenario
     */
    public function setUp()
    {
        $connection = $this->getService('doctrine.orm.default_entity_manager')->getConnection();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $connection->query('TRUNCATE TABLE rate');
        $connection->query('TRUNCATE TABLE vine');
        $connection->query('TRUNCATE TABLE wine');
        $connection->query('TRUNCATE TABLE winery');
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
    }
}