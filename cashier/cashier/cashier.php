<?php $dbPath = "../../restaurant_business.db";
require_once "../../db_connection.php"; ?>
<div class="row w-100 h-100 m-0 p-0">
    <div id="comp-area" class="col p-0 m-0 w-100 h-100">
        <?php
        include('cashier_space.php');
        ?>
    </div>
        <?php
        include('payboard.php');
        ?>
    <!-- <div id="pay-section" class="m-0 m-0">
    </div> -->
</div>