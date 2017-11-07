<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Plugin.Jdoc
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') or die;

JLoader::import('twig.library');

use Joomla\CMS\Factory;
use Phproberto\Joomla\Twig\Plugin\BasePlugin;
use Phproberto\Joomla\Twig\Extension\JDocument;
use Twig\Environment;

/**
 * Plugin to integrate jdoc extension with twig.
 *
 * @since  1.0.0
 */
class PlgTwigJdoc extends BasePlugin
{
	/**
	 * Triggered after environment has been loaded.
	 *
	 * @param   Environment  $environment  Loaded environment
	 * @param   array        $params       Optional parameters
	 *
	 * @return  void
	 */
	public function onTwigAfterLoad(Environment $environment, $params = [])
	{
		$environment->addExtension(new JDocument);
		$environment->addGlobal('jdoc', Factory::getDocument());
	}
}
