<?php
/**
 * @package     Phproberto.Joomla-Twig
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Traits;

defined('_JEXEC') || die;

use Phproberto\Joomla\Twig\Twig;

/**
 * For classes having a linked app.
 *
 * @since  1.1.0
 */
trait HasTwigRenderer
{
	/**
	 * Get the data that will be sent to renderer.
	 *
	 * @return  array
	 */
	abstract protected function getLayoutData();

	/**
	 * Render a layout of this module.
	 *
	 * @param   string  $layout  Layout to render.
	 * @param   array   $data    Optional data for the layout.
	 *
	 * @return  string
	 */
	public function render($layout, array $data = [])
	{
		return $this->getRenderer()->render($layout, array_merge($this->getLayoutData(), $data));
	}

	/**
	 * Get the module renderer.
	 *
	 * @return  Twig
	 */
	public function getRenderer() : Twig
	{
		return Twig::instance();
	}
}
