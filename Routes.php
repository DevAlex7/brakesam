<?php
  session_start();    

  Route::set('login', function(){
      include 'View/login.php';
  });

  Route::set('signup', function(){
      include 'View/signup.php';
  });
  Route::set('products', function(){
      if($_SESSION['idUsername']){
        print 'categorias';
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
  });
?>
