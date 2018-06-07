<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Plugin;

use Phproberto\Joomla\Twig\Plugin\BasePlugin;
use Phproberto\Joomla\Twig\Tests\Plugin\Stubs\SamplePlugin;

/**
 * BasePlugin tests.
 *
 * @since   __DEPLOY_VERSION__
 */
class BasePluginTest extends \TestCase
{
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 */
	protected function setUp()
	{
		$this->saveFactoryState();

		\JFactory::$config      = $this->getMockConfig();
		\JFactory::$application = $this->getMockCmsApp();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return  void
	 */
	protected function tearDown()
	{
		$this->restoreFactoryState();
		parent::tearDown();
	}

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
