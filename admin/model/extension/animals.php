<?php

class ModelExtensionAnimals extends Model {
    public function maybeCreateDBTableUsersAnimals() {
        return $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "users_animals` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11),
              `animal` VARCHAR(255),
              `breed` VARCHAR(255),
              `sex` VARCHAR(255),
              `age` int(11),
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;");
    }
    public function maybeCreateDBTableAnimals() {
        return $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "animals` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` VARCHAR(255),
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;");
    }
    public function maybeCreateDBTableAnimalsBreed() {
        return $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "animals_breed` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `animal_id` int(11),
              `breed` VARCHAR(255),
              `sex` int(2),
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;");
    }
    
    public function getAllAnimals(){
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "animals` ORDER BY `id` DESC");
        return $query;
    }
    public function getAllBreeds(){
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "animals_breed` ORDER BY `id` DESC");
        return $query;
    }
    public function getAllAnimalsBreeds(){
        $query = $this->db->query("SELECT a.id AS animal_id, a.name AS animal_name, b.breed, b.sex
        FROM `" . DB_PREFIX . "animals` AS a
        LEFT JOIN `" . DB_PREFIX . "animals_breed` AS b ON a.id = b.animal_id
        ORDER BY a.id DESC
    ");
        return $query;
    }
}
?>