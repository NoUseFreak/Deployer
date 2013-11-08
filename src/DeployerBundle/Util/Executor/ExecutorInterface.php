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
interface ExecutorInterface
{
	/**
	 * Execute a command on the local server.
	 *
	 * @param TaskInterface $task
	 */
	public function execLocal(TaskInterface $task);

	/**
	 * Execute a command on the remote server.
	 *
	 * @param ServerInterface $server
	 * @param TaskInterface   $task
	 */
	public function execRemote(ServerInterface $server, TaskInterface $task);
}
