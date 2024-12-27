<?php


require_once 'Database.php';
require_once 'Player.php';

use ORM\Database;
use Models\Player;


$newPlayer = new Player("Cristiano Ronaldo", "Al Nassr", "ronaldo.jpg", "Forward", 90);
$newPlayerId = $newPlayer->save();
echo "Player created with ID: " . $newPlayerId . "<br>";

$player = Player::find($newPlayerId);
if ($player) {
    echo "Player Name: " . $player->getName() . " from Team: " . $player->getTeam() . "<br>";
}


$player->name = "Cristiano Ronaldo Jr.";
$player->team = "Juventus";
$player->update($newPlayerId);
echo "Player updated to: " . $player->getName() . " from Team: " . $player->getTeam() . "<br>";

$player->delete($newPlayerId);
echo "Player deleted successfully.";
?>






     



    

