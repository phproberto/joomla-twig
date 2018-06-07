<?php
/**
 * @package     Phproberto.Joomla-Twig
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Module;

defined('_JEXEC') || die;

use Phproberto\Joomla\Twig\Traits\HasParams;
use Phproberto\Joomla\Twig\Traits\HasLayoutData;
use Phproberto\Joomla\Twig\Traits\HasTwigRenderer;

/**
 * Base twig module.
 *
 * @since   1.1.0
 */
abstract class BaseTwigModule
{
	use HasLayoutData, HasParams, HasTwigRenderer;

	/**
	 * Module element. Example: mod_menu
	 *
	 * @var  string
	 */
	protected $element;

	/**
	 * Module data.
	 *
	 * @var  stdClass
	 */
	protected $module;

	/**
	 * Constructor.
	 *
	 * @param   array|Registry  $params  Module parameters
	 * @param   \stdClass       $module  Module object coming from joomla
	 */
	public function __construct($params = [], \stdClass $module = null)
	{
		$this->setParams($params);
		$this->module = $module ? $module : new \stdClass;
	}

	/**
	 * CSS class assignable to the module.
	 *
	 * @return  string
	 */
	protected function getCssClass() : string
	{
		return str_replace('_', '-', $this->getElement());
	}

	/**
	 * Create an unique CSS identifier for the module.
	 *
	 * @return  string
	 */
	protected function getCssId() : string
	{
		return $this->getCssClass() . '-' . $this->getId();
	}

	/**
	 * Get module element.
	 *
	 * @return  string
	 */
	public function getElement() : string
	{
		if (null === $this->element)
		{
			$this->element = empty($this->module->module) ? basename(dirname(__DIR__)) : $this->module->module;
		}

		return $this->element;
	}

	/**
	 * Get the module identifier.
	 *
	 * @return  string
	 */
	public function getId() : string
	{
		return empty($this->module->id) ? uniqid() : $this->module->id;
	}

	/**
	 * Load layout data.
	 *
	 * @return  array
	 */
	protected function loadLayoutData() : array
	{
		return [
			'cssClass'       => $this->getCssClass(),
			'cssId'          => $this->getCssId(),
			'moduleInstance' => $this,
			'params'         => $this->getParams()
		];
	}
}
