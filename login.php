<?php
    require "db.php";
    $errors = [];
    $data = $_POST;
    $salt = '2356kl3rp3';
    if(isset($data['do_login'])){

        $user = R::findOne('users', 'login = ?', array($data['login']));
        if($user){
            if(md5($data['password'].$salt) === $user['password']){
                $_SESSION['logged_user'] = $user;
                echo '<div style="color:lawngreen;">'.'You are logged in and can go <a href="/">Homepage</a>'.'</div><hr>';
            } else {
                $errors[] = 'Wrong password';
            }
        } else {
            $errors[] = 'No users with this login';
        }
        if(!empty($errors)) {
            echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
        }

    }
?>

<form action="/login.php" method="POST">
    <p>
    <p><strong>Your Login</strong></p>
    <input type="text" name="login" placeholder="Login..." value="<?php echo @$data['login']; ?>">
    </p>
    <p><strong>Your Password</strong></p>
    <input type="password" name="password" placeholder="Password..." value="<?php echo @$data['password']; ?>">
    </p>
    <p>
        <button type="submit" name="do_login">
            Sign Up
        </button>
    </p>
    </p>


</form>
