<?php

namespace WorldChat\WorldChat;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class EventListener implements Listener {
	
    /** @var WorldChat */
    private $plugin;
    
	public function __construct(WorldChat $plugin){
		$this->plugin = $plugin;
	}
	
	/**
	 * @param PlayerChatEvent $event
	 */
	public function onChat(PlayerChatEvent $event){
		$player = $event->getPlayer();
		if($this->plugin->isChatDisabled($player->getLevel()->getName())){
		    if($this->plugin->cfg["log-chat-disabled"]){
		        $player->sendMessage(TextFormat::colorize(WorldChat::PREFIX . "&cChat disabled on this world"));
		    }
		    $event->setCancelled(true);
		}
		$recipients = $event->getRecipients();
		foreach($recipients as $key => $recipient){
			if($recipient instanceof Player){
				if($recipient->getLevel() != $player->getLevel()){
					unset($recipients[$key]);
				}
			}
		}
		$event->setRecipients($recipients);
	}
}