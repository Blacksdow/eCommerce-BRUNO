<?php

    
  if(isset($_SESSION['user'])) {
    $loggedInUser = $_SESSION['user'];
    $cm = new UserManager();
    $cartId =  $loggedInUser->id;
    $cart_total = $cm->getCartTotal($cartId);
  }
  
?>

<footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="<?php echo ROOT_URL?>public" class="nav-link px-2 text-muted">Home</a></li>
      <li class="nav-item"><a href="<?php echo ROOT_URL?>public/?page=services" class="nav-link px-2 text-muted">Services</a></li>
      <li class="nav-item"><a href="<?php echo ROOT_URL?>shop?page=products-list" class="nav-link px-2 text-muted">Products</a></li>
      <li class="nav-item"><a href="<?php echo ROOT_URL?>public/?page=about" class="nav-link px-2 text-muted">About</a></li>
    </ul>
    <p class="text-center text-muted">© 2022 Smart Home, Inc</p>
  </footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="<?php echo ROOT_URL; ?>js/main.js"></script>
    <script>
        $(document).ready(function(){
            if(<?php echo $loggedInUser->id ?> != isNaN)
            $('.js-totCartItems').html('<?php echo $cart_total['num_products'] ?>');
                
            
        })
    </script>
</body>
</html>