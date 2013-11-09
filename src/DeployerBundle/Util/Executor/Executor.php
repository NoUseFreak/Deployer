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
use Symfony\Component\Process\Process;

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
        $process = new Process($task->getCommand());
        $process->run();
    }

    /**
     * Execute a command on the remote server.
     *
     * @param ServerInterface $server
     * @param TaskInterface   $task
     */
    public function execRemote(ServerInterface $server, TaskInterface $task)
    {
        $command = sprintf('ssh %s %s', $server->getAlias(), $task->getCommand());
        $process = new Process($command);
        $process->run();
    }
}
