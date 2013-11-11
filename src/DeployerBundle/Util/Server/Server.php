<?php
/**
 * This file is part of the Deployer package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DeployerBundle\Util\Server;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class Server implements ServerInterface
{
    /**
     * @var
     */
    protected $alias;

    /**
     * @param $alias
     * @param array $record
     */
    public function __construct($alias, array $record)
    {
        $this->alias = $alias;
    }

    /**
     * Get the alias to connect to the server using ssh.
     * This should be the name as configured in the ~/.ssh/config
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getAlias();
    }
}
