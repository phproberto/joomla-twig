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
 * Trait for common tests for extensions with filters.
 *
 * @since   __DEPLOY_VERSION__
 */
trait HasFilters
{
	/**
	 * Generic filters tester.
	 *
	 * @return  void
	 */
	protected function genericFiltersTest()
	{
		$expectedFilters = $this->expectedFilters();
		$filters = $this->extension->getFilters();

		$this->assertEquals(count($expectedFilters), count($filters));

		foreach ($filters as $filter)
		{
			$callable = $filter->getCallable();
			$filterName = $filter->getName();

			$this->assertTrue(array_key_exists($filterName, $expectedFilters));

			$expectedFilter = $expectedFilters[$filterName];

			$callableClass = null;
			$callableMethod = $callable;

			if (is_array($callable))
			{
				$callableClass = is_string($callable[0]) ? $callable[0] : get_class($callable[0]);
				$callableMethod = $callable[1];
			}

			$this->assertTrue(is_callable($callable));

			$this->assertEquals($expectedFilter['class'], $callableClass);
			$this->assertEquals($expectedFilter['method'], $callableMethod);
		}
	}

	/**
	 * Filters expected to be added by the extension.
	 *
	 * @return  array
	 */
	abstract protected function expectedFilters();
}
