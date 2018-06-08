<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests;

defined('_JEXEC') || die;

use Joomla\Registry\Registry;
use Phproberto\Joomla\Twig\Traits\HasParams;

/**
 * HasParams tests.
 *
 * @since   __DEPLOY_VERSION__
 */
class HasParamsTest extends \TestCase
{
	/**
	 * @test
	 *
	 * @return void
	 */
	public function getParamReturnsDefaultValueForNull()
	{
		$mock = $this->getMockForTrait(HasParams::class);

		$this->assertSame($mock, $mock->setParams([]));
		$this->assertSame(null, $mock->getParam('my-key'));
		$this->assertSame('default', $mock->getParam('my-key', 'default'));
	}

	/**
	 * @test
	 *
	 * @return void
	 */
	public function setParamsSetsParams()
	{
		$mock = $this->getMockForTrait(HasParams::class);

		$params = ['test' => 'value', 'other' => 'diff-value'];

		$this->assertSame($mock, $mock->setParams($params));

		$registry = $mock->getParams();
		$this->assertInstanceOf(Registry::class, $registry);

		foreach ($params as $key => $value)
		{
			$this->assertSame($value, $registry->get($key));
		}
	}

	/**
	 * @test
	 *
	 * @return void
	 */
	public function setParamSetsParam()
	{
		$mock = $this->getMockForTrait(HasParams::class);

		$this->assertSame($mock, $mock->setParams([]));

		$this->assertSame($mock, $mock->setParam('my-key', 'my-value'));
		$this->assertSame('my-value', $mock->getParam('my-key'));

		$this->assertSame($mock, $mock->setParam('my-key', null));
		$this->assertSame(null, $mock->getParam('my-key'));
	}
}
