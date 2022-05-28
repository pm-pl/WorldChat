<?php

/*
 * PerWorldChat v2.0 by Henry12960
 * Developer: Flavius12
 * Website: https://github.com/Henry12960
 * Copyright (C) 2014-2022 Henry
 * Licensed under MIT https://github.com/Henry12960
 */

namespace PerWorldChat\PerWorldChat;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class PerWorldChat extends PluginBase {
	
    /** @var string */
	const PREFIX = "&6[WorldChat] ";
	
	/** @var array */
	public $cfg;
	
    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig()->getAll();
	    $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }
    
    /**
     * Check if chat is disabled on the specified world
     * 
     * @param string
     * 
     * @return bool
     */
    public function isChatDisabled($level) : bool {
    	foreach($this->cfg["disabled-in-worlds"] as $item){
    	    if(strcasecmp($item, $level) == 0){
    	        return true;
    	    }
    	}
    	return false;
    }
}
