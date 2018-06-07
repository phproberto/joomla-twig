<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Twig
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\View;

defined('_JEXEC') || die;

use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\MVC\View\HtmlView as BaseView;
use Phproberto\Joomla\Twig\Traits\HasLayoutData;
use Phproberto\Joomla\Twig\Twig;

/**
 * Base HTML view.
 *
 * @since  __DEPLOY_VERSION__
 */
abstract class HtmlView extends BaseView
{
	use HasLayoutData;

	/**
	 * Component option.
	 *
	 * @var  string
	 */
	protected $option;

	/**
	 * Get this component option.
	 *
	 * @return  string
	 */
	public function getOption()
	{
		if (null === $this->option)
		{
			$this->option = ApplicationHelper::getComponentName();
		}

		return $this->option;
	}

	/**
	 * Load layout data.
	 *
	 * @return  array
	 */
	protected function loadLayoutData()
	{
		return [
			'view' => $this
		];
	}

	/**
	 * Load a template file -- first look in the templates folder for an override
	 *
	 * @param   string  $tpl  The name of the template source file; automatically searches the template paths and compiles as needed.
	 *
	 * @return  string  The output of the the template script.
	 *
	 * @throws  \Exception
	 */
	public function loadTemplate($tpl = null)
	{
		$layout = $this->getLayout();
		$tpl = $tpl ? $layout . '_' . $tpl : $layout;

		$renderer = Twig::instance();

		$data = $this->getLayoutData();
		$prefix = '@component/' . $this->getOption() . '/' . $this->getName();

		$name = $prefix . '/' . $tpl . '.html.twig';

		if ($renderer->environment()->getLoader()->exists($name))
		{
			return $renderer->render($name, $data);
		}

		$name = $prefix . '/default.html.twig';

		return $renderer->render($name, $data);
	}
}
