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
 * Imports
 */
use \Contao\Gravatar as Gravatar;

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
				if($arrElements[1])
				{
					// check if an email is given
					if(strpos($arrElements[1],'@'))
					{
						return Gravatar::get($arrElements[1]);
					}
					
					// check for member/user reference
					switch($arrElements[1])
					{
						case 'member':
							$objDatabase = \Database::getInstance();
							
							// fetch from id
							if(is_numeric($arrElements[2]))
							{
								$objUser = $objDatabase->prepare("SELECT * FROM tl_member WHERE id=?")->limit(1)->execute($arrElements[2]);
							}
							// fetch from username
							else if(is_string($arrElements[2]))
							{
								$objUser = $objDatabase->prepare("SELECT * FROM tl_member WHERE username=?")->limit(1)->execute($arrElements[2]);
							}
							else {return false;}
							
							if($objUser->numRows < 1)
							{
								return false;
							}
							
							return Gravatar::get($objUser->email);
							break;
						case 'user':
							$objDatabase = \Database::getInstance();
							
							// fetch from id
							if(is_numeric($arrElements[2]))
							{
								$objUser = $objDatabase->prepare("SELECT * FROM tl_user WHERE id=?")->limit(1)->execute($arrElements[2]);
							}
							// fetch from username
							else if(is_string($arrElements[2]))
							{
								$objUser = $objDatabase->prepare("SELECT * FROM tl_user WHERE username=?")->limit(1)->execute($arrElements[2]);
							}
							else {return false;}
							
							if($objUser->numRows < 1)
							{
								return false;
							}
							
							return Gravatar::get($objUser->email);
							break;
						default: 
							return false;
							break;
					}
				}
				
				if(!FE_USER_LOGGED_IN)
				{
					return false;
				}
					
				$this->import('FrontendUser','User');
				
				$email = $this->User->gravatarEmail ? $this->User->gravatarEmail : $this->User->email;
				
				return Gravatar::get($email);
				break;
			default:
				return false;
				break;
		}
	}
	
	
	
	
	
	
}