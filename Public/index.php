<?php

namespace App\index;

require_once 'Database.php';


use App\ORM\Database;

class newPlayer {
    public $id;
    public $name;
    public $team;
    public $position;
    public $rating;
    private $db;


    public function __construct($name, $team, $position, $rating) {
        $this->name = $name;
        $this->team = $team;
        $this->position = $position;
        $this->rating = $rating;
    }


    public function save() {
        $db = new Database();
        $conn = $db->getConnection();

       
        $stmt = $conn->prepare("INSERT INTO FakeFootChampion (name_player, team, position, rating) VALUES (:name_player, :team, :position, :rating)");

        $stmt->bindParam(':name_player', $this->name, \PDO::PARAM_STR);
        $stmt->bindParam(':team', $this->team, \PDO::PARAM_STR);
        $stmt->bindParam(':position', $this->position, \PDO::PARAM_STR);
        $stmt->bindParam(':rating', $this->rating, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo 'Player added successfully';
            return $conn->lastInsertId();  
        } else {
            echo 'Error inserting player';
            return false;
        }
    }

    public static function find($id) {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM FakeFootChampion WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function delete($id) {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("DELETE FROM FakeFootChampion WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Player with ID $id has been deleted successfully.";
            return true;
        } else {
            echo "Error deleting player with ID $id.";
            return false;
        }
    }
}


$newPlayer = new newPlayer("Cristiano Ronaldo", "Al Nassr", "Forward", 90);
$newPlayerId = $newPlayer->save(); 
echo "Player created with ID: " . $newPlayerId . "<br>";

$foundPlayer = newPlayer::find($newPlayerId);
echo "Found player: ";
print_r($foundPlayer);


$newPlayer->delete($newPlayerId);
?>












     



    

