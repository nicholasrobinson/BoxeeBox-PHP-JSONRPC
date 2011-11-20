<?php
/*
 *	File:			Player.class.php
 *	Description:	Generate json encoded strings for Player methods
 *	Author:			Nicholas Robinson 11/19/2011
 */

# Includes
if (!defined('ROOT'))
{
	define('ROOT', dirname(dirname(__FILE__)));
}
require_once(ROOT . '/Services/BaseClass.class.php');

/** 
* Generate json encoded strings for Player methods
*/
class Player extends BaseClass
{
	
	/** 
	* Returns which players are active (available for querying)
	* Note: AudioPlayer, VideoPlayer and Slideshow methods are only available if there respective player is active, 
	* use this function to obtain that information
	*
	* @return 
	* video		 boolean		 True if video is available, false otherwise; 
	* audio		 boolean		 True if audio is available, false otherwise; 
	* picture	 boolean		 True if pictures are playing, false otherwise; 
	* browser	 boolean		 True if the web browser is running, false otherwise; 
	*/
	public function GetActivePlayers()
	{
		$this->method = get_class($this) . '.' . __FUNCTION__;
		return self::stringify($this);
	}

}

?>