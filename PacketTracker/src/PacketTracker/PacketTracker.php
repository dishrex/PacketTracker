<?php
/**
 * Created by PhpStorm.
 * User: dishrex
 * Date: 1/5/16
 * Time: 9:47 AM
 */

namespace PacketTracker;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;


class PacketTracker extends PluginBase
    {
    protected $listener;
    public $tick = 0;

    /* PacketData */
    public $receivedPackets = [];
    public $sentPackets = [];
    public $trackingOn = false;

    /* ConfigData */
    protected $logDir;
    protected $logName;
    protected $startTime;
    protected $endTime;



    /**
     * Ran when plugin is enabled.
     *
     * @see \pocketmine\plugin\PluginBase::onEnable()
     */
    public function onEnable() {
        $this->getLogger()->info("Starting PacketTracker...");
        $this->logDir = $this->getServer()->getPluginPath().'PacketTracker-Logs';

        $this->listener = new EventListener($this);
        $this->getServer()->getPluginManager()->registerEvents($this->listener, $this);
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new task\TimerTick($this), 20);

        $this->startTime = date('m-d-Y h:i:s');


    }

    /**
     * Ran when plugin is disabled.
     *
     * @see \pocketmine\plugin\PluginBase::onDisable()
     */
    public function onDisable() {
        $this->getLogger()->info("PacketTracker being disabled...");

        if($this->trackingOn === true) {
            $this->endTracking();
        }

    }

    /**
     * After
     */

    public function createReport(){

        if($this->nameFile()) {
            $this->getLogger()->info('Creating New PacketTracker Log: ' . $this->logName);
            $logFileHandle = fopen($this->logDir.'/'.$this->logName, 'a');

            if($logFileHandle !== false) {
                fputs($logFileHandle, "Packets tracked from ". $this->startTime. " through ". $this->endTime."\n\n");

                fputs($logFileHandle, "SENT PACKETS\n______________\nID               COUNT\n");

                $sentPkCount = 0;
                foreach ($this->sentPackets as $id => $count) {

                    fputs($logFileHandle, "{$id} = {$count}\n");
                    $sentPkCount += $count;
                }

                fputs($logFileHandle, "\n\nRECEIVED PACKETS\n______________\nID               COUNT\n");
                $receivedPkCount = 0;
                foreach ($this->receivedPackets as $id => $count) {
                    fputs($logFileHandle, "{$id} = {$count}\n");
                    $receivedPkCount += $count;
                }

                $totalPks = $sentPkCount + $receivedPkCount;
                fputs($logFileHandle, "\n__________________\nSent Packets: {$sentPkCount}\nReceived Packets: {$receivedPkCount}\nTOTAL: {$totalPks}\n");
                fclose($logFileHandle);
            }
        }
    }

    private function nameFile(){


        if (!is_dir( $this->logDir )) {
            mkdir( $this->logDir, 0777, true);
        }
        $logFileName = $this->startTime.'-'.$this->endTime;

        if (!file_exists( $logFileName)){
            $this->logName =  $logFileName;
            return true;
        } else {
            return false;
        }


    }

    /**
     * This starts the tracking
     */

    public function startTracking(){
        $this->getLogger()->info(TextFormat::GREEN.'Starting to track packets with PacketTracker');
        $this->startTime = date('m-d-Y_h:i:s');
        $this->trackingOn = true;
    }

    public function endTracking(){
        $this->getLogger()->info(TextFormat::GREEN.'Stopping tracking packets with PacketTracker');
        $this->endTime = date('h:i:s');
        $this->trackingOn = false;
        $this->createReport();
    }


}