<div id="payboard" class="col-4 pe-0 h-100 container-fluid position-relative shadow-sm">
        <div id="container-tbl-payboard" class="h-100 w-auto">
            <table id="tbl-payboard" class="table table-borderless w-100 h-100">
                <thead>
                    <tr>
                        <td>
                            <div id="addcustomer-payboard" class="container-fluid pt-2 pb-2 h-100">
                                <div class="row">
                                    <div id="selected-customer-btn" class="col-6 payboard">
                                        <button id="addcustomer-btn-payboard" class="btn btn-light btn-lg btn-sae btn-dis btn-dis-act addcustomer-btn-payboard">
                                            <span class="badges addcustomer-btn-payboard">
                                                <i class="material-icons fw-bolder addcustomer-btn-payboard">add</i>
                                            </span>Add Customer </button>
                                    </div>
                                    <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button id="addsale-btn" class="btn btn-light btn-lg btn-sae btn-dis btn-dis-act">
                                            <span class="badges">
                                                <i class="material-icons fw-bolder">add</i>
                                            </span>
                                        </button>
                                        <button id="" class="btn btn-light btn-lg btn-sae btn-dis btn-dis-act reset-order-btn">
                                            <span class="badges reset-order-btn">
                                                <i class="material-icons fw-bolder reset-order-btn">cancel_presentation</i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td>
                            <div id="sale-item-payboard" class="h-100">
                                <ul id="menu-accordion" class="menu-accordion">
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="">
                        <td>
                            <div id="add-some" class="d-flex justify-content-between align-items-center pe-4 ps-4 pt-3 pb-3 h-100">Add <a name="" id="add-some-discount" class="" href="#" role="button">Discount</a>
                                <a name="" id="add-some-coupon" class="" href="#" role="button">Coupon Code</a>
                                <a name="" id="add-some-note" class="" href="#" role="button">Note</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="pay-section" class="m-0 p-0">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex justify-content-start">
                                                <div class="m-2">
                                                    <p class="fs-5 text-start">Subtotal</p>
                                                    <p class="fs-5 text-start">Service Charge</p>
                                                    <p class="fs-5 text-start">Total</p>
                                                    <br>
                                                    <button id="btn-hold-cart" class="btn btn-lg btn-sae btn-sae w-100">
                                                        <i class="material-icons">pause_circle</i> Hold Cart </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex justify-content-end">
                                                <div class="m-2">
                                                    <p id="pay-section-subtotal" class="fs-5 fw-bolder text-end">0.00</p>
                                                    <p id="pay-section-service-charge" class="fs-5 fw-bolder text-end">30.00</p>
                                                    <p id="pay-section-total" class="fs-5 fw-bolder text-end">0.00</p>
                                                    <br>
                                                    <button id="btn-pay-proceed" class="btn btn-lg btn-green btn-green w-100" data-toggle="modal" data-target="#pay-proceed-modal">
                                                        <i class="material-icons">payment</i> Proceed
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>