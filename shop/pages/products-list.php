
<?php

$productMgr = new ProductManager();
$products = $productMgr->getAll();

$categoryMgr = new CategoryManager();
$categories = $categoryMgr->getAll();

$selected_category = 0;

/*if(isset($_POST['category'])) {
$selected_category = $_POST['category'];*/

if (isset($_GET['category'])) {
  $selected_category = $_GET['category'];
}



if (isset($_POST['add_to_cart'])) {

  $productId = htmlspecialchars(trim($_POST['id']));
  //addToCart Logic
  $cm = new UserManager();
  $cartId =  $loggedInUser->id;

  // aggiungi al carrello "cartId" il prodottoId"
  $cm->addToCart($productId, $cartId);
}
?>


<h2 class="lead" style="font-size:22pt ;">PRODOTTI</h2>




<?php if ($loggedInUser) : ?>
  <form method="GET" name="category" action="?page=products-list">
    <p>Categorie:<br>
      <SELECT name='category' id="category">
        <OPTION value="0">
          Tutte le categorie
        </OPTION>
        <?php foreach ($categories as $category) : ?>
          <OPTION value="<?php echo $category->id ?>">
            <?php echo $category->name ?>
          </OPTION>
        <?php endforeach; ?>
      </SELECT>
    </p>
    <input type="submit" />
  </form>


  <div class="container-xl">
    <div class="row">
      <div class="col-md-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
          <!-- Carousel indicators -->

          <!-- Wrapper for carousel items -->
          <div class="carousel-inner">
            <div class="item carousel-item active">
              <div class="row">
                <?php if ($products) : ?>
                  <?php foreach ($products as $product) : ?>
                    <?php if ($product->category_id == $selected_category || $selected_category == 0) : ?>
                      <div class="col-sm-4">
                        <div class="thumb-wrapper m-3">
                          <div class="img-box">
                            <img src="<?php echo ROOT_URL ?>img/products/<?php echo $product->name ?>.jpeg" class="img-fluid" alt="">
                          </div>
                          <div class="thumb-content">
                            <h4><?php echo $product->name ?></h4>
                            <div class="star-rating">
                              <small class="text-muted"><?php echo $product->price ?> €</small>
                            </div>
                            <a href="<?php echo ROOT_URL ?>shop/?page=view-product&id=<?php echo $product->id ?>" class="btn btn-primary">Visualizza</a>
                            <form method="post">
                              <input type="hidden" name="id" value="<?php echo $product->id ?>">
                              <input name="add_to_cart" type="submit" class="btn btn-primary" value="Aggiungi al carrello">
                            </form>
                          </div>
                        </div>
                      </div>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php else : ?>
                  <p>Nessun prodotto disponibile al momento...</p>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <!-- Carousel controls -->

        </div>
      </div>
    </div>
  </div>
<?php else : ?>
  <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Attenzione!</h4>
    <p>Per effettuare acquisti bisogna fare l'accesso con un account</p>
    <hr>
    <a href="<?php echo ROOT_URL ?>auth" class="mb-0 nav-link">Clicca qui per fare il Login o per Registrarti!</a>
  <?php endif; ?>