<?php

class ModelExtensionAnimals extends Model {
    public function getUserAnimals($id_user){
        
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "users_animals` WHERE `user_id`='" . (int)$id_user . "'");
        return $query->rows;
        
    }
    public function addUserAnimals($user_id, $animal, $breed, $sex, $age){
         $query = $this->db->query("INSERT INTO `" . DB_PREFIX . "users_animals` SET `user_id` = '" . $user_id . "', `animal` = '" . $animal . "', `breed` = '" . $breed . "', `sex` = '" . $sex . "', `age` = '" . $age . "'");
         $inserted_id = $this->db->getLastId();
    
         return $inserted_id;
    }
    public function deleteUserAnimals($id){
        $query = $this->db->query("DELETE FROM `" . DB_PREFIX . "users_animals` WHERE `id`='" . (int)$id . "'");
    }
    public function getAllAnimals(){
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "animals` ORDER BY `id` ASC");
        return $query;
    }
    public function getNameAnimalsById($id){
        $query = $this->db->query("SELECT `name` FROM `" . DB_PREFIX . "animals` WHERE `id`='" . (int)$id . "'");
        return $query->row;
    }
    public function getBreedsByIdAnimals($id_animal){
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "animals_breed` WHERE `animal_id`='" . (int)$id_animal . "'");
        return $query;
    }
    public function getBreedsById($id){
        $query = $this->db->query("SELECT `breed` FROM `" . DB_PREFIX . "animals_breed` WHERE `id`='" . (int)$id . "'");
        return $query->row;
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