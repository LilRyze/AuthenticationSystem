<?php
require "db.php";

    $data = $_POST;
    $errors = array();
    $salt = '2356kl3rp3';
    if(isset($data['do_signup'])) {
        if(trim($data['login']) === '') {
            $errors[] = 'Type Login';
        }
        if(trim($data['email']) === '') {
            $errors[] = 'Type email';
        }
        if($data['password'] === '') {
            $errors[] = 'Type password';
        }
        if($data['password_2'] !== $data['password']) {
            $errors[] = 'Second password is wrong';
        }
        if(R::count('users', "login = ?", array($data['login'])) > 0) {
            $errors[] = 'Login already used';
        }
        if(R::count('users', "email = ?", array($data['email'])) > 0) {
            $errors[] = 'E-mail already used';
        }
        if(empty($errors)) {
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->password = md5($data['password'].$salt);
            R::store($user);
            echo '<div style="color:lawngreen;">'.'Registration Complete'.'</div><hr>';

        } else {
            echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
        }
    }
?>

<form action="/signup.php" method="POST">

    <p>
    <p><strong>Your Login</strong></p>
        <input type="text" name="login" placeholder="Login..." value="<?php echo @$data['login']; ?>">
    </p>
    <p>
    <p><strong>Your Email</strong></p>
    <input type="email" name="email" placeholder="E-mail..." value="<?php echo @$data['email']; ?>">
    </p>
    <p>
    <p><strong>Your Password</strong></p>
    <input type="password" name="password" placeholder="Password..." value="<?php echo @$data['password']; ?>">
    </p>
    <p>
    <p><strong>Tape password again</strong></p>
    <input type="password" name="password_2" placeholder="Password..." value="<?php echo @$data['password_2']; ?>">
    </p>
    <p>
        <button type="submit" name="do_signup">
            Sign Up
        </button>
    </p>
    </p>
</form>