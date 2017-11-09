<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Loader;

use Phproberto\Joomla\Twig\Loader\LibraryLoader;

/**
 * LibraryLoader tests.
 *
 * @since   __DEPLOY_VERSION__
 */
class LibraryLoaderTest extends BaseExtensionLoaderTest
{
	/**
	 * getTemplatePaths returns correct paths.
	 *
	 * @return  void
	 */
	public function testGetTemplatePathsReturnsCorrectPaths()
	{
		$loader = new LibraryLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('getTemplatePaths');
		$method->setAccessible(true);

		$expected = [
			JPATH_BASE . '/templates/' . \JFactory::getApplication()->getTemplate() . '/html/libraries',
			JPATH_LIBRARIES
		];

		// Try to create any missing folder
		foreach ($expected as $folder)
		{
			if (!is_dir($folder) && !mkdir($folder))
			{
				throw new \Exception("Error creating folder " . $folder);
			}
		}

		$this->assertSame($expected, $method->invoke($loader));
	}

	/**
	 * parseExtensionName returns expected parts.
	 *
	 * @return  void
	 */
	public function testParseExtensionNameReturnsExpectedParts()
	{
		$loader = new LibraryLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('parseExtensionName');
		$method->setAccessible(true);

		$name = '@library/joomla/default.html.twig';
		$expected = '@library/joomla/layouts/default.html.twig';

		$this->assertSame($expected, $method->invoke($loader, $name));

		$name = '@library';
		$expected = '@library';

		$this->assertSame($expected, $method->invoke($loader, $name));
	}
}
