<?php
/**
 * This file is part of the Deployer package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DeployerBundle\Util\Executor;

use DeployerBundle\Util\Server\ServerInterface;
use DeployerBundle\Util\Task\TaskInterface;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class Executor implements ExecutorInterface
{
    /**
     * Execute a command on the local server.
     *
     * @param TaskInterface $task
     */
    public function execLocal(TaskInterface $task)
    {
        // TODO: Implement execLocal() method.
    }

    /**
     * Execute a command on the remote server.
     *
     * @param ServerInterface $server
     * @param TaskInterface   $task
     */
    public function execRemote(ServerInterface $server, TaskInterface $task)
    {
        // TODO: Implement execRemote() method.
    }
}
