<?php

namespace WorldChat;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class WorldChat extends PluginBase {

    /** @var array */
    public array $cfg = [];
	
    public function onEnable() : void {
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig()->getAll();
	$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }
    
    public function isChatDisabled($level) : bool {
    	foreach($this->cfg["disabled-in-worlds"] as $item) {
    	    if(strcasecmp($item, $level) == 0) {
    	        return true;
    	    }
    	}
    return false;
    }
}
