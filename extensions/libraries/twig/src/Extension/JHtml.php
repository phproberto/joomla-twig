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

use Joomla\CMS\HTML\HTMLHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * JHtml integration for Twig.
 *
 * @since  __DEPLOY_VERSION__
 */
class JHtml extends AbstractExtension
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
			new TwigFunction('jhtml', array(HTMLHelper::class, '_'), $options)
		);
	}

	/**
	 * Get the name of this extension.
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'jhtml';
	}
}
