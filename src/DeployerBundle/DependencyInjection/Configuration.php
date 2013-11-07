<?php
/**
 * This file is part of the Deployer package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DeployerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('deployer');

        $this->addServerSection($rootNode);
        $this->addFarmSection($rootNode);
        $this->addProjectSection($rootNode);

        return $treeBuilder;
    }

    protected function addServerSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('servers')
                ->useAttributeAsKey('id')
                ->prototype('array')
                    ->children()
                        ->scalarNode('hostname')->cannotBeEmpty()->end()
                        ->scalarNode('ip')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    protected function addFarmSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('farms')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                    ->children()
                        ->arrayNode('servers')
                            ->prototype('array')
                                ->performNoDeepMerging()
                                ->beforeNormalization()
                                ->ifString()
                                    ->then(function($v) { return array('value' => $v); })
                                ->end()
                                ->beforeNormalization()
                                ->ifTrue(function($v) { return is_array($v) && isset($v['value']); })
                                    ->then(function($v) { return preg_split('/\s*,\s*/', $v['value']); })
                                ->end()
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
        ;
    }

    protected function addProjectSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('projects')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                    ->children()
                        ->scalarNode('name')->cannotBeEmpty()->end()
                        ->scalarNode('farm')->cannotBeEmpty()->end()
                        ->arrayNode('before_script')
                            ->prototype('array')
                                ->performNoDeepMerging()
                                ->beforeNormalization()
                                ->ifString()
                                    ->then(function($v) { return array('value' => $v); })
                                ->end()
                                ->beforeNormalization()
                                ->ifTrue(function($v) { return is_array($v) && isset($v['value']); })
                                    ->then(function($v) { return preg_split('/\s*,\s*/', $v['value']); })
                                ->end()
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                        ->arrayNode('after_script')
                            ->prototype('array')
                                ->performNoDeepMerging()
                                ->beforeNormalization()
                                ->ifString()
                                    ->then(function($v) { return array('value' => $v); })
                                ->end()
                                ->beforeNormalization()
                                ->ifTrue(function($v) { return is_array($v) && isset($v['value']); })
                                    ->then(function($v) { return preg_split('/\s*,\s*/', $v['value']); })
                                ->end()
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
