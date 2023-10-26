<div id="cashier-space" class="row m-0 p-0 h-100 w-100">
    <div id="food-category" class="container p-4 m-0 h-100 w-100">
        <div id="category-scroll-cover" class="category-scroll-cover container-fluid rounded p-0 position-relative mb-4 shadow-sm w-100">
            <div id="" class="shadow-l w-10 h-100 top-50 start-0 translate-middle-y"></div>
            <div id="" class="shadow-r w-10 h-100 top-50 end-0 translate-middle-y"></div>
            <div class="p1 container-fluid rounded p-0 position-relative w-100">
                <div class="p2 row d-flex flex-nowrap w-100 h-100" id="p2">
                    <?php
                    $dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php";

                    $stmt = $db->query('SELECT * FROM categories LIMIT 8');
                    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($categories as $category) {
                        $idCategory = $category['id'];
                        $strCategory = $category['category_name'];
                        $html = "<a id=\"category-$idCategory\" href=\"#\" class=\"cat-btn btn fs-5 fw-bold m-4 w-25\">$strCategory</a>";
                        echo $html;
                    }
                    ?>

                </div>
            </div>
        </div>
        <div id="item-gallery" class="container-fluid p-0 m-0 h-100">
        </div>
    </div>
</div>

<script>
    var categoryCoverHeight = document.getElementById('category-scroll-cover').offsetHeight;
    var newMaxHeight = 'calc(100% - ' + categoryCoverHeight + 'px)';
    document.getElementById('item-gallery').style.maxHeight = newMaxHeight;
</script>