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
 */

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{avatar_legend:hide},gravatarSize,gravatarMaxRating;';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['gravatarSize'] = array
(
	'label'                 => &$GLOBALS['TL_LANG']['tl_settings']['gravatarSize'],
	'inputType'             => 'text',
	'default'				=> '80',
	'eval'                  => array('tl_class'=>'clr w50','rgxp'=>'digit'),
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['gravatarMaxRating'] = array
(
	'label'                 => &$GLOBALS['TL_LANG']['tl_settings']['gravatarMaxRating'],
	'inputType'             => 'select',
	'default'				=> 'x',
	'options'				=> array('p','pg','r','x'),
	'eval'                  => array('tl_class'=>'clr w50'),
);