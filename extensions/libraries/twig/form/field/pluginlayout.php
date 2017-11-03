<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Form.Field
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') or die;

JLoader::import('twig.library');

use Phproberto\Joomla\Twig\Field\LayoutSelector;

/**
 * Plugin layout selector.
 *
 * @since  1.0.0
 */
class TwigFormFieldPluginlayout extends LayoutSelector
{
	/**
	 * The form field type.
	 *
	 * @var  string
	 */
	protected $type = 'Pluginlayout';

	/**
	 * Group of the plugin whose layouts we want to load.
	 *
	 * @var  string
	 */
	protected $pluginGroup;

	/**
	 * Name of the plugin whose layouts we want to load.
	 *
	 * @var  string
	 */
	protected $pluginName;

	/**
	 * Get unique hash for cache.
	 *
	 * @return  string
	 */
	protected function cacheHash()
	{
		return md5($this->type . '|' . $this->clientId . '|' . $this->pluginGroup . '|' . $this->pluginName);
	}

	/**
	 * Get the folders that we will scan for layouts.
	 *
	 * @return  array
	 */
	public function getLayoutFolders()
	{
		$appFolder = $this->clientId ? JPATH_ADMINISTRATOR : JPATH_SITE;

		$mainFolder = $appFolder . '/plugins/' . $this->pluginGroup . '/' . $this->pluginName . '/tmpl/';
		$overridesFolder = $appFolder . '/templates/' . $this->activeTemplate() . '/html/plugins/' . $this->pluginGroup . '/' . $this->pluginName;

		return [
			JText::_('LIB_TWIG_LBL_PLUGIN')   => $mainFolder,
			JText::_('LIB_TWIG_LBL_TEMPLATE') => $tplFolder
		];
	}

	/**
	 * Method to attach a JForm object to the field.
	 *
	 * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the `<field>` tag for the form field object.
	 * @param   mixed             $value    The form field value to validate.
	 * @param   string            $group    The field name group control value. This acts as as an array container for the field.
	 *                                      For example if the field has name="foo" and the group value is set to "bar" then the
	 *                                      full field name would end up being "bar[foo]".
	 *
	 * @return  boolean  True on success.
	 *
	 * @see     JFormField::setup()
	 */
	public function setup(SimpleXMLElement $element, $value, $group = null)
	{
		if (!parent::setup($element, $value, $group))
		{
			return false;
		}

		$this->__set('pluginGroup', $this->getAttribute('pluginGroup'));
		$this->__set('pluginName', $this->getAttribute('pluginName'));

		return true;
	}
}
