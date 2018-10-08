<?php
require "db.php";
?>

<?php if (isset($_SESSION['logged_user'])) : ?>
Logged in <?php echo $_SESSION['logged_user']->login; ?>
<hr>
<a href="/logout.php">Logout</a>
<?php else :?>
    <a href="/login.php">Sign In</a><br>
    <a href="/signup.php">Sign Up</a>
<?php endif; ?>