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
use DeployerBundle\Util\Config\Config;
use DeployerBundle\Util\Server\Server;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Create an executable Deployer.
 *
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class DeployerFactory
{
    /**
     * @var Queue
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
     * @param  Queue              $queue
     * @param  ContainerInterface $container
     * @return Deployer
     */
    public static function factory(Queue $queue, ContainerInterface $container)
    {
        $factory = new self($queue);

        return $factory->build($container);
    }

    /**
     * @param  ContainerInterface $container
     * @return Deployer
     */
    protected function build(ContainerInterface $container)
    {
        $deployer = new Deployer();
        $deployer->setConfig($this->getConfig($container));

        return $deployer;
    }

    /**
     * Build the configuration.
     *
     * @param  ContainerInterface $container
     * @return Config
     */
    protected function getConfig(ContainerInterface $container)
    {
        $config = new Config();
        $project = $this->findProject($container->getParameter('deployer.projects'));
        $servers = $this->findServers(
            $project['farm'],
            $container->getParameter('deployer.farms'),
            $container->getParameter('deployer.servers')
        );
        $config->setServers($servers);

        $config->setTargetPath($project['path']);

        return $config;
    }

    /**
     * @param  array      $projects
     * @return null|array
     */
    protected function findProject($projects)
    {
        if (array_key_exists($this->queue->getProject(), $projects)) {
            return $projects[$this->queue->getProject()];
        }

        return null;
    }

    /**
     * @param  string $farm
     * @param  array  $farms
     * @param  array  $oServers
     * @return array
     */
    protected function findServers($farm, $farms, $oServers)
    {
        $servers = array();

        if (array_key_exists($farm, $farms)) {
            $serverNames = array_map(function($item) {
                return $item[0];
            }, $farms[$farm]['servers']);

            foreach ($oServers as $name => $server) {
                if (in_array($name, $serverNames)) {
                    $servers[] = new Server($name, $server);
                }
            }
        }

        return $servers;
    }
}
