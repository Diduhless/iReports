<?php


namespace Reports;


use pocketmine\plugin\PluginBase;
use Reports\command\ReportCommand;

class Reports extends PluginBase {

    public function onEnable() {
        $this->getServer()->getCommandMap()->register("report", new ReportCommand());

        $this->getLogger()->info("Reports has been enabled!");
    }

}