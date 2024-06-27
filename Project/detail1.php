<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finalwebdb";

// B1: Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("connection failed: " . mysqli_connect_error());
}

$masp = isset($_GET['masp']) ? $_GET['masp'] : '';
$sql = "SELECT * FROM sanpham WHERE masp='$masp'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>

<div class="detail">
    <div class="grid wide">
        <div class="row">
            <div class="col l-6">
                <div class="detail-items">
                    <div class="product-img owl-carousel">
                        <img src="./upload/<?php echo $row["img"] ?>" alt="" class="detail-items__img" data-hash="1">
                        <img src="https://res.cloudinary.com/dlpm1u3li/image/upload/v1719498331/quanlysach/aohoodiecinder_b89sen.webp" alt="" class="detail-items__img"
                            data-hash="2">
                        <img src="https://res.cloudinary.com/dlpm1u3li/image/upload/v1719498348/quanlysach/aosweaterbaguette_ql7y0w.webp" alt="" class="detail-items__img" data-hash="3">
                        <img src="https://res.cloudinary.com/dlpm1u3li/image/upload/v1719498333/quanlysach/aohoodie_zrxcjw.jpg" alt="" class="detail-items__img" data-hash="4">
                        <img src="https://res.cloudinary.com/dlpm1u3li/image/upload/v1719498525/quanlysach/bodongunam_gopsnx.webp" alt="" class="detail-items__img" data-hash="5">
                    </div>
                </div>
                <script>
                jQuery(document).ready(function() {
                    const owl = $(".product-img")
                    owl.owlCarousel({
                        items: 1,
                        nav: true
                    });
                    
                })
                </script>
            </div>
            <div class="col l-6">
                <div class="detail-items">
                    <h3 class="detail-items__heading"><?php echo $row["tensp"] ?></h3>
                    <p class="detail-items__code">Mã sp: <?php echo $row["masp"] ?></p>
                    <div class="detail-items__price">
                        <span class="detail-items__price-new"><?php echo $row["dongia"] ?>₫</span>
                        <span class="detail-items__price-old"><?php echo $row["dongiaold"] ?>₫</span>
                        <span class="detail-items__price-sale">Sale</span>
                    </div>
                    <div class="detail-items__support">
                        <div class="detail-items__support-gr">
                            <img src="assets/img/img_sup5.jpg" alt="" class="detail-items__support-gr-img">
                            <div class="detail-items__support-gr-info">
                                <h3 class="detail-items__support-gr-title">Free shipping</h3>
                                <p class="detail-items__support-gr-msg">For orders from 499,000₫</p>
                            </div>
                        </div>
                        <div class="detail-items__support-gr">
                            <img src="assets/img/img_sup6.jpg" alt="" class="detail-items__support-gr-img">
                            <div class="detail-items__support-gr-info">
                                <h3 class="detail-items__support-gr-title">Free exchange and repair</h3>
                                <p class="detail-items__support-gr-msg">Exchange within 30 days from the date of
                                    purchase, support free modifications</p>
                            </div>
                        </div>
                    </div>
                    <div class="detail-items__warehouse">
                        <p class="detail-items__warehouse-remaining"><strong>There is</strong>:
                            <?php echo $row["soluong"] ?> unit</p>
                    </div>
                    <form action="cart.php" method="post" class="detail-items__quantity">
                        <div class="detail-items__quantity-group">
                            <p class="detail-items__quantity-text">Quantity:</p>
                            <input class="detail-items__quantity-num" type="number" name="soluong" min="1" max="10"
                                value="1">
                        </div>
                        <input type="hidden" name="masp" value="<?php echo $row["masp"] ?>">
                        <input type="hidden" name="tensp" value="<?php echo $row["tensp"] ?>">
                        <input type="hidden" name="dongia" value="<?php echo $row["dongia"] ?>₫">
                        <input type="hidden" name="img" value="<?php echo $row["img"] ?>">
                        <input type="submit" value="Add to cart" name="addcart" class="detail-items__btn-cart">
                    </form>
                    <form action="cart.php" method="post" class="detail-items__btn">
                        <input type="hidden" name="soluong" value="1">
                        <input type="hidden" name="masp" value="<?php echo $row["masp"] ?>">
                        <input type="hidden" name="tensp" value="<?php echo $row["tensp"] ?>">
                        <input type="hidden" name="dongia" value="<?php echo $row["dongia"] ?>₫">
                        <input type="hidden" name="img" value="<?php echo $row["img"] ?>">
                        <input type="submit" value="Buy now" name="addcart" class="detail-items__btn-buy">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.detail-items__quantity-group {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.detail-items__quantity-text {
    margin-right: 10px;
}

.detail-items__btn-cart {
    margin-top: 10px;
}
</style>

<?php
if (isset($_SESSION['success'])) {
    echo '<script>alert("' . $_SESSION['success'] . '");</script>';
    unset($_SESSION['success']);
}
?>