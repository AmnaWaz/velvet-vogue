<?php include 'includes/header.php'; ?>
<h2> LOGIN </h2>
<center><form id="authForm" action="login.php" method="post">
    <label>Username:</label><br>
    <input type="text" name="username" id="authUsername"><br><br>
    <label>Password:</label><br>
    <input type="password" name="password" id="authPassword"><br><br>
    <button type="button" id="loginButton">Login</button>
</form></center>
<p id="authMessage" style="text-align: center; margin-top: 20px; color: red;"></p>
<p style="text-align: center; margin-top: 20px;">New to the page?<button type="button" id="registerButton">Register</button></p>
<?php include 'includes/footer.php'; ?>
<script src="js/script.js"></script>
