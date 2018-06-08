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
 * Base form view.
 *
 * @since  0.1.6
 */
abstract class FormView extends HtmlView
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
				'form'  => $model->getForm(),
				'model' => $model
			]
		);
	}
}
