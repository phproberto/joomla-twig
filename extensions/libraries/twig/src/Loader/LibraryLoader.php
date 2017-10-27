<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Loader
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Loader;

defined('_JEXEC') or die;

/**
 * Joomla library file system loader.
 *
 * @since  __DEPLOY_VERSION__
 */
class LibraryLoader extends ExtensionLoader
{
	/**
	 * Namespace applicable to this extension.
	 *
	 * @var  string
	 */
	protected $extensionNamespace = 'library';

	/**
	 * Get the paths to search for templates.
	 *
	 * @return  array
	 */
	protected function getTemplatePaths()
	{
		$paths = array();

		$tplOverrides = JPATH_THEMES . '/' . \JFactory::getApplication()->getTemplate() . '/html/libraries';

		if (is_dir($tplOverrides))
		{
			$paths[] = $tplOverrides;
		}

		$paths[] = JPATH_LIBRARIES;

		return $paths;
	}

	/**
	 * Parse a received extension name.
	 *
	 * @param   string  $name  Name of the template to search
	 *
	 * @return  string
	 */
	protected function parseExtensionName($name)
	{
		$nameParts = explode('/', $name);

		if (!isset($nameParts[1]))
		{
			return $name;
		}

		array_splice($nameParts, 1, 1, array($nameParts[1], 'layouts', 'twig'));

		return implode('/', $nameParts);
	}
}
