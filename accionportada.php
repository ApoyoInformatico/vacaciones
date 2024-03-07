<?php

   if(isset($_POST['login'])) 
        header('Location: login.php');
    if(isset($_POST['registro'])) 
        header('Location: registroform.php');
    if(isset($_POST['help'])) 
        header('Location: ayuda.html');
    if(isset($_POST['home'])) 
        header('Location: index.html');
    if(isset($_POST['restart'])) 
        header('Location: login.php');







     ?>