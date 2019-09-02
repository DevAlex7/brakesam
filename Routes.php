<?php
  session_start();    

  Route::set('login', function(){
    include 'View/login.php';
  });

  Route::set('signup', function(){
    include 'View/signup.php';
  });
  Route::set('productos', function(){
    if($_SESSION['id']){
      print 'categorias';
    }
    else{
      header('Location: login');
    }
  });
  Route::set('home', function(){
    if($_SESSION['id']){
      print 'categorias';
    }
    else{
      header('Location: login');
    }
  });
  Route::set('usersitemr', function(){
      var_dump($_GET['item']);
  });
?>
