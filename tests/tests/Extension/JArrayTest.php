<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Extension;

use Phproberto\Joomla\Twig\Extension\JArray;
use Phproberto\Joomla\Twig\Tests\Extension\Traits\HasFilters;

/**
 * JArray extension test.
 *
 * @since   1.1.0
 */
class JArrayTest extends \TestCase
{
	use HasFilters;

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

		$this->extension = new JArray;
	}

	/**
	 * Test getFilters returns correct data.
	 *
	 * @return  void
	 */
	public function testGetFiltersReturnsCorrectData()
	{
		$this->genericFiltersTest();
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

	/**
	 * Functions expected to be added by the extension.
	 *
	 * @return  array
	 */
	protected function expectedFilters()
	{
		return [
			'to_array' => [
				'class'  => JArray::class,
				'method' => 'toArray'
			],
			'array_values' => [
				'class'  => null,
				'method' => 'array_values'
			]
		];
	}
}
