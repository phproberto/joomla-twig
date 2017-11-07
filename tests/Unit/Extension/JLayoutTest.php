<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Extension;

use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;
use Phproberto\Joomla\Twig\Extension\JLayout;

/**
 * JLayout extension test.
 *
 * @since   __DEPLOY_VERSION__
 */
class JLayoutTest extends \TestCase
{
	private $extension;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 */
	protected function setUp()
	{
		parent::setUp();
		$this->saveFactoryState();
		\JFactory::$application = $this->getMockCmsApp();

		$this->extension = new JLayout;
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
	 * Test getFunctions returns correct data.
	 *
	 * @return  void
	 */
	public function testGetFunctionsReturnsCorrectData()
	{
		$expectedFunctions = $this->expectedFunctions();
		$functions = $this->extension->getFunctions();

		$this->assertEquals(count($expectedFunctions), count($functions));

		foreach ($functions as $function)
		{
			$callable = $function->getCallable();
			$functionName = $function->getName();

			$this->assertTrue(array_key_exists($functionName, $expectedFunctions));

			$expectedFunction = $expectedFunctions[$functionName];

			$callableClass = is_string($callable[0]) ? $callable[0] : get_class($callable[0]);
			$callableMethod = $callable[1];

			$this->assertTrue(is_callable($callable));

			$this->assertEquals($expectedFunction['class'], $callableClass);
			$this->assertEquals($expectedFunction['method'], $callableMethod);
		}
	}

	/**
	 * getName returns correct name.
	 *
	 * @return  void
	 */
	public function testGetNameReturnsCorrectName()
	{
		$this->assertEquals('jlayout', $this->extension->getName());
	}

	/**
	 * jlayout returns a FileLayout instance.
	 *
	 * @return  void
	 */
	public function testJlayoutReturnsAFileLayoutInstance()
	{
		$fileLayout = $this->extension->getFileLayout('joomla.system.message');

		$this->assertInstanceOf(FileLayout::class, $fileLayout);
		$this->assertSame('joomla.system.message', $fileLayout->getLayoutId());
	}

	/**
	 * Functions expected to be added by the extension.
	 *
	 * @return  array
	 */
	private function expectedFunctions()
	{
		return [
			'jlayout'        => [
				'class'  => JLayout::class,
				'method' => 'getFileLayout'
			],
			'jlayout_render' => [
				'class'  => LayoutHelper::class,
				'method' => 'render'
			],
			'jlayout_debug'  => [
				'class'  => LayoutHelper::class,
				'method' => 'debug'
			]
		];
	}
}
