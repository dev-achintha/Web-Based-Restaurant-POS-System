<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $userIdOfCurrentSession = $_SESSION['user_id'];
} else {
  header('Location: ../../index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WEB-POS</title>
  <link rel="stylesheet" href="../../assets/css/bootstrap/bootstrap.css" />
  <link rel="stylesheet" href="../../assets/css/preloader.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="../../assets/css/pos.css" />
  <link rel="stylesheet" href="../../assets/css/cashier.css" />
  <link rel="stylesheet" href="../../assets/css/customer.css" />
  <link rel="stylesheet" href="../../assets/css/user.css" />
  <link rel="stylesheet" href="../../assets/css/payment.css">
</head>

<body class="position-relative">
  <div id="preloader" class="m-0 p-0 position-absolute">
    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
      <div class="infinityChrome">
        <div></div>
        <div></div>
        <div></div>
      </div>
      <div class="infinity">
        <div>
          <span></span>
        </div>
        <div>
          <span></span>
        </div>
        <div>
          <span></span>
        </div>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="display: none">
        <defs>
          <filter id="goo">
            <feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur" />
            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
            <feBlend in="SourceGraphic" in2="goo" />
          </filter>
        </defs>
      </svg>
      <!-- dribbble -->
      <a class="dribbble" href="https://dribbble.com/shots/5557955-Infinity-Loader" target="_blank">
        <!-- <img src="https://cdn.dribbble.com/assets/dribbble-ball-mark-2bd45f09c2fb58dbbfb44766d5d1d07c5a12972d602ef8b32204d28fa3dda554.svg" alt="" /> -->
      </a>
    </div>
  </div>
  <div id="main-frame" class="main-frame container-fluid">
    <div id="top-bar" class="top-bar container-fluid p-md-3">
      <div class="row justify-content-between">
        <div class="col justify-content-md-start">
          <div class="row justify-content-md-end">
            <div class="col-lg">
              <h4><?php $fileContents = file_get_contents("../../company_details.txt"); echo $fileContents?></h4>
              <small class="text-muted">Powered by WEB-POS</small>
            </div>
            <div class="col-lg-9">
              <div class="input-group input-group-lg">
                <input type="text" class="form-control" placeholder="Search..........." aria-label="" aria-describedby="search-field" />
                <span class="input-group-text" id="">
                  <i class="material-icons">search</i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col position relative">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div class="">
              <button id="requestFullscreen-btn" class="btn btn-lg">
                <i class="material-icons" id="screenIcon">fullscreen</i>
              </button>
            </div>
            <div class="">
              <button id="sync-btn" class="btn btn-lg">
                <i class="material-icons">sync</i>
              </button>
            </div>
            <div class="">
              <button id="wifi-btn" class="btn btn-lg disabled">
                <i class="material-icons">wifi</i>
              </button>
            </div>
            <div class="">
              <button id="slct-tbl-btn" class="btn btn-lg btn-sae btn-sae">
                <i class="material-icons">account_tree</i> Select Tables
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="main-container" class="row p-0 m-0">
      <div id="navigation" class="col m-4 mb-3 mt-3 p-0 w-100">
        <div class="row mb-2">
          <button id="cashier-btn" type="button" class="btn btn-sae btn-dis nav-btn active-nav-btn cashier-btn-click">
            <i class="material-icons btn-disabled cashier-btn-click ">point_of_sale</i>
            <br />
            <small class="btn-disabled cashier-btn-click ">Cashier</small>
          </button>
        </div>
        <div class="row mb-2">
          <button id="customer-btn" type="button" class="btn btn-sae btn-dis nav-btn customer-btn-click">
            <i class="material-icons btn-disabled customer-btn-click ">sensor_occupied</i>
            <br />
            <small class="btn-disabled customer-btn-click ">Customer</small>
          </button>
        </div>
        <div class="row mb-2">
          <button id="user-btn" type="button" class="btn btn-sae btn-dis nav-btn user-btn-click">
            <i class="material-icons btn-disabled user-btn-click ">manage_accounts</i>
            <br />
            <small class="btn-disabled user-btn-click ">User</small>
          </button>
        </div>
        <div class="row mb-2">
          <button id="logout-btn" type="button" class="btn btn-sae btn-dis nav-btn logout-btn-click">
            <i class="material-icons btn-disabled logout-btn-click ">logout</i>
            <br />
            <small class="btn-disabled logout-btn-click ">Logout</small>
          </button>
        </div>

      </div>
      <div id="sub-container" class="col m-0 p-0 border-0 w-100 h-100 d-flex">
        <?php
        include('cashier.php');
        ?>
        <div id="food-item-modal" class="fd-item-modal">
          <div class="fd-item-modal-content">
            <div class="container fd-item-modal-body m-0 p-4 w-100 h-100">
              <span class="close"></span>
              <div class="row p-0 m-0 h-100 w-100">
                <div class="col-4 d-flex p-0 pe-4 m-0 align-content-center justify-content-center">
                  <div id="bg-food-item-modal-image" class="ratio ratio-1x1">
                    <div id="bg-cover-food-item-modal-image" class="w-100 h-100 overflow-hidden d-flex align-items-center justify-content-center">
                      <img id="food-item-modal-image" src="../../assets/images/placeholder.jpg" class="img-fluid mx-auto d-block w-100" alt="...">
                    </div>
                  </div>
                </div>
                <div class="col-8 m-0 p-0">
                  <h4 id="modal-meal-name" class="fw-bold"></h4>
                  <div class="row h-25 m-0 mb-5 p-0">
                    <div class="col">
                      <fieldset class="d-flex flex-column align-items-center justify-content-center p-1 m-0 h-100">
                        <legend class="float-none w-auto p-2 m-0 p-0">Portion:</legend>
                        <div class="container d-flex justify-content-center align-items-center text-center m-0 p-0">
                          <div id="" class="container-fluid p-0 position-relative m-0 category-scroll-cover">
                            <div id="" class="shadow-l w-10 h-75 top-50 start-0 translate-middle-y"></div>
                            <div id="" class="shadow-r w-10 h-75 top-50 end-0 translate-middle-y"></div>
                            <div class="p1 container-fluid p-0 m-0 position-relative">
                              <div class="p2 row d-flex flex-nowrap w-100 h-100" id="">
                                <!-- <a href="#" class="btn fs-5 fw-bold m-2 w-50">Full</a> -->
                                <small class="bd-highlight">Not applicable to this food</small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                  <div class="row h-25 m-0 p-0">
                    <div class="col-8">
                      <fieldset class="d-flex flex-column align-items-center justify-content-center p-1 m-0 h-100">
                        <legend class="float-none w-auto p-2">Quantity:</legend>
                        <div class="container d-flex justify-content-center align-items-center text-center">
                          <span class="stepper row w-100">
                            <div class="col">
                              <a class="spinnerbtn-n btn btn-lg btn-sae fs-1 w-100 h-100 fw-bolder">–</a>
                            </div>
                            <div class="col">
                              <input class="form-control-lg fs-2 w-100 h-100 fw-bolder text-center border-1" type="number" id="stepper" value="1" min="1" max="100" step="1" readonly>
                            </div>
                            <div class="col">
                              <a class="spinnerbtn-p btn btn-lg btn-green fs-1 w-100 h-100 fw-bolder">+</a>
                            </div>
                          </span>
                        </div>
                      </fieldset>
                    </div>
                    <div class="col-4">
                      <fieldset class="d-flex flex-column align-items-center justify-content-center p-1 m-0 h-100">
                        <legend class="float-none w-auto p-2">Add to cart</legend>
                        <a id="add-item-cart" href="#" class="btn btn-lg btn-primary w-100 h-100">
                          <i class="material-icons fs-1"></i>
                        </a>
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="pay-proceed-modal" tabindex="-1" role="dialog" aria-labelledby="payProceedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div id="pay-modal-body" class="modal-content">
      </div>
    </div>
  </div>
  <div class="modal fade" id="warning-modal" tabindex="-1" aria-labelledby="warning-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title fs-2" id="warning-modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body  fs-3 fw-bold" id="warning-modal-body">
        </div>
        <div class="modal-footer d-flex flex-none">
          <a class="btn btn-lg btn-danger justify-content-start" id="warning-modal-ok">  Yes </a>
          <a class="btn btn-lg btn-success flex-end justify-content-end" data-bs-dismiss="modal" id="warning-modal-cancel">Cancel</a>
        </div>
      </div>
    </div>
  </div>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="../../assets/js/bootstrap/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="assets/js/pos.js"></script>
  <script src="assets/js/cashier.js"></script>
  <script src="assets/js/ajax.js"></script>
  <script src="assets/js/customer.js"></script>
  <script src="assets/js/user.js"></script>
  <script src="assets/js/display.js"></script>
  <script>
    window.addEventListener("resize", function() {
      sizeFix();
    });
    window.addEventListener("load", function() {
      sizeFix();
    });

    function sizeFix() {
      const mainContainerHeight =
        document.getElementById("main-frame").offsetHeight -
        document.querySelector(".top-bar").offsetHeight;
      document.getElementById("main-container").style.height =
        mainContainerHeight + "px";
      document.getElementById("sub-container").style.height =
        mainContainerHeight + "px";
      if (document.getElementById("update-space")) {
        var updateTabContent = document.getElementById("update-tab-content");
        var updateTabContainer = document.getElementById(
          "update-tab-container"
        );
        var updateTab = document.getElementById("update-tab");
        var updateSpace = document.getElementById("update-space");
        var totalHeight =
          updateTabContainer.offsetHeight -
          updateTab.offsetHeight -
          parseFloat(window.getComputedStyle(updateSpace).padding);
        updateTabContent.style.height = totalHeight + "px";
      }
      if (document.getElementById("dashboard-space")) {
        var dashboardTabContent = document.getElementById(
          "dashboard-tab-content"
        );
        var dashboardTabContainer = document.getElementById(
          "dashboard-tab-container"
        );
        var dashboardTab = document.getElementById("dashboard-tab");
        var dashboardSpace = document.getElementById("dashboard-space");
        var totalHeight =
          dashboardTabContainer.offsetHeight -
          dashboardTab.offsetHeight -
          parseFloat(window.getComputedStyle(dashboardSpace).padding);
        dashboardTabContent.style.height = totalHeight + "px";
      }
      if (document.getElementById("cashier-space")) {
        document.getElementById("container-tbl-payboard").style.height =
          document.getElementById("payboard").style.height;
        document.getElementById("category-3").classList.add("active");
        getMealItems('Chicken');
        loadCart();
      }
    }
    window.onbeforeunload = function() {
      return "Are you sure you want to leave this page?";
    };
  </script>
  <script src="assets/js/preloader.js"></script>
</body>

</html>