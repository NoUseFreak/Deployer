<?php
/**
 * This file is part of the Deployer package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DeployerBundle\Util\Config;

use DeployerBundle\Util\Server\ServerInterface;
use DeployerBundle\Util\Task\TaskInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class Config
{
    /**
     * @var ServerInterface[]
     */
    protected $servers = array();

    /**
     * @var TaskInterface[]
     */
    protected $preCheckoutTasks = array();

    /**
     * @var TaskInterface[]
     */
    protected $postCheckoutTasks = array();

    /**
     * @param ServerInterface[] $servers
     */
    public function setServers($servers)
    {
        $this->servers = $servers;
    }

    /**
     * @return ServerInterface[]
     */
    public function getServers()
    {
        return $this->servers;
    }

    /**
     * @param TaskInterface[] $postCheckoutTasks
     */
    public function setPostCheckoutTasks($postCheckoutTasks)
    {
        $this->postCheckoutTasks = $postCheckoutTasks;
    }

    /**
     * @return TaskInterface[]
     */
    public function getPostCheckoutTasks()
    {
        return $this->postCheckoutTasks;
    }

    /**
     * @param TaskInterface[] $preCheckoutTasks
     */
    public function setPreCheckoutTasks($preCheckoutTasks)
    {
        $this->preCheckoutTasks = $preCheckoutTasks;
    }

    /**
     * @return TaskInterface[]
     */
    public function getPreCheckoutTasks()
    {
        return $this->preCheckoutTasks;
    }
}
