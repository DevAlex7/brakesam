<?php
  session_start();    

  Route::set('login', function(){
      if(isset($_SESSION['idUsername'])){
        header('Location: home');
      }
      else{
        include 'View/login.php';
      }
  });

  Route::set('signup', function(){
      include 'View/signup.php';
  });

  Route::set('products', function(){
      if($_SESSION['idUsername']){
        include 'View/products.php';
      }
      else{
        header('Location: login');
      }
  });

  Route::set('viewproducts',function(){
      if($_SESSION['idUsername']){
          include 'View/view_products.php';
      }
      else{
        header('Location: login');
      }
  });

  Route::set('home', function(){
      if($_SESSION['idUsername']){
          include 'View/home.php';
      }
      else{
        header('Location: login');
      }
  });

  Route::set('categories', function(){
      if($_SESSION['idUsername']){
        include 'View/categories.php';
      }
      else{
        header('Location: login');
      }
  });

  Route::set('suppliers', function(){
    include 'View/suppliers.php';
  });

  Route::set('subcategories', function(){
    include 'View/view_subcategories.php';
  });

  Route::set('warehouses', function(){
    include 'View/warehouses.php';
  });

  Route::set('viewproduct',function(){
    include('View/view_product.php');
  });

?>
