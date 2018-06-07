<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests;

use Twig\Loader\LoaderInterface;
use Phproberto\Joomla\Twig\Environment;
use Joomla\CMS\Application\CMSApplication;

/**
 * Environment tests.
 *
 * @since   __DEPLOY_VERSION__
 */
class EnvironmentTest extends \TestCaseDatabase
{
	/**
	 * Events called by the environment.
	 *
	 * @var  array
	 */
	protected $calledEvents = [];

	/**
	 * Dispatcher used for testing.
	 *
	 * @var  \JEventDispatcher
	 */
	protected $dispatcher;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 *
	 * @since   3.2
	 */
	protected function setUp()
	{
		$this->saveFactoryState();

		\JFactory::$config  = $this->getMockConfig();
		\JFactory::$session = $this->getMockSession(['getId' => uniqid()]);

		$this->dispatcher      = new \JEventDispatcher;
		\TestReflection::setValue($this->dispatcher, 'instance', $this->dispatcher);

		$app = $this->getMockForAbstractClass(CMSApplication::class);
		$app->loadDispatcher($this->dispatcher);

		\JFactory::$application = $app;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return  void
	 *
	 * @since   3.2
	 */
	protected function tearDown()
	{
		$this->restoreFactoryState();

		parent::tearDown();

		\TestReflection::setValue($this->dispatcher, 'instance', null);
	}

	/**
	 * Constructor triggers events.
	 *
	 * @return  void
	 */
	public function testConstructorTriggersEvents()
	{
		$this->calledEvents = [];

		\JFactory::$application->registerEvent('onTwigBeforeLoad', [$this, 'onTwigBeforeLoad']);
		\JFactory::$application->registerEvent('onTwigAfterLoad', [$this, 'onTwigAfterLoad']);

		$loader = new \Twig_Loader_Array;
		$options = ['sample' => 'option'];
		$environment = new Environment($loader, $options);

		// Test onTwigBeforeLoad result
		$this->assertTrue(isset($this->calledEvents['onTwigBeforeLoad']));
		$this->assertSame($environment, $this->calledEvents['onTwigBeforeLoad'][0]);
		$this->assertSame($loader, $this->calledEvents['onTwigBeforeLoad'][1]);
		$this->assertSame($options, $this->calledEvents['onTwigBeforeLoad'][2]);

		// Test onTwigAfterLoad result
		$this->assertTrue(isset($this->calledEvents['onTwigAfterLoad']));
		$this->assertSame($environment, $this->calledEvents['onTwigAfterLoad'][0]);
	}

	/**
	 * @test
	 *
	 * @return void
	 */
	public function triggerReturnsArrayForNonRegisteredEvent()
	{
		$loader = new \Twig_Loader_Array;
		$options = ['sample' => 'option'];
		$environment = new Environment($loader, $options);

		$this->assertSame([], $environment->trigger('onUnexistingEvent'));
	}

	/**
	 * Triggered before environment has been loaded.
	 *
	 * @param   Environment      $environment  Loaded environment
	 * @param   LoaderInterface  $loader       Loader going to be sent to environment
	 * @param   array            $options      Options to initialise environment
	 *
	 * @return  void
	 */
	public function onTwigBeforeLoad(Environment $environment, LoaderInterface $loader, &$options)
	{
		$this->calledEvents['onTwigBeforeLoad'] = func_get_args();

		// Ensure that loader can be modified
		$loader->setTemplate('EnvironmentTest', __DIR__);

		// Ensure that options can be modified
		$options['sample'] = 'modified';
	}

	/**
	 * Triggered after environment has been loaded.
	 *
	 * @param   Environment  $environment  Loaded environment
	 * @param   array        $options      Options to initialise environment
	 *
	 * @return  void
	 */
	public function onTwigAfterLoad(Environment $environment, $options = [])
	{
		$this->calledEvents['onTwigAfterLoad'] = func_get_args();

		$this->assertSame('modified', $options['sample']);
		$this->assertTrue($environment->getLoader()->exists('EnvironmentTest'));
	}
}
