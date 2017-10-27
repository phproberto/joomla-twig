<?php
/**
 * @package     Phproberto.Joomla-Twig-Twig
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig;

defined('_JEXEC') or die;

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
	 * Plugins connected to the events triggered by this class.
	 *
	 * @var  array
	 */
	private $importedPluginTypes = array(
		'twig'
	);

	/**
	 * Constructor.
	 *
	 * @param   LoaderInterface  $loader   Loader instance
	 * @param   array            $options  An array of options
	 */
	public function __construct(LoaderInterface $loader, $options = array())
	{
		$this->trigger('onTwigBeforeLoad', array(&$loader, &$options));

		parent::__construct($loader, $options);

		$this->trigger('onTwigAfterLoad', array($options));
	}

	/**
	 * Import available plugins.
	 *
	 * @return  void
	 */
	private function importPlugins()
	{
		foreach ($this->importedPluginTypes as $pluginType)
		{
			\JPluginHelper::importPlugin($pluginType);
		}
	}

	/**
	 * Trigger an event on the attached twig instance.
	 *
	 * @param   string  $event   Event to trigger
	 * @param   array   $params  Params for the event triggered
	 *
	 * @return  mixed
	 */
	public function trigger($event, $params = array())
	{
		$dispatcher = \JEventDispatcher::getInstance();

		$this->importPlugins();

		// Always send enviroment as first param
		array_unshift($params, $this);

		return $dispatcher->trigger($event, $params);
	}
}
