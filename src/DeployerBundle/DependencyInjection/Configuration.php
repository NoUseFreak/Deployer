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

		$rootNode
			->children()
				->arrayNode('servers')
					->useAttributeAsKey('id')
					->prototype('array')
					->children()
						->scalarNode('hostname')->cannotBeEmpty()->end()
						->scalarNode('ip')->cannotBeEmpty()->end()
					->end()
				->end()->end()
				->arrayNode('farms')
					->useAttributeAsKey('name')
					->prototype('array')
					->children()
						->arrayNode('servers')
							->prototype('array')
								->performNoDeepMerging()
								->beforeNormalization()->ifString()->then(function($v) { return array('value' => $v); })->end()
								->beforeNormalization()
									->ifTrue(function($v) { return is_array($v) && isset($v['value']); })
									->then(function($v) { return preg_split('/\s*,\s*/', $v['value']); })
								->end()
								->prototype('scalar')->end()
							->end()
						->end()
					->end()
				->end()->end()
			->end()
		;

		return $treeBuilder;
	}
}
