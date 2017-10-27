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

\JLoader::import('twig.library');

use Joomla\CMS\Language\Language;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * JLanguage integration for Twig.
 *
 * @since  __DEPLOY_VERSION__
 */
class JLanguage extends AbstractExtension
{
	/**
	 * Inject functions.
	 *
	 * @return  array
	 */
	public function getFunctions()
	{
		return array(
			new TwigFunction('jlang', array(Language::class, 'getInstance'))
		);
	}

	/**
	 * Get the name of this extension.
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'jlang';
	}
}
