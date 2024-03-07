<?PHP
session_start();
function logout(){
// remove all session variables
session_unset();
// destroy the session
session_destroy();
$contador=0;
header("Location: index.html");
}


logout();
?>