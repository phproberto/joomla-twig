<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Field;

use Phproberto\Joomla\Twig\Field\ViewLayout;

/**
 * ViewLayout field test.
 *
 * @since   __DEPLOY_VERSION__
 */
class ViewLayoutTest extends \TestCaseDatabase
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
		$field = $this->field();
		$field2 = $this->field();

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('cacheHash');
		$method->setAccessible(true);

		$this->assertSame($method->invoke($field), $method->invoke($field2));
	}

	/**
	 * cacheHash returns different hash for different component.
	 *
	 * @return  void
	 */
	public function testCacheHasReturnsDifferentHashForDifferentComponent()
	{
		$field = $this->field();
		$field2 = $this->field('diff-component');

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('cacheHash');
		$method->setAccessible(true);

		$this->assertNotSame($method->invoke($field), $method->invoke($field2));
	}

	/**
	 * cacheHash returns different hash for different view name.
	 *
	 * @return  void
	 */
	public function testCacheHasReturnsDifferentHashForDifferentView()
	{
		$field = $this->field();
		$field2 = $this->field('diff-view');

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
			JPATH_BASE . '/components/com_users/views/login/tmpl',
			JPATH_BASE . '/templates/protostar/html/com_users/login'
		];

		$this->assertSame($expected, array_values($folders));
	}

	/**
	 * Setup sets component and view.
	 *
	 * @return  void
	 */
	public function testSetupSetsComponentAndView()
	{
		$field = $this->field();

		$reflection = new \ReflectionClass($field);
		$componentProperty = $reflection->getProperty('component');
		$componentProperty->setAccessible(true);
		$viewProperty = $reflection->getProperty('view');
		$viewProperty->setAccessible(true);

		$this->assertSame('com_users', $componentProperty->getValue($field));
		$this->assertSame('login', $viewProperty->getValue($field));
	}

	/**
	 * setup returns false when parent fails.
	 *
	 * @return  void
	 */
	public function testSetupReturnsFalseWhenParentFails()
	{
		$field = new ViewLayout;

		$this->assertFalse($field->setup(new \SimpleXMLElement('<test name="twig_layout"/>'), 'my-layout'));
	}

	/**
	 * Get a sample plugin \SimpleXMLElement by its key.
	 *
	 * @param   string  $key  Key to identify the sample module.
	 *
	 * @return  \SimpleXMLElement
	 */
	private function element($key = 'default')
	{
		return new \SimpleXMLElement($this->views()[$key]);
	}

	/**
	 * Retrieve a sample field.
	 *
	 * @param   string  $key    Key to identify the sample module.
	 * @param   string  $value  Value to assign in field setup
	 *
	 * @return  ViewLayout
	 */
	private function field($key = 'default', $value = 'default')
	{
		$field = new ViewLayout;

		$this->assertTrue(
			$field->setup($this->element($key), $value)
		);

		return $field;
	}

	/**
	 * Get sample views.
	 *
	 * @return  array
	 */
	private function views()
	{
		return [
			'default' => '<field
				name="twig_layout"
				type="twig.viewlayout"
				label="Twig layout"
				component="com_users"
				view="login"
				default="default"
				description="Twig layout to render"
			/>',
			'diff-component' => '<field
				name="twig_layout"
				type="twig.viewlayout"
				label="Twig layout"
				component="com_phproberto"
				view="login"
				default="default"
				description="Twig layout to render"
			/>',
			'diff-view' => '<field
				name="twig_layout"
				type="twig.viewlayout"
				label="Twig layout"
				component="com_users"
				view="my_view"
				default="default"
				description="Twig layout to render"
			/>'
		];
	}
}
