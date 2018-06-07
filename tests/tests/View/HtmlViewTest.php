<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests;

defined('_JEXEC') || die;

use Joomla\CMS\Factory;
use Phproberto\Joomla\Twig\View\HtmlView;
use Phproberto\Joomla\Twig\Tests\View\Stubs\SampleTwigView;

/**
 * HtmlView tests.
 *
 * @since   __DEPLOY_VERSION__
 */
class HtmlViewTest extends \TestCase
{
	/**
	 * @test
	 *
	 * @return void
	 */
	public function classIsAbstract()
	{
		$reflection = new \ReflectionClass(HtmlView::class);

		$this->assertTrue($reflection->isAbstract());
	}

	/**
	 * @test
	 *
	 * @return void
	 */
	public function getLayoutDataReturnsExpectedData()
	{
		$view = $this->viewMock([], ['base_path' => __DIR__]);

		$reflection = new \ReflectionClass($view);
		$method = $reflection->getMethod('getLayoutData');
		$method->setAccessible(true);

		$data = $method->invoke($view);

		$this->assertSame($view, $data['view']);
	}

	/**
	 * @test
	 *
	 * @return void
	 */
	public function getOptionReturnsCorrectValue()
	{
		$view = $this->viewMock([], ['base_path' => __DIR__]);

		$this->assertSame('com_phproberto', $view->getOption());
	}

	/**
	 * Fast mock generator for abstract classes.
	 *
	 * @param   string  $class    Class name
	 * @param   array   $options  Options for getMockForAbstractClass
	 *
	 * @return  \PHPUnit_Framework_MockObject_MockObject
	 */
	protected function mockForAbstractClass($class, array $options = [])
	{
		$options = array_merge(
			[
				'arguments'               => [],
				'mockClassName'           => '',
				'callOriginalConstructor' => false,
				'callOriginalClone'       => true,
				'callAutoload'            => true,
				'methods'                 => [],
				'cloneArguments'          => false
			],
			$options
		);

		return $this->getMockForAbstractClass(
			$class,
			$options['arguments'],
			$options['mockClassName'],
			$options['callOriginalConstructor'],
			$options['callOriginalClone'],
			$options['callAutoload'],
			$options['methods'],
			$options['cloneArguments']
		);
	}

	/**
	 * Generate a view mock.
	 *
	 * @param   array   $methods  Mockable methods.
	 * @param   array   $config   Optional view configuration array.
	 *
	 * @return  HtmlView
	 */
	private function viewMock(array $methods = [], array $config = [])
	{
		return $this->mockForAbstractClass(
			HtmlView::class,
			[
				'methods'                 => $methods,
				'arguments'               => [$config],
				'callOriginalConstructor' => true
			]
		);
	}

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

		Factory::$config  = $this->getMockConfig();
		Factory::$session = $this->getMockSession();

		$app = $this->getMockCmsApp();
		$app->loadDispatcher(new \JEventDispatcher);
		$app->expects($this->any())
			->method('getTemplate')
			->will($this->returnValue('my_template'));

		$app->input->set('option', 'com_phproberto');

		Factory::$application = $app;
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
}
