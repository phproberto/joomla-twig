<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Field;

use Phproberto\Joomla\Twig\Field\PluginLayout;

/**
 * PluginLayout field test.
 *
 * @since   __DEPLOY_VERSION__
 */
class PluginLayoutTest extends \TestCaseDatabase
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
	 * cacheHash returns different hash for different plugin group.
	 *
	 * @return  void
	 */
	public function testCacheHasReturnsDifferentHashForDifferentGroup()
	{
		$field = $this->field();
		$field2 = $this->field('diff-group');

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('cacheHash');
		$method->setAccessible(true);

		$this->assertNotSame($method->invoke($field), $method->invoke($field2));
	}

	/**
	 * cacheHash returns different hash for different plugin name.
	 *
	 * @return  void
	 */
	public function testCacheHasReturnsDifferentHashForDifferentName()
	{
		$field = $this->field();
		$field2 = $this->field('diff-name');

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
			realpath(JPATH_BASE . '/plugins/content/vote/tmpl'),
			realpath(JPATH_BASE . '/templates/protostar/html/plugins/content/vote')
		];

		$this->assertSame($expected, array_values($folders));
	}

	/**
	 * Setup sets group and name test.
	 *
	 * @return  void
	 */
	public function testSetupSetsGroupAndName()
	{
		$field = $this->field();

		$reflection = new \ReflectionClass($field);
		$pluginGroupProperty = $reflection->getProperty('pluginGroup');
		$pluginGroupProperty->setAccessible(true);
		$pluginNameProperty = $reflection->getProperty('pluginName');
		$pluginNameProperty->setAccessible(true);

		$this->assertSame('content', $pluginGroupProperty->getValue($field));
		$this->assertSame('vote', $pluginNameProperty->getValue($field));
	}

	/**
	 * setup returns false when parent fails.
	 *
	 * @return  void
	 */
	public function testSetupReturnsFalseWhenParentFails()
	{
		$field = new PluginLayout;

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
		return new \SimpleXMLElement($this->plugins()[$key]);
	}

	/**
	 * Retrieve a sample field.
	 *
	 * @param   string  $key    Key to identify the sample module.
	 * @param   string  $value  Value to assign in field setup
	 *
	 * @return  PluginLayout
	 */
	private function field($key = 'default', $value = 'default')
	{
		$field = new PluginLayout;

		$this->assertTrue(
			$field->setup($this->element($key), $value)
		);

		return $field;
	}

	/**
	 * Get sample plugins.
	 *
	 * @return  array
	 */
	private function plugins()
	{
		return [
			'default' => '<field
				name="twig_layout"
				type="twig.pluginlayout"
				label="Twig layout"
				pluginGroup="content"
				pluginName="vote"
				default="default"
				description="Twig layout to render"
			/>',
			'diff-group' => '<field
				name="twig_layout"
				type="twig.pluginlayout"
				label="Twig layout"
				pluginGroup="system"
				pluginName="vote"
				default="default"
				description="Twig layout to render"
			/>',
			'diff-name' => '<field
				name="twig_layout"
				type="twig.pluginlayout"
				label="Twig layout"
				pluginGroup="content"
				pluginName="other"
				default="default"
				description="Twig layout to render"
			/>'
		];
	}
}
