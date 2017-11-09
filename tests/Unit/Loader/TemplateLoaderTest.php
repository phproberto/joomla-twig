<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Loader;

use Phproberto\Joomla\Twig\Loader\TemplateLoader;

/**
 * TemplateLoader tests.
 *
 * @since   __DEPLOY_VERSION__
 */
class TemplateLoaderTest extends BaseExtensionLoaderTest
{
	/**
	 * getTemplatePaths returns correct paths.
	 *
	 * @return  void
	 */
	public function testGetTemplatePathsReturnsCorrectPaths()
	{
		$loader = new TemplateLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('getTemplatePaths');
		$method->setAccessible(true);

		$expected = [
			JPATH_BASE . '/templates/' . \JFactory::getApplication()->getTemplate() . '/html'
		];

		$this->assertSame($expected, $method->invoke($loader));
	}
}
