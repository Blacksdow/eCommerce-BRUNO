<?php

$productMgr = new ProductManager();
$products = $productMgr->getAll();

$categoryMgr = new CategoryManager();
$categories = $categoryMgr->getAll();

$selected_category = 0;

/*if(isset($_POST['category'])) {
$selected_category = $_POST['category'];*/

if(isset($_GET['category'])) {
  $selected_category = $_GET['category'];
}



if(isset($_POST['add_to_cart'])) {

  $productId = htmlspecialchars(trim($_POST['id']));
  //addToCart Logic
  $cm = new UserManager();
  $cartId =  $loggedInUser->id;

  // aggiungi al carrello "cartId" il prodottoId"
  $cm->addToCart($productId, $cartId);
}
?>
<h2 class="lead" style="font-size:22pt ;">PRODOTTI</h2>
<?php if($loggedInUser): ?>
<form method="GET" name="category" action="?page=products-list" >
  <p>Categorie:<br>
  <SELECT name='category' id="category">
    <OPTION value="0">
        Tutte le categorie
    </OPTION>
  <?php foreach($categories as $category) : ?>
    <OPTION value="<?php echo $category->id ?>">
      <?php echo $category->name ?>
    </OPTION>
  <?php endforeach; ?>
  </SELECT>
  </p>
  <input type="submit"/>
</form>

<div class="row">


<?php if($products) : ?>
    <?php foreach($products as $product) : ?>
    
    <?php if($product->category_id == $selected_category || $selected_category == 0) : ?>
    <div class="product-card card mb-3 col-md-3 col-6" >
      <img src="<?php echo ROOT_URL?>img/products/<?php echo $product->name ?>.jpeg"/>
      <div class="card-header bg-dark text-light rounded-0">
         <?php echo $product->name ?>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <?php echo $product->description ?>
          <small class="text-muted right"><?php echo $product->price ?> €</small>
        </li>
      </ul>
      <div class="footer">
        <div class="product-actions">
          <button class="btn btn-secondary btn-sm btn-block rounded-0" onclick="location.href='<?php echo ROOT_URL .  'shop?page=view-product&id=' .$product->id ?>'">Vedi</button>
          <!--<a class="btn btn-outline-primary btn-sm" href="#">Aggiungi al carrello</a>-->
          <form method="post">
            <input type="hidden" name="id" value="<?php echo $product->id ?>">
            <input name="add_to_cart" type="submit" class="btn btn-primary btn-sm btn-block rounded-0" value="Aggiungi al carrello">
          </form>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    
    <?php else : ?>
        <p>Nessun prodotto disponibile al momento...</p>
<?php endif; ?>
<?php else :?>
  <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Attenzione!</h4>
          <p>Per effettuare acquisti bisogna fare l'accesso con un account</p>
          <hr>
          <a href="<?php echo ROOT_URL ?>auth" class="mb-0 nav-link">Clicca qui per fare il Login o per Registrarti!</a>
          <?php endif; ?>
</div> 
