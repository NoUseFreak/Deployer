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
class Task implements TaskInterface
{
    /**
     * @var string
     */
    protected $command;

    /**
     * @param string $command
     */
    public function __construct($command = null)
    {
        $this->command = $command;
    }
    /**
     * @param string $command
     */
    public function setCommand($command)
    {
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }
}
