<?php
$plain_password = 'uzumaki';  // Your plaintext password
$hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);
echo $hashed_password;  // This will print the hashed password
?>
