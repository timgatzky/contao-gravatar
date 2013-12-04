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

/*

Available inserttags:

{{gravatar}}
{{gravatar::member::ID-or-USERNAME}}
{{gravatar::user::ID-or-USERNAME}}
{{gravatar::EMAIL}}
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
				// {{gravatar}} : return the gravatar for the logged in user
				if(!$arrElements[1])
				{
					if(!FE_USER_LOGGED_IN)
					{
						return false;
					}
						
					$this->import('FrontendUser','User');
					$email = $this->User->gravatarEmail ? $this->User->gravatarEmail : $this->User->email;
					return Gravatar::get($email);
				}
				
				// check if an email is given
				if(strpos($arrElements[1],'@'))
				{
					return Gravatar::get($arrElements[1]);
				}
				
				// check for member/user reference
				$strTable = '';
				if($arrElements[1] == 'member') {$strTable = 'tl_member';}
				else if($arrElements[1] == 'user') {$strTable = 'tl_user';}
				else {return false;}
				
				// fetch from id
				if(is_numeric($arrElements[2]))
				{
					$objUser = \Database::getInstance()->prepare("SELECT * FROM ".$strTable." WHERE id=?")->limit(1)->execute($arrElements[2]);
				}
				// fetch from username
				else if(is_string($arrElements[2]))
				{
					$objUser = \Database::getInstance()->prepare("SELECT * FROM ".$strTable." WHERE username=?")->limit(1)->execute($arrElements[2]);
				}
				else {return false;}
				
				if($objUser->numRows < 1)
				{
					return false;
				}
				
				$email = $objUser->gravatarEmail ? $objUser->gravatarEmail : $objUser->email;
				return Gravatar::get($email);
				break;
			default:
				return false;
				break;
		}
	}
	
	
	
	
	
	
}