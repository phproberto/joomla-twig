<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Twig
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') || die;

defined('JPATH_TWIG_LIBRARY') || define('JPATH_TWIG_LIBRARY', __DIR__);

// Tests already run autoload
if (!class_exists('Phproberto\Joomla\Twig\Twig'))
{
	$composerAutoload = __DIR__ . '/vendor/autoload.php';

	if (!file_exists($composerAutoload))
	{
		throw new \RuntimeException("Cannot find Twig library autoloader");
	}

	require_once $composerAutoload;

	class_alias(Phproberto\Joomla\Twig\Twig::class, 'Twig');
}

JLoader::setup();
JLoader::registerPrefix('Twig', JPATH_TWIG_LIBRARY);

JFormHelper::addFieldPath(JPATH_TWIG_LIBRARY . '/form/field');

// Load library language
$lang = JFactory::getLanguage();
$lang->load('lib_twig', __DIR__);

