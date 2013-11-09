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
interface ServerInterface
{
    /**
     * Get the alias to connect to the server using ssh.
     * This should be the name as configured in the ~/.ssh/config
     *
     * @return string
     */
    public function getAlias();
}
