<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests;

use Joomla\Registry\Registry;
use Phproberto\Joomla\Twig\Twig;
use Twig\Loader\ChainLoader;
use Phproberto\Joomla\Twig\Environment;
use Joomla\CMS\Application\SiteApplication;

/**
 * Twig tests.
 *
 * @since   __DEPLOY_VERSION__
 */
class TwigTest extends \TestCaseDatabase
{
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

		$_SERVER['HTTP_HOST'] = 'mydomain.com';
		$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0';
		$_SERVER['REQUEST_URI'] = '/index.php';
		$_SERVER['SCRIPT_NAME'] = '/index.php';

		\JFactory::$document = $this->getMockDocument();
		\JFactory::$language = $this->getMockLanguage();
		\JFactory::$session  = $this->getMockSession();
		\JFactory::$application = new SiteApplication($this->getMockInput(), new Registry(['session' => false]));

		$this->twig = Twig::instance();
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
		Twig::clear();
	}

	/**
	 * Gets the data set to be loaded into the database during setup
	 *
	 * @return  \PHPUnit_Extensions_Database_DataSet_CsvDataSet
	 */
	protected function getDataSet()
	{
		$dataSet = new \PHPUnit_Extensions_Database_DataSet_CsvDataSet(',', "'", '\\');
		$dataSet->addTable('jos_extensions', JPATH_TEST_DATABASE . '/jos_extensions.csv');
		$dataSet->addTable('jos_template_styles', JPATH_TEST_DATABASE . '/jos_template_styles.csv');

		return $dataSet;
	}

	/**
	 * clear removes cached instance.
	 *
	 * @return  void
	 */
	public function testClearRemovesCachedInstance()
	{
		$reflection = new \ReflectionClass($this->twig);

		$instanceProperty = $reflection->getProperty('instance');
		$instanceProperty->setAccessible(true);

		$this->assertInstanceOf(Twig::class, $instanceProperty->getValue($this->twig));

		Twig::clear();

		$this->assertSame(null, $instanceProperty->getValue($this->twig));
	}

	/**
	 * instance returns cached instance.
	 *
	 * @return  void
	 */
	public function testInstanceReturnsCachedInstance()
	{
		$loader = new \Twig_Loader_Array(['test' => 'hello {{ name }}']);
		$environment = new Environment($loader);

		$reflection = new \ReflectionClass($this->twig);

		$environmentProperty = $reflection->getProperty('environment');
		$environmentProperty->setAccessible(true);
		$environmentProperty->setValue($this->twig, $environment);

		$newInstance = Twig::instance();

		$this->assertSame($environment, $environmentProperty->getValue($newInstance));
	}

	/**
	 * Constructor is private.
	 *
	 * @return  void
	 */
	public function testConstructorIsPrivate()
	{
		$reflection = new \ReflectionClass($this->twig);
		$constructor = $reflection->getConstructor();

		$this->assertTrue($constructor->isPrivate());
	}

	/**
	 * Constructor sets environment.
	 *
	 * @return  void
	 */
	public function testConstructorSetsEnvironment()
	{
		$reflection = new \ReflectionClass($this->twig);

		$environmentProperty = $reflection->getProperty('environment');
		$environmentProperty->setAccessible(true);

		$environment = $environmentProperty->getValue($this->twig);

		$this->assertInstanceOf(Environment::class, $environment);
		$this->assertInstanceOf(ChainLoader::class, $environment->getLoader());
	}

	/**
	 * render calls environment render method.
	 *
	 * @return  void
	 */
	public function testRenderCallsEnvironmentRenderMethod()
	{
		$layout   = 'test';
		$data     = ['name' => 'Roberto'];
		$tpl      = 'Hello {{ name }}!';
		$expected = 'Hello Roberto!';

		$loader = new \Twig_Loader_Array([$layout => $tpl]);
		$environment = new Environment($loader);

		$reflection = new \ReflectionClass($this->twig);

		$environmentProperty = $reflection->getProperty('environment');
		$environmentProperty->setAccessible(true);
		$environmentProperty->setValue($this->twig, $environment);

		$this->assertSame($expected, Twig::render($layout, $data));
	}

	/**
	 * environment returns property value.
	 *
	 * @return  void
	 */
	public function testEnvironemtReturnsPropertyValue()
	{
		$loader = new \Twig_Loader_Array(['test' => 'hello {{ name }}']);
		$environment = new Environment($loader);

		$reflection = new \ReflectionClass($this->twig);

		$environmentProperty = $reflection->getProperty('environment');
		$environmentProperty->setAccessible(true);
		$environmentProperty->setValue($this->twig, $environment);

		$this->assertSame($environment, $this->twig->environment());
	}
}
