<?php
/**
 * This file is part of the Deployer package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DeployerBundle\Util;

use DeployerBundle\Entity\Queue;

/**
 * Create an executable Deployer.
 *
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class DeployerFactory
{
    /**
     * @var \DeployerBundle\Entity\Queue
     */
    protected $queue;

    /**
     * @param Queue $queue
     */
    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
    }

    /**
     * Factory a Deployer instance.
     *
     * @param  Queue    $queue
     * @return Deployer
     */
    public static function factory(Queue $queue)
    {
        $factory = new self($queue);

        return $factory->build();
    }

    /**
     * @return Deployer
     */
    protected function build()
    {
        $deployer = new Deployer();
        $deployer->setConfig($this->getConfig());

        return $deployer;
    }

    /**
     * Build the configuration.
     *
     * @return DeployerConfig
     */
    protected function getConfig()
    {
        return new DeployerConfig();
    }
}
