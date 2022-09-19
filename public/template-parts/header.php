<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
    <title>eCommerce</title>
</head>
<body>
<nav class="navbar-custom navbar navbar-expand-md mb-4">
  <div class="container">
  <a class="navbar-brand" href="<?php echo ROOT_URL ?>public">
      <img src="<?php echo ROOT_URL ?>img\logo-lessborder.png" alt="Logo" width="100" height="100">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item mr-5 ml-2">
          <a class="a-nav-item" href="<?php echo ROOT_URL; ?>public?page=about">Chi Siamo</a>
        </li>
        <li class="nav-item mr-5 ml-2">
          <a class="a-nav-item" href="<?php echo ROOT_URL; ?>public?page=services">Servizi</a>
        </li>
        <li class="nav-item mr-5 ml-2">
          <a class="a-nav-item" href="<?php echo ROOT_URL; ?>shop?page=products-list">Prodotti</a>
        </li>
        <li class="nav-item mr-5 ml-2">
          <a class="a-nav-item" href="<?php echo ROOT_URL; ?>public?page=contats">Contatti</a>
        </li>
      </ul>

      <ul class="navbar-nav me-auto mb-2 mb-md-0 ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo ROOT_URL ;?>shop?page=cart">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge badge-pill badge-success js-totCartItems"></span>
          </a>
        </li>
      </ul>
      <?php if($loggedInUser): ?>
        <div class="dropdown">
        <button class="btn btn-dropdown dropdown-toggle mr-5" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php  echo $loggedInUser->email ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <a class="dropdown-item" style="color: #C024FF !important;" href="<?php echo ROOT_URL; ?>auth?page=logout">Logout</a>
          <a class="dropdown-item" style="color: #C024FF !important;" href="<?php echo ROOT_URL; ?>shop?page=my-orders">Storico Ordini</a>
        </div>
      </div>
    <?php endif; ?>
    <?php if($loggedInUser && $loggedInUser->is_admin): ?>
        <div class="dropdown">
        <button class="btn btn-dropdown dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Area Amministratore
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <a class="dropdown-item" style="color: #C024FF !important;" href="<?php echo ROOT_URL; ?>admin">Dashboard</a>
          <a class="dropdown-item" style="color: #C024FF !important;" href="<?php echo ROOT_URL; ?>admin?page=users-list">Gestione Utenti</a>
          <a class="dropdown-item" style="color: #C024FF !important;" href="<?php echo ROOT_URL; ?>admin?page=products-list">Gestione Prodotti/Categorie</a>
        </div>
      </div>
    <?php endif; ?>
    <?php if(!$loggedInUser): ?>
        <div class="dropdown">
        <button class="btn btn-dropdown dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Area Riservata
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <a class="dropdown-item" style="color: #C024FF !important;" href="<?php echo ROOT_URL; ?>auth?page=login">Login / Registrazione</a>
        </div>
      </div>
    <?php endif; ?>

    </div>
  </div>
</nav>

