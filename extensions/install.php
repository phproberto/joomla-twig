<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Installer
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') || die;

use Joomla\CMS\Factory;

/**
 * Package installer
 *
 * @since  1.0.0
 */
class Pkg_TwigInstallerScript
{
	/**
	 * Minimum PHP version required.
	 *
	 * @const
	 * @since   1.0.3
	 */
	const REQUIRED_PHP_VERSION = '7.0.0';

	/**
	 * Manifest of the extension being processed
	 *
	 * @var  SimpleXMLElement
	 */
	protected $manifest;

	/**
	 * Enable plugins if desired
	 *
	 * @param   object  $parent  class calling this method
	 *
	 * @return  void
	 */
	private function enablePlugins($parent)
	{
		// Required objects
		$manifest  = $this->getManifest($parent);

		if ($nodes = $manifest->files)
		{
			foreach ($nodes->file as $node)
			{
				$extType = (string) $node->attributes()->type;

				if ($extType !== 'plugin')
				{
					continue;
				}

				$enabled = (string) $node->attributes()->enabled;

				if ($enabled !== 'true')
				{
					continue;
				}

				$extName  = (string) $node->attributes()->id;
				$extGroup = (string) $node->attributes()->group;

				$db = Factory::getDbo();
				$query = $db->getQuery(true);
				$query->update($db->quoteName("#__extensions"));
				$query->set("enabled=1");
				$query->where("type='plugin'");
				$query->where("element=" . $db->quote($extName));
				$query->where("folder=" . $db->quote($extGroup));
				$db->setQuery($query);
				$db->execute();
			}
		}
	}

	/**
	 * Getter with manifest cache support
	 *
	 * @param   JInstallerAdapter  $parent  Parent object
	 *
	 * @return  SimpleXMLElement
	 */
	protected function getManifest($parent)
	{
		if (null === $this->manifest)
		{
			$this->loadManifest($parent);
		}

		return $this->manifest;
	}

	/**
	 * Shit happens. Patched function to bypass bug in package uninstaller
	 *
	 * @param   JInstallerAdapter  $parent  Parent object
	 *
	 * @return  void
	 */
	protected function loadManifest($parent)
	{
		$element = strtolower(str_replace('InstallerScript', '', get_called_class()));
		$elementParts = explode('_', $element);

		// Type not properly detected or not a package
		if (count($elementParts) != 2 || strtolower($elementParts[0]) !== 'pkg')
		{
			$this->manifest = $parent->get('manifest');

			return;
		}

		$manifestFile = __DIR__ . '/' . $element . '.xml';

		// Package manifest found
		if (file_exists($manifestFile))
		{
			$this->manifest = simplexml_load_file($manifestFile);

			return;
		}

		$this->manifest = $parent->get('manifest');
	}

	/**
	 * Method to run after an install/update/discover method
	 *
	 * @param   object  $type    type of change (install, update or discover_install)
	 * @param   object  $parent  class calling this method
	 *
	 * @return  void
	 */
	public function postflight($type, $parent)
	{
		$this->enablePlugins($parent);
	}

	/**
	 * Method to run after an install/update/discover method
	 *
	 * @param   object  $type    type of change (install, update or discover_install)
	 * @param   object  $parent  class calling this method
	 *
	 * @return  void
	 *
	 * @since   1.0.3
	 */
	public function preflight($type, $parent)
	{
		if (version_compare(PHP_VERSION, self::REQUIRED_PHP_VERSION) < 0)
		{
			$msg = \JText::sprintf('PKG_TWIG_ERROR_REQUIRED_VERSION', self::REQUIRED_PHP_VERSION, PHP_VERSION);

			throw new \RuntimeException($msg);
		}
	}
}
