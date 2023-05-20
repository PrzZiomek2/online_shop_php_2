<?php

include('includes/functions.php');
include('includes/config.php');

if(!isset($_SESSION["cart"])){
  $_SESSION["cart"] = array();
};

$totalCount = array_reduce( $_SESSION["cart"], function ($sum, $entry) {
  $sum += $entry["item_quantity"]; 
  return $sum;
}, 0);

$cartCountNumb = $totalCount ? "(" . $totalCount .")" : "";

 ?> 

<!DOCTYPE html>
<html>

<head>
	<title>Online Shop</title>
	<meta charset="utf-8"  />
   <meta http-equiv="X-UA-Compatibile" content="IE=edge">
   <meta name="viewport"content="width=device-width, initial-scale=1.0">

   <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />

    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="css/customs/main.css" />
    <link rel="stylesheet" href="css/customs/pages/products.css" />

    <style>

        #navbarNav{
          justify-content: flex-end;
        }

        .product{
          border: 1px solid #eaeaec;
          margin: 20px;  
          padding: 10px;
          text-align: center;
          background-color: #b7b5b5;
          border-radius: 10px;
        }

        .product img{
          vertical-align: middle;
            width: 100px;
            height: 200px;
            object-fit: contain;
        }

        .product h5{
            color: white;
            font-size: 1.45rem;
        }

        table, th, tr{
          text-align: center;
        }

        .title2{
          text-align: center;
          color: #66afe9;
          background-color: #efefef;
          padding: 2%;
        }

        h2{
          text-align: center;
          color: #89939b;
          background-color: #efefef;
          padding: 1rem;
        }

        table th{
          background-color: #efefef;
        }

      .shopContent{
          display: flex;
          flex-wrap: wrap;
      }
    </style>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sklep Online</a>
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/project_2/">Główna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="cart.php"><?php echo "Koszyk" . $cartCountNumb; ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Panel</a>
        </li>
        <li class="nav-item">
          <?php 
            if(!isset($_SESSION['id'])){  
          ?>  
            <a class="nav-link" href="login.php">Zaloguj</a>
          <?php
            }else{
         ?>
            <a class="nav-link" href="logout.php">Wyloguj</a>
          <?php
            }
          ?>
          
        </li>
      </ul>
    </div>
  </div>
</nav>

<body>

<?php

getMessage();

 ?>