<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Extension
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Extension;

defined('_JEXEC') || die;

use Twig\TwigFunction;
use Joomla\Registry\Registry;
use Twig\Extension\AbstractExtension;

/**
 * Registry integration for Twig.
 *
 * @since  4.0.0
 */
final class JRegistry extends AbstractExtension
{
	/**
	 * Inject functions.
	 *
	 * @return  array
	 */
	public function getFunctions() : array
	{
		return [
			new TwigFunction('jregistry', [$this, 'getRegistry'])
		];
	}

	/**
	 * Get the registry instance.
	 *
	 * @param   mixed   $data  Data to initialise the registry
	 *
	 * @return  Registry
	 */
	public function getRegistry($data = null)
	{
		return new Registry($data);
	}

	/**
	 * Get the name of this extension.
	 *
	 * @return  string
	 */
	public function getName() : string
	{
		return 'jregistry';
	}
}
