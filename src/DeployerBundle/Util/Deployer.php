<?php
/**
 * This file is part of the Deployer package.
 *
 * (c) anaXis nv <info@anaxis.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DeployerBundle\Util;

/**
 * @author Dries De Peuter <ddp@anaxis.be>
 */
class Deployer
{
    /**
     * @var DeployerConfig
     */
    protected $config;

    /**
     * @param DeployerConfig $config
     */
    public function setConfig(DeployerConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Deploy.
     */
    public function deploy()
    {
        var_dump('Done');
    }
}
