<?php 

class UserManager extends DBManager {

    public function __construct()
    {
        parent::__construct();  
        $this->tableName = 'user';
        $this->columns = array('id','email','password','user_type_id');
    }

    // Public Method
    public function Login($email, $password){
        $result = $this->db->query("
        SELECT * 
        FROM user
        WHERE email = '$email' 
        AND password = MD5('$password');
        ");

        if(count($result) > 0) {
            $user = (object)$result[0];
            $this->_setUser($user);
            return true;
        }
        
        return false;
    }

    public function passwordsMatch($password,$confirm_password){
        return $password == $confirm_password;
    }

    public function register($email,$password){
        $result = $this->db->query("SELECT * FROM user WHERE email = '$email'");
        if(count($result) > 0){
            return false;
        }
        $userId = $this->create([
            'email' => $email,
            'password' => md5($password),
            'user_type_id' => 2
        ]);
        return $userId;
    }

    //Private Methods
    private function _setUser($user){
        
    $userToStore = (object) [
            'id' => $user->id,
            'email' => $user->email,
            'is_admin' => $user->user_type_id == 1,
            'is_supplier' => $user->user_type_id == 3,
            'user_id' => $user->user_id
        ];
        
        $_SESSION['user'] = $userToStore;

    }
    // Public Methods
    public function getCartTotal($userId) {
        $result = $this->db->query(" 
        SELECT
            SUM(quantity) as num_products
            , SUM(quantity * price) as total
            FROM cart_items
            INNER JOIN product
                ON cart_items.product_id = product.id
            WHERE user_id = $userId
            ");

        return $result[0];
    }

    public function getCartItems($userId) {
        return $result = $this->db->query(" 
        SELECT
            product.name as name,
            product.description as description,
            product.price as single_price,
            cart_items.quantity as quantity,
            product.price * cart_items.quantity as total_price,
            product.id as id
        FROM
            cart_items
            INNER JOIN product
            ON cart_items.product_id = product.id
        WHERE
            cart_items.user_id = $userId
            ");
    }


    public function getCurrentCartId(){
        $userId = 0;

        $result = $this->db->query("SELECT * FROM cart WHERE client_id = '$this->clientId'");
        if(count($result) > 0){
            $userId = $result[0]['id'];
        } else {
            $userId = $this->create([
                'client_id' => $this->clientId
            ]); 
        }

        return $userId;
    }

    public function removeFromCart($productId, $userId){

        $quantity = 0;
        $result = $this->db->query("SELECT quantity FROM cart_items WHERE user_id = $userId AND product_id = $productId");
        if(count($result) > 0 ){
            $quantity = $result[0]['quantity'];
        }
        $quantity--;

        if($quantity <= 0){
            $result = $this->db->query("DELETE FROM cart_items WHERE user_id = $userId AND product_id = $productId");
        }
        else{
            $result = $this->db->query("UPDATE cart_items SET quantity = $quantity WHERE user_id = $userId AND product_id = $productId");
        }
    }

    public function addToCart($productId, $userId){

        $quantity = 0;
        $result = $this->db->query("SELECT quantity FROM cart_items WHERE user_id = $userId AND product_id = $productId");
        if(count($result) > 0 ){
            $quantity = $result[0]['quantity'];
        }
        $quantity++;

        if(count($result) > 0) {
            $result = $this->db->query("UPDATE cart_items SET quantity = $quantity WHERE user_id = $userId AND product_id = $productId");
        } else {
            $cartItemMgr = new CartItemManager();
            $cartItemMgr->create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }
        
    }

    public function updateUser($user_id,$user_type_id){
        $this->db->query("UPDATE user SET user_type_id = $user_type_id WHERE id = $user_id;");
    }

    public function deleteUserFromDatabase($user_id){
        $this->db->query("DELETE FROM user WHERE user.id = $user_id;");
    }

    

}

class CartItemManager extends DBManager {
    public function __construct()
    {
        parent::__construct();
        $this->columns = array('user_id','product_id','quantity');
        $this->tableName = 'cart_items';
    }
}

class UserTypeManager extends DBManager {

    public function __construct()
    {
        parent::__construct();  
        $this->tableName = 'user_type';
        $this->columns = array('id','name');
    }

}


class OrderManager extends DBManager {

    public function __construct()
    {
        parent::__construct();  
        $this->tableName = 'orders';
        $this->columns = array('user_id','product_id','quantity');
    }


    //Public Methods

    public function createNewOrder($user_id){
        

        $timecode = time();
        $ris = $this->db->query("SELECT * FROM cart_items WHERE user_id = $user_id");
        // $datetime = date_create()->format('Y-m-d H:i:s');
        // var_dump($datetime);
         foreach($ris as $r){
             $this->db->query("INSERT INTO orders (user_id, product_id, quantity, order_date) VALUES ($r[user_id], $r[product_id], $r[quantity], $timecode)");
        }
        $this->db->query("DELETE FROM cart_items WHERE user_id = $user_id");
        
        


        
    }

    public function exist($user_id){
        $ris = $this->db->query("SELECT * FROM orders WHERE user_id = $user_id");

        return $ris;
    }
}


?>