<?php
/**
 * Joomla! entity library.
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Extension\Traits;

defined('_JEXEC') || die;

/**
 * Trait for common tests for extensions with functions.
 *
 * @since   1.1.0
 */
trait HasFunctions
{
	/**
	 * Generic functions tester.
	 *
	 * @return  void
	 */
	protected function genericFunctionsTest()
	{
		$expectedFunctions = $this->expectedFunctions();
		$functions = $this->extension->getFunctions();

		$this->assertEquals(count($expectedFunctions), count($functions));

		foreach ($functions as $function)
		{
			$callable = $function->getCallable();
			$functionName = $function->getName();

			$this->assertTrue(array_key_exists($functionName, $expectedFunctions));

			$expectedFunction = $expectedFunctions[$functionName];

			$callableClass = is_string($callable[0]) ? $callable[0] : get_class($callable[0]);
			$callableMethod = $callable[1];

			$this->assertTrue(is_callable($callable));

			$this->assertEquals($expectedFunction['class'], $callableClass);
			$this->assertEquals($expectedFunction['method'], $callableMethod);
		}
	}

	/**
	 * Functions expected to be added by the extension.
	 *
	 * @return  array
	 */
	abstract protected function expectedFunctions();
}
