<?php
/**
 * This file is part of the Deployer package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DeployerBundle\Util\Task;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
interface TaskInterface
{
    /**
     * @return string
     */
    public function getCommand();
}
