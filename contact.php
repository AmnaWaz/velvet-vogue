<?php include 'includes/header.php'; ?>
<h2>Contact Us</h2>

<div class="contact-form-wrapper" style="max-width: 600px; margin: 30px auto; padding: 20px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px; background-color: #fff;">
    <p style="text-align: center; margin-bottom: 20px;">Have a question or feedback? Send us a message!</p>
    <form id="contactForm" style="display: flex; flex-direction: column; gap: 15px;">
        <label for="contactName" style="font-weight: bold;">Name:</label>
        <input type="text" id="contactName" name="name" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="contactEmail" style="font-weight: bold;">Email:</label>
        <input type="email" id="contactEmail" name="email" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

        <label for="contactMessage" style="font-weight: bold;">Message:</label>
        <textarea id="contactMessage" name="message" rows="6" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; resize: vertical;"></textarea>

        <button type="submit" id="submitContact" style="padding: 12px 20px; background-color: #000; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 1em;">Send Message</button>
    </form>
    <p id="contactMessageStatus" style="text-align: center; margin-top: 20px; font-weight: bold;"></p>
</div>

<script src="js/script.js"></script>
<?php include 'includes/footer.php'; ?>
