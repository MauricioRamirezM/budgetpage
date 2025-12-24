 <?php
if(isset($_GET['page'])){
    $page = $_GET['page'];
    
}else{
    $page = "home";
}

switch($page){
    case 'login':
        include 'app/pages/login.php';
        break;
    case 'register':
        include 'app/pages/register.php';
        break;
    case 'contact':
        include 'app/pages/contact.php';
        break;
    case 'home':
        include 'app/pages/home.php';
        break;
    case 'profile':
        include 'app/pages/profile.php';
        break;
    case 'logout':
        include 'app/pages/logout.php';
        break;
    default:
        include 'app/pages/login.php';
        break;
}
  
    
?>  
