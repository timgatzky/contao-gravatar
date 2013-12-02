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
 * Namespace
 */
namespace Contao;

/**
 * Class file
 * GravatarInsertTags
 */
class GravatarInsertTags extends \Controller
{
	/**
	 * Replace Gravatar related inserttags
	 *
	 * @param string
	 * @return mixed
	 */
	public function replaceTags($strTag)
	{
		$arrElements = explode('::', $strTag);
		
		switch($arrElements[0])
		{
			case 'gravatar':
				if(TL_MODE == 'FE')
				{
					if(!FE_USER_LOGGED_IN)
					{
						return false;
					}
					
					$this->import('FrontendUser','User');
				}
				
				$email = $this->User->gravatarEmail ? $this->User->gravatarEmail : $this->User->email;
				$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) );
				$grav_attributes = array
				(
					's' => $GLOBALS['TL_CONFIG']['gravatarSize'] ? round($GLOBALS['TL_CONFIG']['gravatarSize']) : 80,
					'd' => $GLOBALS['TL_CONFIG']['gravatarDefault'] ? $GLOBALS['TL_CONFIG']['gravatarDefault'] : '',
					'r' => $GLOBALS['TL_CONFIG']['gravatarMaxRating'] ? $GLOBALS['TL_CONFIG']['gravatarMaxRating'] : 'x',
				);
				$grav_url .= '?';
				foreach($grav_attributes as $k => $v)
				{
					if($v == 'gravatarlogo')
					{
						continue;
					}
					$grav_url .= $k.'='.$v.'&';
				}
				$grav_url = substr($grav_url, 0,-1);
				
				$img_attributes = 'width="'.$size.'px" height="'.$size.'px"' . ' title="'.$this->User->username.'"';
				return sprintf('<img src="%s" %s>',$grav_url,$img_attributes);
				break;
			default:
				return false;
				break;
		}
	}
}