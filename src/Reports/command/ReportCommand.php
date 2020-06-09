<?php


namespace Reports\command;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class ReportCommand extends Command {

    public function __construct() {
        parent::__construct("report", "Reports a player", "Usage: /report <player> <reason>");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(!isset($args[1])) {
            $sender->sendMessage($this->getUsage());
            return;
        }

        $server = Server::getInstance();
        $name = array_shift($args);
        $player = $server->getPlayer($name);

        if($player != null) {
            foreach($server->getOnlinePlayers() as $onlinePlayer) {
                if(!$onlinePlayer->hasPermission("reports.admin")) {
                    continue;
                }

                $onlinePlayer->sendMessage(
                    "$name has been reported by " . $sender->getName() . " for " . implode(" ", $args)
                );
            }
        } else {
            $sender->sendMessage($name . " is not a valid player!");
        }
    }
}