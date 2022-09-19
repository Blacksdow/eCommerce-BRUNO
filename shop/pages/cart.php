<?php

//$cart_total = $um->getCartTotal();

if(isset($_SESSION['user'])) {
$um = new UserManager();
$cartId =  $loggedInUser->id;
}


// [
// 'num_products' => 4,
// 'total' => 35.00
// ];


//   [
//   'name' => 'Prodotto 1',
//   'description' => 'Questo è il prodotto 1',
//   'single_price' => 29,
//   'quantity' => 2,
//   'total_price' => 58
//   ],
//   [
//   'name' => 'Prodotto 2',
//   'description' => 'Questo è il prodotto 2',
//   'single_price' => 3,
//   'quantity' => 5 ,
//   'total_price' => 15
//   ],
// ];

if(isset($_POST['minus'])) {
  //rimuovo dal carrello
  $productId = htmlspecialchars(trim($_POST['id']));
  $um->removeFromCart($productId, $cartId);
}

if(isset($_POST['plus'])) {
  //aggiungo al carrello\
  $productId = htmlspecialchars(trim($_POST['id']));
  $um->addToCart($productId, $cartId);
}
if($loggedInUser) {
$cart_total = $um->getCartTotal($cartId);
$cart_items = $um->getCartItems($cartId);
}
?>


<?php if($loggedInUser): ?>
<div class="col-12 mb-4">
  <?php if (count($cart_items) > 0): ?>
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-dark">Carrello</span>
          <span class="badge bg-success text-white rounded-pill"><?php echo $cart_total['num_products'] ?> elementi nel carrello</span>
        </h4>
        
        <ul class="list-group mb-3">

        <?php foreach($cart_items as $item): ?>
          <li class="list-group-item d-flex justify-content-between lh-sm p-4">
            <div class="row w-100">
                <div class="col-lg-4 col-6">
                    <h6 class="my-0"><?php echo $item['name']?></h6>
                    <small class="text-muted"><?php echo $item['description']?></small>
                </div>
                <div class="col-lg-2 col-6">
                    <span class="text-muted">€<?php echo $item['single_price']?></span>
                </div>
                <div class="col-lg-4 col-6">
                  <form method="POST">
                    <div class="btn-group">
                        <button name="minus" type="submit" class="btn btn-sm btn-primary">-</button>
                        <span class="cart-buttons text-muted" style="width:50px; text-align:center; border: 1px solid;"><?php echo $item['quantity']?></span>
                        <button name="plus" type="submit" class="btn btn-sm btn-primary">+</button>
                        <input type="hidden" name="id" value="<?php echo $item['id'] ?>"/>
                     </div>
                  </form>
                </div>
                <div class="col-lg-2 col-6">
                    <strong class="text-primary"><?php echo $item['total_price']?></strong>
                </div>
            </div>
          </li>
          <?php endforeach ?>
          <li class="list-group-item d-flex justify-content-between p-4" style="font-size: 12pt;">
            <div class="row w-100">
              <div class="col-lg-4 col-6">
                  <span>Totale</span>
             </div>
            </div>
            <div class="col-lg-6 lg-screen"></div>
            <div class="col-lg-2 col-6">
              <strong class="text-muted">€ <?php echo $cart_total['total'] ?></strong>
            </div>  
          </li>
        </ul>
        

        <hr>    

        <a class="btn btn-dark btn-block" href="<?php echo ROOT_URL?>shop?page=checkout">Checkout</a>
        <?php else: ?>
          <p class="lead">Nessun elemento nel carrello...</p>
          <a href="<?php echo ROOT_URL ?>shop?page=products-list" class="normal-btn btn btn-lg mb-5 mt-3">Torna a fare acquisti &raquo;</a>
          
        <?php endif; ?>
        </div>
        <?php else: ?>
          <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Attenzione!</h4>
          <p>Per effettuare acquisti bisogna fare l'accesso con un account</p>
          <hr>
          <a href="<?php echo ROOT_URL ?>auth" class="mb-0 nav-link">Clicca qui per fare il Login o per Registrarti!</a>
        </div> 

            
        <?php endif; ?>
      
