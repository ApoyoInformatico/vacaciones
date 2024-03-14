<?php
    var_dump($_POST);
   if(isset($_POST['calendario'])) 
        header('Location: calendar.php');
    if(isset($_POST['sectores'])) 
        header('Location: sectores.php');
    if(isset($_POST['usuarios'])) 
        header('Location: usuarios.php');    
    if(isset($_POST['blog'])) 
        header('Location: blog.php');   
    if(isset($_POST['logout'])) 
        header('Location: logout.php');   
    if(isset($_POST['home'])) 
        header('Location: index.html'); 
    if(isset($_POST['help'])) 
        header('Location: help.html');   
    if(isset($_POST['editar'])) 
        header('Location: editar.php'); 
    if(isset($_POST['listarDias'])) 
        header('Location: reporte.php');
    
  

     ?>