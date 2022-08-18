<?php

namespace WorldChat;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class EventListener implements Listener {
    
    public function __construct(private WorldChat $plugin) {
	    $this->plugin = $plugin;
    }
	
    public function onChat(PlayerChatEvent $event) {
	$player = $event->getPlayer();
	if($this->plugin->isChatDisabled($player->getWorld()->getFolderName())) {
	    if($this->plugin->cfg["log-chat-disabled"]) {
                $player->sendMessage(TextFormat::colorize($this->plugin->getConfig()->get("prefix") . "&cChat disabled on this world"));
	    }
	    $event->cancel();
	}
	$recipients = $event->getRecipients();
	foreach($recipients as $key => $recipient) {
            if($recipient instanceof Player) {
	        if($recipient->getWorld() != $player->getWorld()) {
		    unset($recipients[$key]);
		}
	    }
	}
	$event->setRecipients($recipients);
    }
}
