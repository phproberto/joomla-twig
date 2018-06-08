<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Twig
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\View\Traits;

defined('_JEXEC') || die;

use Phproberto\Joomla\Twig\Twig;

/**
 * To easily connect Twig rendering to any view.
 *
 * @since  1.2.0
 */
trait HasTwigRenderer
{
	/**
	 * Component option.
	 *
	 * @var  string
	 */
	protected $option;

	/**
	 * Get the data that will be sent to renderer.
	 *
	 * @return  array
	 */
	abstract protected function getLayoutData();

	/**
	 * Get this component option.
	 *
	 * @return  string
	 */
	public function getOption()
	{
		if (null === $this->option)
		{
			$this->option = $this->getOptionFromPrefix();
		}

		return $this->option;
	}

	/**
	 * Get the component from the prefix. Ex.: ContentViewArticle will return com_content
	 *
	 * @return  string
	 */
	protected function getOptionFromPrefix()
	{
		$class = get_class($this);

		if (false !== strpos($class, '\\'))
		{
			$name = array_filter(explode('\\', strstr($class, 'View', true)));
			$name = strtolower(end($name));
		}
		else
		{
			$name = strtolower(strstr($class, 'View', true));
		}

		return 'com_' . strtolower($name);
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
