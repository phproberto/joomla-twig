<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Twig
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\View;

defined('_JEXEC') || die;

use Phproberto\Joomla\Twig\View\HtmlView;

/**
 * Base list view.
 *
 * @since  1.2.0
 */
abstract class ListView extends HtmlView
{
	/**
	 * Load layout data.
	 *
	 * @return  self
	 */
	protected function loadLayoutData()
	{
		$model = $this->getModel();

		return array_merge(
			parent::loadLayoutData(),
			[
				'items'         => $model->getItems(),
				'state'         => $model->getState(),
				'pagination'    => $model->getPagination(),
				'filterForm'    => $model->getFilterForm(),
				'activeFilters' => $model->getActiveFilters(),
				'model'         => $model
			]
		);
	}
}
