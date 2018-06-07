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
 * View layout selector.
 *
 * @since  1.0.0
 */
class ViewLayout extends LayoutSelector
{
	/**
	 * The form field type.
	 *
	 * @var  string
	 */
	protected $type = 'Viewlayout';

	/**
	 * Component whose layouts we want to load.
	 *
	 * @var  string
	 */
	protected $component;

	/**
	 * View whose layouts we want to load.
	 *
	 * @var  string
	 */
	protected $view;

	/**
	 * Get unique hash for cache.
	 *
	 * @return  string
	 */
	protected function cacheHash() : string
	{
		return parent::cacheHash() . md5($this->component . '|' . $this->view);
	}

	/**
	 * Get the folders that we will scan for layouts.
	 *
	 * @return  array
	 */
	public function layoutFolders() : array
	{
		$appFolder = $this->clientId ? JPATH_ADMINISTRATOR : JPATH_SITE;

		$mainFolder = $appFolder . '/components/' . $this->component . '/views/' . $this->view . '/tmpl';
		$overridesFolder = $appFolder . '/templates/' . $this->activeTemplate() . '/html/' . $this->component . '/' . $this->view;

		return [
			Text::_('LIB_TWIG_LBL_COMPONENT') => $mainFolder,
			Text::_('LIB_TWIG_LBL_TEMPLATE')  => $overridesFolder
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

		$this->__set('component', $this->getAttribute('component'));
		$this->__set('view', $this->getAttribute('view'));

		return true;
	}
}
