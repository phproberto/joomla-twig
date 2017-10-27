<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Extension
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Module position loader for Twig.
 *
 * @since  1.0.0
 */
class JPosition extends AbstractExtension
{
	/**
	 * Inject functions.
	 *
	 * @return  array
	 */
	public function getFunctions()
	{
		$options = array(
			'is_safe' => array('html')
		);

		return array(
			new TwigFunction('jposition', array($this, 'render'), $options)
		);
	}

	/**
	 * Render the module position.
	 *
	 * @param   string  $position  Position to render
	 * @param   array   $attribs   Associative array of values
	 *
	 * @return  string
	 */
	public function render($position, $attribs = array())
	{
		$modules  = ModuleHelper::getModules($position);
		$renderer = Factory::getDocument()->loadRenderer('module');
		$html     = '';

		foreach ($modules as $module)
		{
			$html .= $renderer->render($module, $attribs);
		}

		return $html;
	}

	/**
	 * Get the name of this extension.
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'jposition';
	}
}
