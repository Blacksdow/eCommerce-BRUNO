<?php

$errMsg = '';

if($loggedInUser) {
    echo '<script>location.href="'. ROOT_URL .'public"</script>';
    exit;
}



if(isset($_POST['register'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    
    $userMgr = new UserManager();
    if($userMgr->passwordsMatch($password,$confirm_password)){

        $result = $userMgr->register($email, $password);

        if($result) {
                echo '<script>location.href="'. ROOT_URL .'auth?page=login"</script>';
                exit;
            } else {
                $errMsg = 'Mail già presente nel sistema...';
            } 

    } else {
        $errMsg = 'le password non corrispondono';
    }
    

}
?>

<h2>Registrazione</h2>
<form method="POST">
    <div class="form-group">
        <label for="email">Email</label>
        <input name="email" id="email" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input name="password" id="password" type="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Conferma Password</label>
        <input name="confirm_password" id="confirm_password" type="password" class="form-control">
    </div>

    <div class="text-danger">
        <?php echo $errMsg ?>
    </div>
    <button type="submit" class="btn btn-primary mt-3" name="register">Register</button>
    
</form>

Hai già un account? <a href="<?php echo ROOT_URL ?>auth?page=login">Effettua il login &raquo;</a>
