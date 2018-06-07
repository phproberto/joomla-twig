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

use Joomla\CMS\Language\Text;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * JText integration for Twig.
 *
 * @since  1.0.0
 */
final class JText extends AbstractExtension
{
	/**
	 * Inject functions.
	 *
	 * @return  array
	 */
	public function getFunctions() : array
	{
		return [
			new TwigFunction('jtext', [Text::class, '_']),
			new TwigFunction('jtext_sprintf', [Text::class, 'sprintf']),
		];
	}

	/**
	 * Get the name of this extension.
	 *
	 * @return  string
	 */
	public function getName() : string
	{
		return 'jtext';
	}
}
