<?php


class ProductManager extends DBManager{

    public function __construct()
    {
        parent::__construct();
        $this->columns = array('id','name','description','price','category_id');
        $this->tableName = 'product';
    }


    // Public Methods
    public function updateProductDatabase($product_id, $product_name,$product_description,$product_price,$product_category){
        $this->db->query("UPDATE product SET name = '$product_name', description = '$product_description', price = '$product_price', category_id = $product_category WHERE id = $product_id;");
    }

    public function deleteProductFromDatabase($product_id){ 
        $this->db->query("DELETE FROM product WHERE product.id = $product_id;");
    }

    public function addProduct($product_name,$product_description,$product_price,$product_category){
        $product_id = $this->getLastProductId();
        $this->db->query("INSERT INTO product (id, name, description, price, category_id) VALUES ($product_id, '$product_name', '$product_description', $product_price, $product_category);");
    }

    public function getProductbyId($product_id){
        $ris = $this->db->query("SELECT * FROM product WHERE id = $product_id");

        return $ris;
    }


    //Private Methods
    private function getLastProductId(){
        $result = $this->db->query("SELECT * FROM product
        WHERE id = (
            SELECT MAX(id) FROM product)");
        var_dump($result[0]["id"] + 1);
        return $result[0]['id'] + 1;
    }
}


?>