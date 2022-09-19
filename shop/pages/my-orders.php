<?php 

$om = new OrderManager();
$pm = new ProductManager();
$ris = $om->exist($loggedInUser->id);
// $allOrderInfo = $om->getAllOrderInfos($loggedInUser->id);
$currentDate = 0;
$cont = 1;
$product;
$tot = 0;
?>

<?php if($ris): ?>
    <?php foreach ($ris as $r): ?>
      <?php if(!($r["order_date"] == $currentDate)) : ?>
        <div>
        <div class="card text-center mt-4">
          <div class="card-header" style="background-color: #C024FF  !important;
    color: white  !important;">
            Ordine N°<?php echo $cont?> </br>
          </div>
          <div class="card-body">
          <?php $cac = $om->exist($loggedInUser->id); foreach ($cac as $c): ?>
            <?php if( $r["order_date"] ==  $c["order_date"]) : ?>
              <?php $product = $pm->getProductbyId($c["product_id"]) ?>
              <div class="row p-2">
                <div class="col-3">
                  <h5 class="card-text"><?php echo $product[0]['name'] ?></h5>
                </div>
                <div class="col 3">
                    <p class="card-text"><?php echo $product[0]["description"] ?></p>
                </div>
                <div class="col 3">
                    <p class="card-text">x<?php echo $c["quantity"] ?></p>
                </div>
                <div class="col 3">
                    <p class="card-text"><?php $pricing = $c["quantity"] * $product[0]["price"]; echo $pricing;  $tot += $pricing ?> €</p>
                </div>
                
              </div>
            <?php endif; ?>
            <?php endforeach; ?>
          </div> 
          <div>

          </div>
          <div class="card-footer text-muted" style="background-color: #C024FF  !important;
    color: white  !important;">
          <?php echo date('Y-m-d H:i:s', $r["order_date"] ) ?>
          </div>
        </div> 
        </div>
        <?php  $currentDate = $r["order_date"]; $cont++; ?>
        <?php endif; ?>  
<?php endforeach; ?>



<?php else: ?>
Non hai Ordini...

<?php endif; ?>