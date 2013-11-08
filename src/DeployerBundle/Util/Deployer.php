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

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class Deployer
{
    /**
     * @var DeployerConfig
     */
    protected $config;

    /**
     * @param DeployerConfig $config
     */
    public function setConfig(DeployerConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Deploy.
     */
    public function deploy()
    {
		$this->doPreScripts();
		$this->doCheckout();
		$this->doPostScripts();

		foreach ($this->config->getServers() as $server) {
			$this->doServerDeploy($server);
		}

        var_dump('Done');
    }

	/**
	 * Execute pre checkout scripts.
	 */
	protected function doPreScripts()
	{

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

	}

	/**
	 * @param Server $server
	 */
	protected function doServerDeploy(Server $server)
	{

	}

	/**
	 * Execute a command on the local server.
	 *
	 * @param Command $command
	 */
	protected function execLocal(Command $command)
	{

	}

	/**
	 * Execute a command on the remote server.
	 *
	 * @param Command $command
	 * @param Server $server
	 */
	protected function execRemote(Command $command, Server $server)
	{

	}
}
