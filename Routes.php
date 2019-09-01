<?php
  session_start();  
  Route::set('index.php', function(){
    //Index::CreateView("Index");
  });

  Route::set('login', function(){
    include 'View/login.php';
  });

  Route::set('register', function(){
    //ContactUs::CreateView("ContactUs");
  });
  Route::set('productos', function(){
    print 'estás en productos';
  });
  Route::set('categories', function(){
    if($_SESSION['id']){
      print 'categorias';
    }
    else{
      header('Location: login');
    }

    //print $_GET['1'];
    ContactUs::CreateView("ContactUs");
  });
  Route::set('', function(){
  
    //ContactUs::CreateView("ContactUs");
  });
?>
