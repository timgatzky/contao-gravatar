<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @copyright	Tim Gatzky 2013
 * @author		Tim Gatzky <info@tim-gatzky.de>
 * @package		gravatar
 * @link		http://contao.org
 * @license		http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Selector
 */
$GLOBALS['TL_DCA']['tl_member']['palettes']['__selector__'][] = 'gravatar';

/**
 * Palettes
 */
if( in_array('avatar', \Config::getInstance()->getActiveModules()) )
{
	$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace('avatar','avatar,gravatarEmail',$GLOBALS['TL_DCA']['tl_member']['palettes']['default']);
}
else
{
	$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace('{account_legend}', '{avatar_legend:hide},gravatarEmail;{account_legend}', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);
}

/**
 * Subpalettes
 */
$GLOBALS['TL_DCA']['tl_member']['subpalettes']['gravatar'] = 'gravatarEmail';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_member']['fields']['gravatar'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_member']['gravatar'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'','submitOnChange'=>true),
	'sql'					  =>  "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_member']['fields']['gravatarEmail'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_member']['gravatarEmail'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50','feViewable'=>true,'feEditable'=>true),
	'sql'					  =>  "varchar(128) NOT NULL default ''",
);