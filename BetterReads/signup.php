<?php
include(./include_once 'header.php');
?>

<section class = "signup-from">
    <h2>Sign Up</h2>
    <form action="signup.inc.php" method="post">
        <input types="text" name="name" placeholder="Full Name...">
        <input types="text" name="email" placeholder="Email...">
        <input types="text" name="uid" placeholder="Username..">
        <input types="password" name="pwd" placeholder="Password...">
        <input types="password" name="pwdrepeat" placeholder="Retype Ppassword...">
        <button types="submit" name="submit>Sign up</button>
</form>
</secion>


<?php
include_once 'footer.php';
?>