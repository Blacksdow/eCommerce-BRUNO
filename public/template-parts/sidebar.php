<?php 

$db = new DB();
$ris;
$sql = "SELECT product.id, SUM(quantity) as solded_unit, product.name, product.description
            FROM orders, product
            WHERE product.id = orders.product_id
            GROUP BY product.name, product.description
            ORDER BY solded_unit DESC";

// $ris = mysqli_query($conn, $query) or die ("Query non valida");
// var_dump($ris);
// while ($riga=mysql_fetch_array($ris))
//     echo $riga['solded_unit']." ".$riga["product.name"]." ". $riga["product.description"];
// {
$ris = $db->query($sql);

// $ris = $db->pdo->query($sql);
// if(!$ris)
// {
//     die("Execute query error, because: ". print_r($db->pdo->errorInfo(),true) );
// }    
// $data = $ris->fetchAll(); 

// var_dump($data);
/*
SELECT product.id, SUM(quantity) as solded_unit, product.name, product.description
FROM orders, product
WHERE product.id = orders.product_id
GROUP BY product.name, product.description
ORDER BY solded_unit DESC
*/
?>


<div class="col-3">
    <?php if($ris): ?>
<h2>TRENDING <b>PRODUCTS</b></h2>
            <?php for($i = 0; $i<3; $i ++): ?>
            <div class="card mb-5" style="width: 18rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h5 class="card-title"><?php echo $ris[$i]["name"] ?></h5>
                        </div>
                        <div class="col-3">
                            <h6>#<?php echo $i+1 ?></h6>
                        </div>
                    </div>
                    <p class="card-text"><?php echo $ris[$i]["description"] ?></p>
                    <a href="<?php echo ROOT_URL .  'shop?page=view-product&id=' .$ris[$i]["id"] ?>" class="btn normal-btn">Visualizza Prodotto</a>
                </div>
            </div>
            <?php endfor; ?>
        </div>
        <?php else: ?>
            <p>Non ci sono prodotti disponibili...</p>
            <?php endif; ?>
</div>
