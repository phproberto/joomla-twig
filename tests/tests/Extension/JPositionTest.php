<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Extension;

use Phproberto\Joomla\Twig\Extension\JPosition;

/**
 * JPosition extension test.
 *
 * @since   1.1.0
 */
class JPositionTest extends \TestCaseDatabase
{
	use Traits\HasFunctions;

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
		\JFactory::$session     = $this->getMockSession();
		\JFactory::$config      = $this->getMockConfig();
		\JFactory::$application = $this->getMockCmsApp();

		$this->extension = new JPosition;
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
		$dataSet->addTable('jos_modules', JPATH_TEST_DATABASE . '/jos_modules.csv');
		$dataSet->addTable('jos_modules_menu', JPATH_TEST_DATABASE . '/jos_modules_menu.csv');

		return $dataSet;
	}

	/**
	 * Test getFunctions returns correct data.
	 *
	 * @return  void
	 */
	public function testGetFunctions()
	{
		$this->genericFunctionsTest();
	}

	/**
	 * getName returns correct name.
	 *
	 * @return  void
	 */
	public function testGetNameReturnsCorrectName()
	{
		$this->assertEquals('jposition', $this->extension->getName());
	}

	/**
	 * render returns correct data.
	 *
	 * @return  void
	 */
	public function testRenderReturnsCorrectData()
	{
		$this->assertTrue(strlen(trim($this->extension->render('position-0'))) > 0);
	}

	/**
	 * @test
	 *
	 * @return void
	 */
	public function getModulesReturnsCorrectValue()
	{
		$modules = $this->extension->getModules('position-7');

		$this->assertTrue(is_array($modules));
		$this->assertTrue(count($modules) > 0);
	}

	/**
	 * Functions expected to be added by the extension.
	 *
	 * @return  array
	 */
	protected function expectedFunctions()
	{
		return [
			'jposition'        => [
				'class'  => JPosition::class,
				'method' => 'render'
			],
			'jposition_modules'        => [
				'class'  => JPosition::class,
				'method' => 'getModules'
			]
		];
	}
}
