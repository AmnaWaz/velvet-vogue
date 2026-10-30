<?php include 'includes/header.php'; ?>
<h2>Your Shopping Cart</h2>

<?php if (isset($_SESSION['username'])): ?>
    <div style="text-align: center; margin-bottom: 20px;">
        <h3>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h3>
        <p>Your unique cart ID: <span id="userCartId"><?php echo htmlspecialchars($_SESSION['username']); ?></span></p>
    </div>
    <div id="cart">
         <p style="text-align: center;">Loading cart items...</p>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <button id="checkoutButton" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">Checkout</button>
    </div>
    <div id="checkoutMessage" style="text-align: center; margin-top: 20px; font-weight: bold; color: green;">
    </div>

<?php else: ?>
    <p style="text-align: center;">Please <a href="login.php">log in</a> to view your cart items.</p>
<?php endif; ?>

<script src="js/script.js"></script>
<?php include 'includes/footer.php'; ?>
