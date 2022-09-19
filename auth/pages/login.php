<?php

$errMsg = '';

if($loggedInUser) {
    echo '<script>location.href="'. ROOT_URL .'public"</script>';
    exit;
}



if(isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $userMgr = new UserManager();
    $result = $userMgr->Login($email, $password);

    if($result) {
        echo '<script>location.href="'. ROOT_URL .'public"</script>';
    exit;
    } else {
        $errMsg = 'Login fallito...';
    }

}
?>


<h2>Login</h2>
<form method="POST">
    <div class="from-group">
        <label for="email">Email</label>
        <input name="email" id="email" type="text" class="form-control">
    </div>
    <div class="from-group">
        <label for="password">Password</label>
        <input name="password" id="password" type="password" class="form-control">
    </div>

    <div class="text-danger">
        <?php echo $errMsg ?>
    </div>
    <button type="submit" class="btn btn-primary mt-3" name="login">Login</button>
    
</form>

Non hai un account? <a href="<?php echo ROOT_URL ?>auth?page=register">Registrati &raquo;</a>
