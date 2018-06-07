<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Field
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Field;

defined('_JEXEC') || die;

use Joomla\CMS\Language\Text;

/**
 * Module layout selector.
 *
 * @since  1.0.0
 */
class ModuleLayout extends LayoutSelector
{
	/**
	 * The form field type.
	 *
	 * @var  string
	 */
	protected $type = 'Modulelayout';

	/**
	 * Module whose layouts we want to load.
	 *
	 * @var  string
	 */
	protected $module;

	/**
	 * Get unique hash for cache.
	 *
	 * @return  string
	 */
	protected function cacheHash() : string
	{
		return parent::cacheHash() . md5($this->module);
	}

	/**
	 * Get the folders that we will scan for layouts.
	 *
	 * @return  array
	 */
	public function layoutFolders() : array
	{
		$appFolder = $this->clientId ? JPATH_ADMINISTRATOR : JPATH_SITE;

		return [
			Text::_('LIB_TWIG_LBL_MODULE')   => $appFolder . '/modules/' . $this->module . '/tmpl',
			Text::_('LIB_TWIG_LBL_TEMPLATE') => $appFolder . '/templates/' . $this->activeTemplate() . '/html/' . $this->module
		];
	}

	/**
	 * Method to attach a JForm object to the field.
	 *
	 * @param   \SimpleXMLElement  $element  The SimpleXMLElement object representing the `<field>` tag for the form field object.
	 * @param   mixed              $value    The form field value to validate.
	 * @param   string             $group    The field name group control value. This acts as as an array container for the field.
	 *                                       For example if the field has name="foo" and the group value is set to "bar" then the
	 *                                       full field name would end up being "bar[foo]".
	 *
	 * @return  boolean  True on success.
	 *
	 * @see     JFormField::setup()
	 */
	public function setup(\SimpleXMLElement $element, $value, $group = null)
	{
		if (!parent::setup($element, $value, $group))
		{
			return false;
		}

		$this->__set('module', $this->getAttribute('module'));

		return true;
	}
}
