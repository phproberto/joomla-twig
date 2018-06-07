<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Module;

use Joomla\CMS\Factory;
use Twig\Loader\ArrayLoader;
use Joomla\Registry\Registry;
use Phproberto\Joomla\Twig\Twig;
use Phproberto\Joomla\Twig\Environment;
use Joomla\CMS\Application\SiteApplication;
use Phproberto\Joomla\Twig\Tests\Mock\TwigMock;
use Phproberto\Joomla\Twig\Module\BaseTwigModule;
use Phproberto\Joomla\Twig\Tests\Module\Stubs\SampleTwigModule;

defined('_JEXEC') || die;

/**
 * BaseTwigModule tests.
 *
 * @since   __DEPLOY_VERSION__
 */
class BaseTwigModuleTest extends \TestCaseDatabase
{
	/**
	 * @test
	 *
	 * @return void
	 */
	public function classIsAbstract()
	{
		$reflection = new \ReflectionClass(BaseTwigModule::class);

		$this->assertTrue($reflection->isAbstract());
	}

	/**
	 * @test
	 *
	 * @return void
	 */
	public function getLayoutDataReturnsExpectedData()
	{
		$module = new SampleTwigModule;

		$reflection = new \ReflectionClass($module);
		$method = $reflection->getMethod('getLayoutData');
		$method->setAccessible(true);

		$data = $method->invoke($module);

		$this->assertInstanceOf(Registry::class, $data['params']);
		$this->assertSame($module, $data['moduleInstance']);
	}

	/**
	 * @test
	 *
	 * @return void
	 */
	public function renderReturnsExpectedValue()
	{
		$loader = new ArrayLoader(
			[
				'@module/mod_sample_twig/default.html.twig' => '<div class="{{ cssClass }}"><h1>Value: {{ sample }} </h1></div>'
			]
		);

		TwigMock::setInstance(TwigMock::create($loader));

		$module = new SampleTwigModule;

		$this->assertContains('class="src"', $module->render('@module/mod_sample_twig/default.html.twig', ['sample' => 'value']));
		$this->assertContains('Value: value', $module->render('@module/mod_sample_twig/default.html.twig', ['sample' => 'value']));
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

		$_SERVER['HTTP_HOST'] = 'mydomain.com';
		$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0';
		$_SERVER['REQUEST_URI'] = '/index.php';
		$_SERVER['SCRIPT_NAME'] = '/index.php';

		Factory::$config   = $this->getMockConfig();
		Factory::$document = $this->getMockDocument();
		Factory::$language = $this->getMockLanguage();
		Factory::$session  = $this->getMockSession();
		Factory::$application = new SiteApplication($this->getMockInput(), new Registry(['session' => false]));
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
}
