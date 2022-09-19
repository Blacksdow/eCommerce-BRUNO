<?php if($loggedInUser->is_admin ) : ?>
<?php

$productMgr = new ProductManager();
$products = $productMgr->getAll();

$categoryMgr = new CategoryManager();
$categories = $categoryMgr->getAll();

if(isset($_POST['save_changes'])) {


    $product_name = htmlspecialchars(trim($_POST['product-name']));
    $product_description = htmlspecialchars(trim($_POST['product-description']));
    $product_price = htmlspecialchars(trim($_POST['product-price']));
    $product_id = htmlspecialchars(trim($_POST['product-id']));
    $product_category = htmlspecialchars(trim($_POST['product-category']));

    //UpdateDatabase
    $pm = new ProductManager();
  
    // aggiungi al database il prodotto aggiornato
    $pm->updateProductDatabase($product_id, $product_name,$product_description,$product_price,$product_category);
  }

  if(isset($_POST['delete_product'])) {
 
    $product_id = htmlspecialchars(trim($_POST['product-id']));
    

    //UpdateDatabase
    $pm = new ProductManager();
  
    
    $pm->deleteProductFromDatabase($product_id);
    echo "<script>window.location.reload();</script>";
  }

  if(isset($_POST['add_product'])) {
 
    $product_name = htmlspecialchars(trim($_POST['product-name']));
    $product_description = htmlspecialchars(trim($_POST['product-description']));
    $product_price = htmlspecialchars(trim($_POST['product-price']));
    $product_category = htmlspecialchars(trim($_POST['product-category']));
    

    //UpdateDatabase
    $pm = new ProductManager();
    
    $upload_path = ROOT_PATH . "img\\products\\";
    $filename = $product_name. ".jpeg";
    $target_file = $upload_path.$filename;
    $check = true;
    $output = "";

    if(file_exists($target_file)) {
        $check = false;
        $output =  "Il file esiste già!";
    }

    if($_FILES['file']['size'] > 2000000) {
        $check = false;
        $output =  "Il file è troppo grande (Max 2MB)";
    }

    $ext = strtoupper(pathinfo($target_file, PATHINFO_EXTENSION));
    if($ext != "JPG" && $ext != "JPEG" && $ext != "PNG") {
        $check = false;
        $output = "Estensione non valida! (solo JPEG, JPG, PNG)";
    }

        if($check) {
            if(!move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                echo "Upload fallito...";
            } else {
                $pm->addProduct($product_name,$product_description,$product_price,$product_category);
            }
        } else {
            echo $output;
        }
    }


  if(isset($_POST['add_category'])) {

    $category_name = htmlspecialchars(trim($_POST['category-name']));
    $upload_path = ROOT_PATH . "img\\categories\\";
    $filename = $category_name. ".jpeg";
    $target_file = $upload_path.$filename;
    $check = true;
    $output = "";

    if(file_exists($target_file)) {
        $check = false;
        $output =  "Il file esiste già!";
    }

    if($_FILES['file']['size'] > 2000000) {
        $check = false;
        $output =  "Il file è troppo grande (Max 2MB)";
    }

    $ext = strtoupper(pathinfo($target_file, PATHINFO_EXTENSION));
    if($ext != "JPG" && $ext != "JPEG" && $ext != "PNG") {
        $check = false;
        $output = "Estensione non valida! (solo JPEG, JPG, PNG)";
    }

        if($check) {
            if(!move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                echo "Upload fallito...";
            } else {
                $categoryMgr->addCategory($category_name);
            }
        } else {
            echo $output;
        }
    }

    

?>


