<?php include 'includes/header.php'; ?>
<h2>SHOP FROM OUR COLLECTION</h2>

<div class="filters" style="margin-bottom: 30px; text-align: center;">
    <div style="display: inline-block; margin-right: 20px;">
        <label for="priceFilter" style="font-weight: bold;">Filter by Price:</label>
        <select id="priceFilter" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
            <option value="all">All Prices</option>
            <option value="100-199">$100 - $199</option>
            <option value="200-299">$200 - $299</option>
            <option value="300-399">$300 - $399</option>
            <option value="400-499">$400 - $499</option>
        </select>
    </div>
    <div style="display: inline-block;">
        <label for="categoryFilter" style="font-weight: bold;">Filter by Category:</label>
        <select id="categoryFilter" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
            <option value="all">All Categories</option>
            <option value="women">Women's Collection</option>
            <option value="men">Men's Collection</option>
            <option value="accessories">Special Collection</option>
        </select>
    </div>
</div>

<h6><CENTER>WOMEN'S COLLECTION</CENTER></h6>
<div class="products" data-category="women"> 
    <div class="product" data-price="120"> 
        <h3>BLACK PUFF SLEEVE MAXI DRESS</h3>
        <img src="images/dress1.jpeg" alt="Dress" width="100%">
        <p>A flowing maxi dress with elegant puff sleeves, perfect for any occasion.</p> 
        <p>$120</p>
        <button onclick="addToCart('BLACK PUFF SLEEVE MAXI DRESS', 120)">Add to Cart</button>
    </div>
    <div class="product" data-price="150">
        <h3>CHOCOLATE LINEN OVERSIZED SHIRT</h3>
        <img src="images/shirt.jpeg" alt="shirt" width="100%">
        <p>Comfortable and stylish oversized linen shirt in a rich chocolate hue.</p> 
        <p>$150</p>
        <button onclick="addToCart('CHOCOLATE LINEN OVERSIZED SHIRT', 150)">Add to Cart</button>
    </div>
    <div class="product" data-price="200">
        <h3>BLUSH CREWNECK CARDIGAN</h3>
        <img src="images/cardigan.jpeg" alt="cardigan" width="100%">
        <p>Soft and cozy crewneck cardigan in a delicate blush color, ideal for layering.</p> 
        <p>$200</p>
        <button onclick="addToCart('BLUSH CREWNECK CARDIGAN', 200)">Add to Cart</button>
    </div>
    <div class="product" data-price="380">
        <h3>LIGHTWEIGHT QUILTED VEST</h3>
        <img src="images/vest.jpeg" alt="vest" width="100%">
        <p>A versatile lightweight quilted vest for added warmth and style.</p> 
        <p>$380</p>
        <button onclick="addToCart('LIGHTWEIGHT QUILTED VEST', 380)">Add to Cart</button>
    </div>
</div>
<h6><CENTER>MEN'S COLLECTION</CENTER></h6>
<div class="products" data-category="men"> 
    <div class="product" data-price="270">
        <h3>CROCHET KNITTED ZIPPER POLO</h3>
        <img src="images/polo.jpeg" alt="polo" width="100%">
        <p>Stylish crochet knitted polo with a convenient zipper closure.</p>
        <p>$270</p>
        <button onclick="addToCart('CROCHET KNITTED ZIPPER POLO', 270)">Add to Cart</button>
    </div>
    <div class="product" data-price="380">
        <h3>ANIMAL MONTAGE ORANGE SHIRT</h3>
        <img src="images/montage.jpeg" alt="montage" width="100%">
        <p>Vibrant orange shirt featuring a unique animal montage print.</p> 
        <p>$380</p>
        <button onclick="addToCart('ANIMAL MONTAGE ORANGE SHIRT', 380)">Add to Cart</button>
    </div>
    <div class="product" data-price="400">
        <h3>LINEN LONG SLEEVE SHIRT</h3>
        <img src="images/linen.jpeg" alt="linen" width="100%">
        <p>Breathable linen long sleeve shirt, perfect for casual elegance.</p> 
        <p>$400</p>
        <button onclick="addToCart('LINEN LONG SLEEVE SHIRT', 400)">Add to Cart</button>
    </div>
    <div class="product" data-price="300">
        <h3>SATIN LYCRA LIGHT PURPLE SHIRT</h3>
        <img src="images/fabric.jpeg" alt="fabric" width="100%">
        <p>Luxurious satin lycra shirt in a subtle light purple shade.</p> 
        <p>$300</p>
        <button onclick="addToCart('SATIN LYCRA LIGHT PURPLE SHIRT', 300)">Add to Cart</button>
    </div>
</div>
<h6><CENTER>SPECIAL COLLECTION</CENTER></h6>
<div class="products" data-category="accessories"> 
    <div class="product" data-price="200">
        <h3>DOUBLE STRAP SLIDE</h3>
        <img src="images/slide.jpeg" alt="slide" width="100%">
        <p>Comfortable double strap slides for relaxed everyday wear.</p> 
        <p>$200</p>
        <button onclick="addToCart('DOUBLE STRAP SLIDE', 200)">Add to Cart</button>
    </div>
    <div class="product" data-price="200">
        <h3>PEBBLE SLOUCH TOTE</h3>
        <img src="images/tote.jpeg" alt="tote" width="100%">
        <p>A stylish and spacious pebble slouch tote, perfect for your essentials.</p> 
        <p>$200</p>
        <button onclick="addToCart('PEBBLE SLOUCH TOTE', 200)">Add to Cart</button>
    </div>
    <div class="product" data-price="180">
        <h3>PRINTED SUNGLASSES</h3>
        <img src="images/sunglass.jpeg" alt="sunglass" width="100%">
        <p>Trendy sunglasses with a unique printed frame for a fashionable look.</p> 
        <p>$180</p>
        <button onclick="addToCart('PRINTED SUNGLASSES', 180)">Add to Cart</button>
    </div>
    <div class="product" data-price="350">
        <h3>CORAL WOOL SCARF</h3>
        <img src="images/scarf.jpeg" alt="scarf" width="100%">
        <p>A soft and warm coral wool scarf, perfect for adding a pop of color.</p> 
        <p>$350</p>
        <button onclick="addToCart('CORAL WOOL SCARF', 350)">Add to Cart</button>
    </div>
</div>
<script src="js/script.js"></script>
<?php include 'includes/footer.php'; ?>
