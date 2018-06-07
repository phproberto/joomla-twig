<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Extension;

use Phproberto\Joomla\Twig\Extension\Unserialize;

/**
 * Unserialize extension test.
 *
 * @since   1.1.0
 */
class UnserializeTest extends \TestCase
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

		$this->extension = new Unserialize;
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
		$this->assertEquals('unserialize', $filter->getName());
		$this->assertEquals('unserialize', $callable);
	}

	/**
	 * getName returns correct extension name.
	 *
	 * @return  void
	 */
	public function testGetNameReturnsJapp()
	{
		$this->assertEquals('junserialize', $this->extension->getName());
	}
}
