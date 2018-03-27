<?php
    
    /*
     * Plugin created by TheRealVerge
     */
namespace NoCombatFly;
//Events
use pocketmine\event\Listener as L;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
//Plugin
use pocketmine\plugin\PluginBase as PB;
//Server
use pocketmine\Player;
use pocketmine\Server;
//Level
use pocketmine\level\Level;
//Sound
use pocketmine\level\sound\GhastSound;
//Particle
use pocketmine\level\particle\HeartParticle;
//Utils
use pocketmine\utils\TextFormat as TF;

class NoCombatFly extends PB implements L{

  public function onEnable(){
   $this->getServer()->getLogger()->info("NCFly enabled");
   $this->getServer()->getPluginManager()->registerEvents($this, $this);
}
  public function onDisable(){
   $this->getServer()->getLogger()->info("NCFly disabled");
}
    
    /*
     * @param EntityDamageEvent $event
     */
	public function onDamage(EntityDamageEvent $event){
		if($event instanceof EntityDamageByEntityEvent){
			$human = $event->getEntity(); //Victim
			$damager = $event->getDamager(); //Attacker
     if($human instanceof Player && $damager instanceof Player){
		  if($damager->isFlying()){
					$damager->setFlying(false);
					$damager->sendMessage(TF::GRAY."(".TF::AQUA."!".TF::GRAY.")".TF::AQUA."Flight disabled in".TF::RED."Combat!");
//HeartParticle
$human->getLevel()->addParticle(new HeartParticle($human->getLocation()));
//GhastSound
$damager->getLevel()->addSound(new GhastSound($damager));
}
		 if($human->isFlying()){
					$human->setFlying(false);
					$human->sendMessage(TF::GRAY."(".TF::AQUA."!".TF::GRAY.")".TF::AQUA."Flight disabled in".TF::RED."Combat!");
//HeartParticle
$damager->getLevel()->addParticle(new HeartParticle($human->getLocation()));
//GhastSound
$human->getLevel()->addSound(new GhastSound($human));
					
				}
			}
		}
	}
}
