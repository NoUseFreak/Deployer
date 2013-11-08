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
class DeployerConfig
{
    /**
     * @var Server[]
     */
    protected $servers = array();

    /**
     * @var Task[]
     */
    protected $preCheckoutTasks = array();

	/**
	 * @var Task[]
	 */
	protected $postCheckoutTasks = array();

    /**
     * @param Server[] $servers
     */
    public function setServers($servers)
    {
        $this->servers = $servers;
    }

    /**
     * @return Server[]
     */
    public function getServers()
    {
        return $this->servers;
    }

	/**
	 * @param Task[] $postCheckoutTasks
	 */
	public function setPostCheckoutTasks($postCheckoutTasks)
	{
		$this->postCheckoutTasks = $postCheckoutTasks;
	}

	/**
	 * @return Task[]
	 */
	public function getPostCheckoutTasks()
	{
		return $this->postCheckoutTasks;
	}

	/**
	 * @param Task[] $preCheckoutTasks
	 */
	public function setPreCheckoutTasks($preCheckoutTasks)
	{
		$this->preCheckoutTasks = $preCheckoutTasks;
	}

	/**
	 * @return Task[]
	 */
	public function getPreCheckoutTasks()
	{
		return $this->preCheckoutTasks;
	}
}
