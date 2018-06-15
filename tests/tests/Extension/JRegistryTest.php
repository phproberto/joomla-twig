<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Extension;

use Joomla\Registry\Registry;
use Joomla\CMS\Profiler\Profiler;
use Phproberto\Joomla\Twig\Extension\JProfiler;
use Phproberto\Joomla\Twig\Extension\JRegistry;

/**
 * JRegistry extension test.
 *
 * @since   4.0.0
 */
class JRegistryTest extends \TestCase
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

		$this->extension = new JRegistry;
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
		$this->assertEquals('jregistry', $this->extension->getName());
	}

	/**
	 * @test
	 *
	 * @return void
	 */
	public function getRegistryReturnsExpectedValue()
	{
		$this->assertInstanceOf(Registry::class, $this->extension->getRegistry());

		$registryFromString = $this->extension->getRegistry('{"property":"a-value"}');

		$this->assertSame("a-value", $registryFromString->get('property'));

		$registryFromArray = $this->extension->getRegistry(['name' => 'Roberto']);

		$this->assertSame("Roberto", $registryFromArray->get('name'));
		$this->assertSame("Segura", $registryFromArray->get('last_name', 'Segura'));
	}

	/**
	 * Functions expected to be added by the extension.
	 *
	 * @return  array
	 */
	protected function expectedFunctions()
	{
		return [
			'jregistry'        => [
				'class'  => JRegistry::class,
				'method' => 'getRegistry'
			]
		];
	}
}
