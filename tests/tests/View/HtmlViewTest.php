<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\View;

defined('_JEXEC') || die;

use Joomla\CMS\Factory;
use Phproberto\Joomla\Twig\Twig;
use Phproberto\Joomla\Twig\Environment;
use Phproberto\Joomla\Twig\View\HtmlView;

/**
 * HtmlView tests.
 *
 * @since   1.2.0
 */
class HtmlViewTest extends \TestCaseDatabase
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
	public function loadTemplateReturnsCorrectOutput()
	{
		$loader = new \Twig_Loader_Array(
			[
				'@component/com_phproberto/test/default.html.twig' => 'view: {{ view.getName()}} - layout: {{ view.getLayout() }}',
				'@component/com_phproberto/test2/another.html.twig' => 'view: {{ view.getName()}} - layout: {{ view.getLayout() }}'
			]
		);
		$environment = new Environment($loader);

		$twig = Twig::instance();

		$twigReflection = new \ReflectionClass($twig);

		$environmentProperty = $twigReflection->getProperty('environment');
		$environmentProperty->setAccessible(true);
		$environmentProperty->setValue($twig, $environment);

		$instanceProperty = $twigReflection->getProperty('instance');
		$instanceProperty->setAccessible(true);
		$instanceProperty->setValue($twig, $twig);

		$view = $this->mockForAbstractClass(
			HtmlView::class,
			[
				'mockClassName' => 'PhprobertoViewTest'
			]
		);

		$this->assertSame('view: test - layout: default', $view->loadTemplate());
		$this->assertSame('view: test - layout: default', $view->loadTemplate('inexistent-layout'));

		$view = $this->mockForAbstractClass(
			HtmlView::class,
			[
				'mockClassName' => 'PhprobertoViewTest2',
				'methods' => ['getLayout']
			]
		);

		$view->method('getLayout')
			->willReturn('another');

		$this->assertSame('view: test2 - layout: another', $view->loadTemplate());
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