<?php if($products) : ?>
    <h2 class="lead" style="font-size:22pt ;">Modifica Prodotti</h2>
    <div class="container-fluid">
        <?php foreach($products as $product) : ?>
        <form method="POST" action="">
            <div class="row mt-3">
                <input name="product-name" class="col-1" type="text" value="<?php echo $product->name ?>"/>
                <input name="product-description" class="col-3" type="text" value="<?php echo $product->description ?>"/>
                <input name="product-price" class="col-1" type="text" value="<?php echo $product->price ?>"/>
                <input type="hidden" name="product-id" value="<?php echo $product->id ?>">
                <select name="product-category" class="col-2">
                    <?php foreach($categories as $category) : ?>
                        <OPTION value="<?php echo $category->id ?>"  <?php if($product->category_id == $category->id): ?> SELECTED <?php endif; ?>>
                        <?php echo $category->name ?>
                        </OPTION>
                    <?php endforeach; ?>
                </select>
                <input type="submit" class="col-2" value="Salva Cambiamenti" name="save_changes">
                <input type="submit" class="bg-danger col-2" value="Cancella" name="delete_product">
            </div>
        </form>
        <?php endforeach; ?>
    </div>
    <?php if($categories) : ?>
    <div class="container-fluid row-100">
        <h2 class="lead mt-5" style="font-size:22pt ;">Aggiungi un prodotto</h2>
        <form method="POST" enctype="multipart/form-data">
            <input name="product-name" class="container-fluid mt-3" type="text" value="" placeholder="Inserisci il Nome del Prodotto"/>
                    <input name="product-description" class="container-fluid mt-3" type="text" value="" placeholder="Inserisci una descrizione del prodotto"/>
                    <input name="product-price" class="container-fluid mt-3" type="text" value="" placeholder="Iserisci il Prezzo del prodotto"/>
                    <select name="product-category" class="container-fluid mt-3">
                        <?php foreach($categories as $category) : ?>
                            <OPTION value="<?php echo $category->id ?>">
                            <?php echo $category->name ?>
                            </OPTION>
                        <?php endforeach; ?>
                    </select>
                    <input type="file" class="form-group mt-3" name="file" /><br>
                    <input type="submit" class="bg-success mt-3" value="Aggiungi!" name="add_product">   
        </form>
    </div>
    <br><br>
    <?php endif; ?>
    <?php endif; ?>
    <div class="container-fluid row-100">
        <h2 class="lead mt-5" style="font-size:22pt ;">Aggiungi una Categoria</h2>
        <form method="POST" enctype="multipart/form-data" action="">
            <input name="category-name" class="container-fluid mt-3 form-group" type="text" value="" placeholder="Inserisci il Nome della Categoria"/>
            <input type="file" class="form-group mt-3" name="file" />
            <input type="submit" name="add_category" value="Carica" />
        </form>
    </div>
    
    
    

<?php else: ?> 
<h1>Torna quando sarai un admin...</h1>
¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶______________¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___________________¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶______¶¶¶¶¶¶¶¶¶¶¶______¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶¶¶_____¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶_____¶¶¶¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶¶____¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶_____¶¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶____¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶____¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶____¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶
¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶
¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶
¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶
¶¶¶¶¶___¶¶¶_________¶¶¶¶¶¶¶¶¶¶¶¶¶¶___________¶¶¶__¶¶¶¶¶
¶¶¶¶¶__¶¶¶¶¶¶¶_______¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶_____¶¶¶¶¶¶___¶¶¶¶
¶¶¶¶___¶¶¶¶¶¶¶¶______¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶__¶¶¶¶
¶¶¶¶__¶¶¶¶¶¶¶¶¶¶______¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶___¶¶¶
¶¶¶___¶¶¶¶¶¶¶¶¶¶¶______¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶__¶¶¶
¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶_______¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶___¶¶
¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶________¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶__¶¶
¶¶___¶¶¶¶¶¶¶¶¶¶¶¶__¶_____¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶__¶¶
¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶_____¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶__¶¶
¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶______¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶__¶¶
¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶______¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶___¶
¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶______¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶__¶
¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶______¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶__¶
¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶_____¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶__¶
¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶______¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶__¶
¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶______¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶__¶
¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶______¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶__¶
¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶______¶¶¶¶___¶¶¶¶¶¶¶¶¶¶___¶
¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶_____¶¶¶¶___¶¶¶¶¶¶¶¶¶¶___¶
¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶______¶¶¶___¶¶¶¶¶¶¶¶¶¶__¶¶
¶¶___¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶¶______¶¶___¶¶¶¶¶¶¶¶¶¶__¶¶
¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶______¶¶__¶¶¶¶¶¶¶¶¶¶__¶¶
¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶_____¶¶__¶¶¶¶¶¶¶¶¶___¶¶
¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶¶________¶¶¶¶¶¶¶¶¶__¶¶¶
¶¶¶¶__¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶¶________¶¶¶¶¶¶¶¶¶__¶¶¶
¶¶¶¶__¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶_______¶¶¶¶¶¶¶¶___¶¶¶
¶¶¶¶___¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶______¶¶¶¶¶¶¶¶__¶¶¶¶
¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶_____¶¶¶¶¶¶¶___¶¶¶¶
¶¶¶¶¶___¶¶¶¶¶¶¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶____¶¶¶¶¶¶¶__¶¶¶¶¶
¶¶¶¶¶¶___¶¶¶¶¶¶¶____¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶___¶¶¶¶¶
¶¶¶¶¶¶¶__¶¶¶¶__________¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶___¶¶¶¶¶¶
¶¶¶¶¶¶¶___¶¶___________¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶__¶¶¶¶___¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶____¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶___¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶____¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶____¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶____¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶____¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶____¶¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶¶¶____¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶_____¶¶¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶_____¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶_____¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶________¶¶¶¶¶¶________¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶_________________¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶__________¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
<?php endif; ?>