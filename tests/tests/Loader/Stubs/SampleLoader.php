<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Loader\Stubs;

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
	 * Value that will be returned by parseExtensionName().
	 *
	 * @var  string
	 */
	public $parsedExtensionName;

	/**
	 * Get the paths to search for templates.
	 *
	 * @return  array
	 */
	protected function getTemplatePaths() : array
	{
		return [
			__DIR__ . '/tmpl'
		];
	}

	/**
	 * Parse a received extension name.
	 *
	 * @param   string  $name  Name of the template to search
	 *
	 * @return  string
	 */
	protected function parseExtensionName(string $name) : string
	{
		return $this->parsedExtensionName ?: parent::parseExtensionName($name);
	}
}
