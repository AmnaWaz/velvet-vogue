<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Velvet Vogue</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <img src="images/logo.png" alt="logo" style="width:10%;">
    <nav>
        <a href="index.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="cart.php">Cart</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>
<div class="container">
