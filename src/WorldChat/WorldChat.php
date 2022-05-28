<?php

namespace WorldChat\WorldChat;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

namespace\package\WorldChat {
	
    /** @var string */
	const PREFIX = "&6[WorlChat] ";
	
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
