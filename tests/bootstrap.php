<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

require_once JPATH_BASE . '/tests/unit/bootstrap.php';

if (!defined('JPATH_PHPROBERTO_EXTENSIONS'))
{
	define('JPATH_PHPROBERTO_EXTENSIONS', realpath(__DIR__ . '/../extensions'));
}

if (!defined('JPATH_PHPROBERTO_TESTS'))
{
	define('JPATH_PHPROBERTO_TESTS', realpath(__DIR__));
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once JPATH_PHPROBERTO_EXTENSIONS . '/libraries/twig/vendor/autoload.php';
