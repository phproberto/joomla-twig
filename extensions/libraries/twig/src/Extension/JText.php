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

use Joomla\CMS\Language\Text;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * JText integration for Twig.
 *
 * @since  __DEPLOY_VERSION__
 */
class JText extends AbstractExtension
{
	/**
	 * Inject functions.
	 *
	 * @return  array
	 */
	public function getFunctions()
	{
		return array(
			new TwigFunction('jtext', array(Text::class, '_')),
			new TwigFunction('jtext_sprintf', array(Text::class, 'sprintf')),
		);
	}

	/**
	 * Get the name of this extension.
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'jtext';
	}
}
