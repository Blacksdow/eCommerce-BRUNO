<?php 

$user_id = $loggedInUser->id;
$om = new OrderManager();
$om->createNewOrder($user_id);





?>


<h1> Grazie per l'acquisto!</h1>