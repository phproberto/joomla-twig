<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Field\Stubs;

use Phproberto\Joomla\Twig\Field\LayoutSelector;

/**
 * Sample field to test LayoutSelector class.
 *
 * @since   __DEPLOY_VERSION__
 */
class SampleField extends LayoutSelector
{
	/**
	 * Get the list of layout folders.
	 *
	 * @return  array  Key: group name. Value: folder
	 */
	public function layoutFolders()
	{
		return [
			'Tests'      => __DIR__ . '/tmpl',
			'Unexisting' => __DIR__ . '/unexisting'
		];
	}
}
