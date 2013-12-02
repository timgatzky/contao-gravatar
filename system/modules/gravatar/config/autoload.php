<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Gravatar
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Contao
	'Contao\GravatarInsertTags' => 'system/modules/gravatar/Contao/GravatarInsertTags.php',
	'Contao\MemberGravatar'     => 'system/modules/gravatar/Contao/MemberGravatar.php',
));
