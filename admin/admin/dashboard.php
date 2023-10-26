<div id="dashboard-space" class="row m-0 p-2 h-100 w-100" style="display:none;">
  <div id="dashboard-tab-container" class="container-fluid h-100 p-0 w-100">
    <ul class="nav nav-tabs nav-justified h-auto shadow-sm w-100 h-100 m-0 p-0" id="dashboard-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link fs-5 active" id="dash-tab-sales" data-bs-toggle="tab" href="#dash-tab-sales-container" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">Sales</a>
      </li>
    </ul>
    <div class="tab-content w-100 p-0 m-0" id="dashboard-tab-content">
      <div class="tab-pane container fade show active h-100 w-100 m-0 p-0 p-4" id="dash-tab-sales-container" role="tabpanel" aria-labelledby="ex3-tab-3">
        <div id="dashboard-tab-container" class="container-fluid h-100 w-100 p-0">
          <ul class="nav nav-tabs nav-justified h-auto shadow-sm w-100" id="dashboard-sales-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link fs-5 active" onclick="getTodaySales()" id="dash-tab-sales-ts" data-bs-toggle="tab" href="#dash-tab-sales-ts-container" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">Today's Sale</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link fs-5" onclick="getAllOrders()" id="dash-tab-sales-sh" data-bs-toggle="tab" href="#dash-tab-sales-sh-container" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">Sale History</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link fs-5" onclick="getSalesMeals()" id="dash-tab-sales-meals" data-bs-toggle="tab" href="#dash-tab-sales-meals-container" role="tab" aria-controls="ex3-tabs-2" aria-selected="false">Product Sales</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link fs-5" onclick="getSalesCustomers()" id="dash-tab-sales-customers" data-bs-toggle="tab" href="#dash-tab-sales-customers-container" role="tab" aria-controls="ex3-tabs-2" aria-selected="false">Customers</a>
            </li>
          </ul>
          <div class="tab-content w-100" id="dashboard-sales-tab-content">
            <div class="tab-pane container fade show active m-0 p-0 p-4 w-100" id="dash-tab-sales-ts-container" role="tabpanel" aria-labelledby="ts"></div>
            <div class="tab-pane container fade m-0 p-0 p-4 w-100" id="dash-tab-sales-sh-container" role="tabpanel" aria-labelledby="as"></div>
            <div class="tab-pane container fade p-0 p-4 w-100" id="dash-tab-sales-meals-container" role="tabpanel" aria-labelledby="sm"></div>
            <div class="tab-pane container fade p-0 p-4 w-100" id="dash-tab-sales-customers-container" role="tabpanel" aria-labelledby="cu"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>