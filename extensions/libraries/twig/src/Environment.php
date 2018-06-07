<?php
/**
 * @package     Phproberto.Joomla-Twig
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig;

defined('_JEXEC') || die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Twig\Loader\LoaderInterface;
use Twig\Environment as BaseEnvironment;

/**
 * Joomla Twig enviroment.
 *
 * @since  1.0.0
 */
final class Environment extends BaseEnvironment
{
	/**
	 * Application where enviroment is loaded.
	 *
	 * @var     CMSApplication
	 * @since   1.0.2
	 */
	private $app;

	/**
	 * Plugins connected to the events triggered by this class.
	 *
	 * @var     array
	 * @since   1.0.3
	 */
	private $importablePluginTypes = ['twig'];

	/**
	 * Plugins that have been already imported.
	 *
	 * @var  array
	 */
	private $importedPluginTypes = [];

	/**
	 * Constructor.
	 *
	 * @param   LoaderInterface  $loader   Loader instance
	 * @param   array            $options  An array of options
	 * @param   CMSApplication   $app      CMSApplication | null active application
	 */
	public function __construct(LoaderInterface $loader, array $options = [], CMSApplication $app = null)
	{
		$this->app = $app ?: $this->activeApplication();

		$this->trigger('onTwigBeforeLoad', [&$loader, &$options]);

		parent::__construct($loader, $options);

		$this->trigger('onTwigAfterLoad', [$options]);
	}

	/**
	 * Get the active Joomla application.
	 *
	 * @return  CMSApplication
	 *
	 * @since   1.0.2
	 */
	private function activeApplication() : CMSApplication
	{
		return Factory::getApplication();
	}

	/**
	 * Import available plugins.
	 *
	 * @return  void
	 */
	private function importPlugins()
	{
		$importablePluginTypes = array_diff($this->importablePluginTypes, $this->importedPluginTypes);

		foreach ($importablePluginTypes as $pluginType)
		{
			PluginHelper::importPlugin($pluginType);

			$this->importedPluginTypes[] = $pluginType;
		}
	}

	/**
	 * Trigger an event on the attached twig instance.
	 *
	 * @param   string  $event   Event to trigger
	 * @param   array   $params  Params for the event triggered
	 *
	 * @return  array
	 */
	public function trigger(string $event, array $params = []) : array
	{
		$this->importPlugins();

		// Always send environment as first param
		array_unshift($params, $this);

		return (array) $this->app->triggerEvent($event, $params);
	}
}
