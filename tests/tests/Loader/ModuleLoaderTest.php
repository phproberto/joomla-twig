<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Loader;

use Phproberto\Joomla\Twig\Loader\ModuleLoader;

/**
 * ModuleLoader tests.
 *
 * @since   __DEPLOY_VERSION__
 */
class ModuleLoaderTest extends BaseExtensionLoaderTest
{
	/**
	 * getTemplatePaths returns correct paths.
	 *
	 * @return  void
	 */
	public function testGetTemplatePathsReturnsCorrectPaths()
	{
		$loader = new ModuleLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('getTemplatePaths');
		$method->setAccessible(true);

		$expected = [
			JPATH_BASE . '/templates/' . \JFactory::getApplication()->getTemplate() . '/html',
			JPATH_BASE . '/modules'
		];

		$this->assertSame($expected, $method->invoke($loader));
	}

	/**
	 * parseExtensionName returns expected parts.
	 *
	 * @return  void
	 */
	public function testParseExtensionNameReturnsExpectedParts()
	{
		$loader = new ModuleLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('parseExtensionName');
		$method->setAccessible(true);

		$name = '@module/mod_menu/default.html.twig';
		$expected = '@module/mod_menu/tmpl/default.html.twig';

		$this->assertSame($expected, $method->invoke($loader, $name));

		$name = '@module';
		$expected = '@module';

		$this->assertSame($expected, $method->invoke($loader, $name));
	}
}
