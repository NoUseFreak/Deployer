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

use DeployerBundle\Util\Config\Config;
use DeployerBundle\Util\Executor\Executor;
use DeployerBundle\Util\Server\Server;
use DeployerBundle\Util\Server\ServerInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class Deployer
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Executor
     */
    protected $executor;

    /**
     * @param Config $config
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Deploy.
     */
    public function deploy()
    {
        $this->init();

        $this->doPreScripts();
        $this->doCheckout();
        $this->doPostScripts();

        foreach ($this->config->getServers() as $server) {
            $this->doServerDeploy($server);
        }

        var_dump('Done');
    }

    protected function init()
    {
        $this->executor = new Executor();
    }

    /**
     * Execute pre checkout scripts.
     */
    protected function doPreScripts()
    {
        foreach ($this->config->getPreCheckoutTasks() as $task) {
            $this->executor->execLocal($task);
        }
    }

    /**
     * Checkout/update the local code.
     */
    protected function doCheckout()
    {

    }

    /**
     * Execute post checkout scripts.
     */
    protected function doPostScripts()
    {
        foreach ($this->config->getPostCheckoutTasks() as $task) {
            $this->executor->execLocal($task);
        }
    }

    /**
     * @param ServerInterface $server
     */
    protected function doServerDeploy(ServerInterface $server)
    {

    }
}
