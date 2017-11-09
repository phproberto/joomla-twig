<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Loader\Stubs;

use Phproberto\Joomla\Twig\Loader\ExtensionLoader;

/**
 * Sample loader to test the base ExtensionLoader class.
 *
 * @since   __DEPLOY_VERSION__
 */
class SampleLoader extends ExtensionLoader
{
	/**
	 * Namespace applicable to this extension.
	 *
	 * @var  string
	 */
	protected $extensionNamespace = 'sample-loader';

	/**
	 * Get the paths to search for templates.
	 *
	 * @return  array
	 */
	protected function getTemplatePaths()
	{
		return [
			__DIR__ . '/tmpl'
		];
	}
}
