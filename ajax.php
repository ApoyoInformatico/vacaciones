<?PHP

if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'logout':
                logout();
                break;
            case 'select':
                select();
                break;
        }
    }


    function select() {
        echo "The select function is called.";
        exit;
    }
    
    function logout(){
        // remove all session variables
        session_unset();
        // destroy the session
        session_destroy();
        $contador=0;
        header("Location: logout.php");
        }
        
    

        ?>  