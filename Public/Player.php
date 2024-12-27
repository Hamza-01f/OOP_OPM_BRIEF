<?php

namespace Models;

use ORM\Database;

class Player {
    public $id;
    public $name;
    public $team;
    public $photo;
    public $position;
    public $rating;
    public $deleted_players;
    private $db;

    public function __construct($name = null, $team = null, $photo = null, $position = null, $rating = null) {
        $this->db = new Database();
        $this->name = $name;
        $this->team = $team;
        $this->photo = $photo;
        $this->position = $position;
        $this->rating = $rating;
    }

    public function save() {
        $data = [
            'name_player' => $this->name,
            'team' => $this->team,
            'photo' => $this->photo,
            'position' => $this->position,
            'rating' => $this->rating,
        ];
        return $this->db->create('players', $data);
    }

    public static function find($id) {
        $db = new Database();
        $result = $db->read('players', "id = $id");
        if (count($result) > 0) {
            $playerData = $result[0];
            return new Player($playerData['name_player'], $playerData['team'], $playerData['photo'], $playerData['position'], $playerData['rating']);
        }
        return null;
    }

    public function update($id) {
        $data = [
            'name_player' => $this->name,
            'team' => $this->team,
            'photo' => $this->photo,
            'position' => $this->position,
            'rating' => $this->rating,
        ];
        return $this->db->update('players', $data, "id = $id");
    }

    public function delete($id) {
        return $this->db->delete('players', "id = $id");
    }

    public function getName() {
        return $this->name;
    }

    public function getTeam() {
        return $this->team;
    }
}

