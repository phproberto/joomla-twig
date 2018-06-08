<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\View\Traits\Stubs;

defined('_JEXEC') || die;

use Phproberto\Joomla\Twig\View\Traits\HasTwigRenderer;

class ClassWithTwigRenderer
{
	use HasTwigRenderer;

	protected function getLayoutData()
	{
		return ['view' => $this];
	}
}
