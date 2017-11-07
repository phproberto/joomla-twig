<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

require_once JPATH_BASE . '/tests/unit/bootstrap.php';

if (!defined('JPATH_TESTS_PHPROBERTO'))
{
	define('JPATH_TESTS_PHPROBERTO', realpath(__DIR__));
}

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once JPATH_SITE . '/libraries/twig/vendor/autoload.php';
