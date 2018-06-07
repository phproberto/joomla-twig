<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Loader;

use Joomla\Registry\Registry;
use Joomla\CMS\Application\SiteApplication;
use Phproberto\Joomla\Twig\Loader\PluginLoader;

/**
 * PluginLoader tests.
 *
 * @since   1.1.0
 */
class PluginLoaderTest extends \TestCaseDatabase
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

		\JFactory::$document = $this->getMockDocument();
		\JFactory::$language = $this->getMockLanguage();
		\JFactory::$session  = $this->getMockSession();
		\JFactory::$application = new SiteApplication($this->getMockInput(), new Registry(['session' => false]));
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
	 * getTemplatePaths returns correct paths.
	 *
	 * @return  void
	 */
	public function testGetTemplatePathsReturnsCorrectPaths()
	{
		$loader = new PluginLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('getTemplatePaths');
		$method->setAccessible(true);

		$expected = [
			JPATH_BASE . '/templates/' . \JFactory::getApplication()->getTemplate() . '/html/plugins',
			JPATH_BASE . '/plugins'
		];

		// Try to create any missing folder
		foreach ($expected as $folder)
		{
			if (!is_dir($folder) && !mkdir($folder))
			{
				throw new \Exception("Error creating folder " . $folder);
			}
		}

		$this->assertSame($expected, $method->invoke($loader));
	}

	/**
	 * parseExtensionName returns expected parts.
	 *
	 * @return  void
	 */
	public function testParseExtensionNameReturnsExpectedParts()
	{
		$loader = new PluginLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('parseExtensionName');
		$method->setAccessible(true);

		$name = '@plugin/content/vote/default.html.twig';
		$expected = '@plugin/content/vote/tmpl/default.html.twig';

		$this->assertSame($expected, $method->invoke($loader, $name));

		$name = '@plugin';
		$expected = '@plugin';

		$this->assertSame($expected, $method->invoke($loader, $name));
	}
}
