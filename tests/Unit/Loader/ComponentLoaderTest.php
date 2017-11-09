<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Loader;

use Phproberto\Joomla\Twig\Loader\ComponentLoader;

/**
 * ComponentLoader tests.
 *
 * @since   __DEPLOY_VERSION__
 */
class ComponentLoaderTest extends BaseExtensionLoaderTest
{
	/**
	 * getTemplatePaths returns correct paths.
	 *
	 * @return  void
	 */
	public function testGetTemplatePathsReturnsCorrectPaths()
	{
		$loader = new ComponentLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('getTemplatePaths');
		$method->setAccessible(true);

		$expected = [
			JPATH_BASE . '/templates/' . \JFactory::getApplication()->getTemplate() . '/html',
			JPATH_BASE . '/components'
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
		$loader = new ComponentLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('parseExtensionName');
		$method->setAccessible(true);

		$name = '@component/com_users/login/default.html.twig';
		$expected = '@component/com_users/views/login/tmpl/default.html.twig';

		$this->assertSame($expected, $method->invoke($loader, $name));

		$name = '@component';
		$expected = '@component';

		$this->assertSame($expected, $method->invoke($loader, $name));
	}
}
