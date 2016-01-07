<?php
namespace PacketTracker;

use pocketmine\level;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\event\server\DataPacketReceiveEvent;


class EventListener implements Listener
{
	private $plugin;
    public $server;


	public function __construct(PacketTracker $plugin)
    {
        $this->plugin = $plugin;
        $this->server = $this->plugin->getServer();


    }

    public function onDataPacketReceiveEvent(DataPacketReceiveEvent $event){

        if($this->plugin->trackingOn) {
            $packet = $event->getPacket();
            // $pkId = $packet->pid();
            $class_path_ar = explode('\\', get_class($packet));
            $pkName = end($class_path_ar);

            if (isset($this->plugin->receivedPackets[$pkName])) {
                $this->plugin->receivedPackets[$pkName]++;
            } else {
                $this->plugin->receivedPackets[$pkName] = 1;
            }
        }
        /*
         if(isset($this->plugin->receivedPackets[$pkId])) {
            $this->plugin->receivedPackets[$pkId]++;
        } else {
            $this->plugin->receivedPackets[$pkId] = 1;
        }
        */
    }

    public function onDataPacketSendEvent(DataPacketSendEvent $event){
        if($this->plugin->trackingOn) {
            $packet = $event->getPacket();
            //$pkId = $packet->pid();
            $class_path_ar = explode('\\', get_class($packet));
            $pkName = end($class_path_ar);

            if (isset($this->plugin->sentPackets[$pkName])) {
                $this->plugin->sentPackets[$pkName]++;
            } else {
                $this->plugin->sentPackets[$pkName] = 1;
            }
        }

        /*

        if(isset($this->plugin->sentPackets[$pkId])) {
            $this->plugin->sentPackets[$pkId]++;
        } else {
            $this->plugin->sentPackets[$pkId] = 1;
        }
        */

    }





}