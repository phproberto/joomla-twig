<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Twig
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Plugin;

defined('_JEXEC') || die;

use Joomla\CMS\Plugin\CMSPlugin;

/**
 * Base twig extension plugin.
 *
 * @since  1.0.0
 */
abstract class BasePlugin extends CMSPlugin
{
	/**
	 * Path to the plugin folder.
	 *
	 * @var    string
	 */
	protected $pluginPath;

	/**
	 * Get the path to the folder of the current plugin.
	 *
	 * @return  string
	 */
	protected function pluginPath() : string
	{
		if (null === $this->pluginPath)
		{
			$reflection = new \ReflectionClass($this);

			$this->pluginPath = dirname($reflection->getFileName());
		}

		return $this->pluginPath;
	}
}
