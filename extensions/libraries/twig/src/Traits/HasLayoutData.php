<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Twig
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Traits;

defined('_JEXEC') || die;

/**
 * For classes having cached layout data.
 *
 * @since  1.1.0
 */
trait HasLayoutData
{
	/**
	 * Layout data for the views.
	 *
	 * @var    array
	 */
	protected $layoutData = [];

	/**
	 * Get the data that will be sent to renderer.
	 *
	 * @return  array
	 */
	protected function getLayoutData()
	{
		if (!isset($this->layoutData[__CLASS__]))
		{
			$this->layoutData[__CLASS__] = $this->loadLayoutData();
		}

		return $this->layoutData[__CLASS__];
	}

	/**
	 * Load layout data.
	 *
	 * @return  array
	 */
	abstract protected function loadLayoutData();
}
