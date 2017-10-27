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
 * Joomla template file system loader.
 *
 * @since  __DEPLOY_VERSION__
 */
class TemplateLoader extends ExtensionLoader
{
	/**
	 * Namespace applicable to this extension.
	 *
	 * @var  string
	 */
	protected $extensionNamespace = 'template';

	/**
	 * Get the paths to search for templates.
	 *
	 * @return  array
	 */
	protected function getTemplatePaths()
	{
		$paths = array();

		$tplOverrides = JPATH_THEMES . '/' . \JFactory::getApplication()->getTemplate() . '/html';

		if (is_dir($tplOverrides))
		{
			$paths[] = $tplOverrides;
		}

		return $paths;
	}
}
