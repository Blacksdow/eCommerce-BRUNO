<?php
    
     if(!defined('ROOT_URL')) {
         die;
     }

     if(!isset($_GET['id'])) {
         echo "<script>location.href='".ROOT_URL."';</script>";
         exit;
     }

         if(isset($_POST['add_to_cart'])) {

            $productId = htmlspecialchars(trim($_POST['id']));
            //addToCart Logic
            $cm = new UserManager();
            $cartId =  $loggedInUser->id;

            // aggiungi al carrello "cartId" il prodottoId"
            $cm->addToCart($productId, $cartId);

            //stampato un messaggio per l'utente
         }

    $id = htmlspecialchars(trim($_GET['id'])); //Serve a non far eseguire codice non benevolo
    $pm = new ProductManager();

    $product = $pm->get($id);

    if(!(property_exists($product, 'id'))) {
        echo "<script>location.href='".ROOT_URL."';</script>";
        exit;
    }

?>

<div class="normal-div text-white p-3 mb-2">
    <h1 class="display-5 text-white"><?php echo $product->name ?></h1>
    <p class="lead"><?php echo $product->price ?> €</p>
    <hr class="my-4">
    <p><?php echo $product->description ?></p>
    <p class="lead p-3"></p>
    <form method="post">
        <input name="id" type="hidden" value="<?php echo $product->id ?>">
        <input name="add_to_cart" type="submit" class="btn btn-dropdown " value="Aggiungi al carrello">
    </form>
    <p></p>
</div>