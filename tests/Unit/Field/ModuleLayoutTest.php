<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Field;

use Phproberto\Joomla\Twig\Field\ModuleLayout;

/**
 * ModuleLayout field test.
 *
 * @since   __DEPLOY_VERSION__
 */
class ModuleLayoutTest extends \TestCaseDatabase
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
	 * cacheHash returns different id for different settings.
	 *
	 * @return  void
	 */
	public function testCacheHashReturnsSameHasForSameXml()
	{
		$field = $this->field('full');
		$field2 = $this->field('full');

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('cacheHash');
		$method->setAccessible(true);

		$this->assertSame($method->invoke($field), $method->invoke($field2));
	}

	/**
	 * cacheHash returns different hash for different client.
	 *
	 * @return  void
	 */
	public function testCacheHasReturnsDifferentHashForDifferentClient()
	{
		$field = $this->field('full');
		$field2 = $this->field('full-backend');

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('cacheHash');
		$method->setAccessible(true);

		$this->assertNotSame($method->invoke($field), $method->invoke($field2));
	}

	/**
	 * cacheHash returns different hash for different client.
	 *
	 * @return  void
	 */
	public function testCacheHasReturnsDifferentHashForDifferentModule()
	{
		$field = $this->field('full');
		$field2 = $this->field('latest-full');

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('cacheHash');
		$method->setAccessible(true);

		$this->assertNotSame($method->invoke($field), $method->invoke($field2));
	}

	/**
	 * layoutFolders returns correct value.
	 *
	 * @return  void
	 */
	public function testLayoutFoldersReturnsCorrectValue()
	{
		$field = $this->field();

		$folders = $field->layoutFolders();

		$this->assertSame(2, count($folders));

		$expected = [
			realpath(JPATH_BASE . '/modules/mod_menu/tmpl'),
			realpath(JPATH_BASE . '/templates/protostar/html/mod_menu/')
		];

		$this->assertSame($expected, array_values($folders));
	}

	/**
	 * Constructor test.
	 *
	 * @return  void
	 */
	public function testSetupSetsModule()
	{
		$field = $this->field('latest-full');

		$reflection = new \ReflectionClass($field);
		$moduleProperty = $reflection->getProperty('module');
		$moduleProperty->setAccessible(true);

		$this->assertSame('mod_articles_latest', $moduleProperty->getValue($field));
	}

	/**
	 * setup returns false when parent fails.
	 *
	 * @return  void
	 */
	public function testSetupReturnsFalseWhenParentFails()
	{
		$field = new ModuleLayout;

		$this->assertFalse($field->setup(new \SimpleXMLElement('<test name="twig_layout"/>'), 'my-layout'));
	}

	/**
	 * Get a sample module \SimpleXMLElement by its key.
	 *
	 * @param   string  $key  Key to identify the sample module.
	 *
	 * @return  \SimpleXMLElement
	 */
	private function element($key = 'default')
	{
		return new \SimpleXMLElement($this->modules()[$key]);
	}

	/**
	 * Retrieve a sample field.
	 *
	 * @param   string  $key    Key to identify the sample module.
	 * @param   string  $value  Value to assign in field setup
	 *
	 * @return  ModuleLayout
	 */
	private function field($key = 'default', $value = 'default')
	{
		$field = new ModuleLayout;

		$this->assertTrue(
			$field->setup($this->element($key), $value)
		);

		return $field;
	}

	/**
	 * Get sample modules.
	 *
	 * @return  array
	 */
	private function modules()
	{
		return [
			'default' => '<field
				name="twig_layout"
				type="twig.modulelayout"
				label="Twig layout"
				module="mod_menu"
				default="default"
				clientId="0"
				description="Twig layout to render"
			/>',
			'full' => '<field
				name="first_layout"
				type="twig.modulelayout"
				label="First layout"
				module="mod_menu"
				default="default"
				clientId="0"
				description="Twig layout to render"
			/>',
			'full-backend' => '<field
				name="second_layout"
				type="twig.modulelayout"
				label="Second layout"
				module="mod_menu"
				default="default"
				clientId="1"
				description="Twig layout to render"
			/>',
			'latest-full' => '<field
				name="third_layout"
				type="twig.modulelayout"
				label="Third layout"
				module="mod_articles_latest"
				default="default"
				clientId="0"
				description="Twig layout to render"
			/>'
		];
	}
}
