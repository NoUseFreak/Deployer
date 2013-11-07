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
    protected $tasks = array();

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
     * @param Task[] $tasks
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return Task[]
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}
