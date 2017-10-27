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

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Twig filter to unserialize data.
 *
 * @since  __DEPLOY_VERSION__
 */
class Unserialize extends AbstractExtension
{
	/**
	 * Inject our filter.
	 *
	 * @return  array
	 */
	public function getFilters()
	{
		return array(
			new TwigFilter('unserialize', 'unserialize')
		);
	}

	/**
	 * Get the name of this extension.
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'unserialize';
	}
}
