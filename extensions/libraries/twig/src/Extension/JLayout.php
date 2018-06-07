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

use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * JLayout integration for Twig.
 *
 * @since  1.0.0
 */
final class JLayout extends AbstractExtension
{
	/**
	 * Inject functions.
	 *
	 * @return  array
	 */
	public function getFunctions() : array
	{
		$options = [
			'is_safe' => ['html']
		];

		return [
			new TwigFunction('jlayout', [$this, 'getFileLayout']),
			new TwigFunction('jlayout_render', [LayoutHelper::class, 'render'], $options),
			new TwigFunction('jlayout_debug', [LayoutHelper::class, 'debug'], $options)
		];
	}

	/**
	 * Retrive a FileLayout instance.
	 *
	 * @return  FileLayout
	 */
	public function getFileLayout() : FileLayout
	{
		$class = new \ReflectionClass(FileLayout::class);

		return $class->newInstanceArgs(func_get_args());
	}

	/**
	 * Get the name of this extension.
	 *
	 * @return  string
	 */
	public function getName() : string
	{
		return 'jlayout';
	}
}
