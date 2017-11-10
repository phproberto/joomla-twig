<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Plugin;

use Phproberto\Joomla\Twig\Plugin\BasePlugin;
use Phproberto\Joomla\Twig\Tests\Unit\Plugin\Stubs\SamplePlugin;

/**
 * BasePlugin tests.
 *
 * @since   __DEPLOY_VERSION__
 */
class BasePluginTest extends \TestCase
{
	/**
	 * pluginPath returns correct path.
	 *
	 * @return  void
	 */
	public function testPluginPathReturnsCorrectPath()
	{
		$plugin = new SamplePlugin;

		$reflection = new \ReflectionClass($plugin);
		$method = $reflection->getMethod('pluginPath');
		$method->setAccessible(true);

		$this->assertSame(__DIR__ . '/Stubs', $method->invoke($plugin));
	}
}
