<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Test\Unit\Extension;

use Phproberto\Joomla\Twig\Extension\JArray;

/**
 * JArray extension test.
 *
 * @since   __DEPLOY_VERSION__
 */
class JArrayTest extends \TestCaseDatabase
{
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

		$this->extension = new JArray;
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
	 * Test getFilters returns correct data.
	 *
	 * @return  void
	 */
	public function testGetFiltersReturnsCorrectData()
	{
		$this->assertEquals(1, count($this->extension->getFilters()));

		$filter = $this->extension->getFilters()[0];

		$callable = $filter->getCallable();
		$this->assertTrue(is_callable($callable));
		$this->assertEquals('to_array', $filter->getName());
		$this->assertEquals(JArray::class, get_class($callable[0]));
		$this->assertEquals('toArray', $callable[1]);
	}

	/**
	 * getName returns correct extension name.
	 *
	 * @return  void
	 */
	public function testGetNameReturnsJapp()
	{
		$this->assertEquals('jarray', $this->extension->getName());
	}

	/**
	 * toArray casts data.
	 *
	 * @return  void
	 */
	public function testToArrayCastsData()
	{
		$this->assertSame([2], $this->extension->toArray(2));
		$this->assertSame(['test'], $this->extension->toArray('test'));
	}
}
