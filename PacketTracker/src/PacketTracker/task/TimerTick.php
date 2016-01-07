<?php
/**
 * Created by PhpStorm.
 * User: dishrex
 * Date: 1/5/16
 * Time: 10:12 AM
 */

namespace PacketTracker\task;

use PacketTracker\PacketTracker;
use pocketmine\utils\TextFormat;
use pocketmine\scheduler\PluginTask;


class TimerTick extends PluginTask
{
    public $plugin;

    public function __construct(PacketTracker $plugin) {
        parent::__construct($plugin);
        $this->plugin = $plugin;
    }

    public function onRun($currentTick){

        $this->plugin->tick++;

        switch($this->plugin->tick) {
            case 1:
                $this->plugin->startTracking();

                break;
            case 900:
                $this->plugin->endTracking();

        }



    }
}