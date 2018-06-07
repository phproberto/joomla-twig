<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Field;

use Joomla\Registry\Registry;
use Joomla\CMS\Application\SiteApplication;

/**
 * ModuleLayout field test.
 *
 * @since   __DEPLOY_VERSION__
 */
abstract class BaseLayoutFieldTest extends \TestCaseDatabase
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

		\JFactory::$config      = $this->getMockConfig();
		\JFactory::$session     = $this->getMockSession();
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
	 * Get a sample module \SimpleXMLElement by its key.
	 *
	 * @param   string  $key  Key to identify the sample module.
	 *
	 * @return  \SimpleXMLElement
	 */
	protected function element($key = 'default')
	{
		return new \SimpleXMLElement($this->sampleFields()[$key]);
	}

	/**
	 * Retrieve a sample field.
	 *
	 * @param   string  $key    Key to identify the sample module.
	 * @param   string  $value  Value to assign in field setup
	 *
	 * @return  ModuleLayout
	 */
	protected function field($key = 'default', $value = 'default')
	{
		$class = $this->fieldClass();
		$field = new $class;

		$this->assertTrue(
			$field->setup($this->element($key), $value)
		);

		return $field;
	}

	/**
	 * Get the class of the field being tested.
	 *
	 * @return  array
	 */
	abstract protected function fieldClass();

	/**
	 * Get the sample fields XML strings.
	 *
	 * @return  array
	 */
	abstract protected function sampleFields();
}
