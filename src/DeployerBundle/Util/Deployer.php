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
use DeployerBundle\Util\Server\ServerInterface;
use DeployerBundle\Util\Task\Task;

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

        $this->output(sprintf('Deploying  to [%s]', implode(', ', $this->config->getServers())));

        $this->doPreScripts();
        $this->doCheckout();
        $this->doPostScripts();

        foreach ($this->config->getServers() as $server) {
            $this->doServerDeploy($server);
        }

        $this->output('Done');
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
        $rsyncCommand = sprintf('rsync -avz %s %s', $this->getCheckoutPath(), $this->getTargetPath($server));
        $this->executor->execLocal(new Task($rsyncCommand));
    }

    /**
     * Get the path where the project will be build locally.
     *
     * @return string
     */
    protected function getCheckoutPath()
    {
        return '/tmp/checkouts';
    }

    /**
     * Return the target path on the server.
     *
     * @param  ServerInterface $server
     * @return string
     */
    protected function getTargetPath(ServerInterface $server)
    {
        return sprintf('%s:%s', $server->getAlias(), $this->config->getTargetPath());
    }

    /**
     * @param $string
     */
    protected function output($string)
    {
        echo $string . PHP_EOL;
    }
}
