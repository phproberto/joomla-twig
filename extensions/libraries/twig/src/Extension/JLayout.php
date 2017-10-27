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

use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * JLayout integration for Twig.
 *
 * @since  __DEPLOY_VERSION__
 */
class JLayout extends AbstractExtension
{
	/**
	 * Inject functions.
	 *
	 * @return  array
	 */
	public function getFunctions()
	{
		return array(
			new TwigFunction('jlayout', array($this, 'jlayout')),
			new TwigFunction('jlayout_render', array(LayoutHelper::class, 'render')),
			new TwigFunction('jlayout_debug', array(LayoutHelper::class, 'debug'))
		);
	}

	/**
	 * Retrive a FileLayout instance.
	 *
	 * @return  FileLayout
	 */
	public function jlayout()
	{
		$class = new \ReflectionClass(FileLayout::class);

		return $class->newInstanceArgs(func_get_args());
	}

	/**
	 * Get the name of this extension.
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'jlayout';
	}
}
