<?php


class CategoryManager extends DBManager{

    public function __construct()
    {
        parent::__construct();
        $this->columns = array('id','name');
        $this->tableName = 'category';
    }

    public function addCategory($category_name){
        $category_id = $this->getLastCategoryId();
        $this->db->query("INSERT INTO category (id, name) VALUES ($category_id, '$category_name');");
    }

    //Private Methods
    private function getLastCategoryId(){
        $result = $this->db->query("SELECT * FROM category
        WHERE id = (
            SELECT MAX(id) FROM category)");
        return $result[0]['id'] + 1;
    }
}


?>