<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title>Dashboard - GYYMS admin</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
</head>

<?php include 'layouts/body.php'; ?>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <?php include 'layouts/menu.php'; ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
    
        <!-- Page Content -->
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Admin!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Point Of Sale</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- POS Section -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col text-center">
                                    <button class="btn btn-outline-primary active">Protien Powder <br> 8 protien powder</button>
                                </div>
                                <div class="col text-center">
                                    <button class="btn btn-outline-primary">Supliments <br> 14 supliments</button>
                                </div>
                                <div class="col text-center">
                                    <button class="btn btn-outline-primary">Drinks <br> 5 drinks</button>
                                </div>
                              
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="path/to/t-bone-steak.jpg" class="card-img-top" alt="T-Bone Steak">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Protien poweder</h5>
                                            <p class="card-text">4 punds</p>
                                            <p class="card-text text-success">$16.50</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="path/to/chefs-salmon.jpg" class="card-img-top" alt="Chef's Salmon">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Chef's Salmon</h5>
                                            <p class="card-text">16 mins to cook</p>
                                            <p class="card-text text-success">$12.40</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="path/to/ramen.jpg" class="card-img-top" alt="Ramen">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Ramen</h5>
                                            <p class="card-text">16 mins to cook</p>
                                            <p class="card-text text-success">$14.90</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add more food items here -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Current Order</h4>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    T-Bone Stake 
                                    <div  class="d-flex align-items-center"> 
                                        <button class="btn btn-sm btn-outline-secondary">-</button>
                                        <span class="badge badge-primary badge-pill">2</span>
                                        <button class="btn btn-sm btn-outline-secondary">+</button>
                                    </div>
                                    <span>$66.00</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Soup of the Day 
                                    <div  class="d-flex align-items-center">
                                        <button class="btn btn-sm btn-outline-secondary">-</button>
                                        <span class="badge badge-primary badge-pill">1</span>
                                        <button class="btn btn-sm btn-outline-secondary">+</button>
                                    </div>
                                    <span>$7.50</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Pancakes 
                                    <div  class="d-flex align-items-center">
                                        <button class="btn btn-sm btn-outline-secondary">-</button>
                                        <span class="badge badge-primary badge-pill">2</span>
                                        <button class="btn btn-sm btn-outline-secondary">+</button>
                                    </div>
                                    <span>$27.00</span>
                                </li>
                                <!-- Add more orders here -->
                            </ul>
                            <button class="btn btn-outline-danger btn-block mt-3">Clear All</button>

                            <div class="mt-4">
                                <p>Subtotal <span class="float-right">$100.50</span></p>
                                <p>Discounts <span class="float-right text-danger">-$8.00</span></p>
                                <p>Tax (12%) <span class="float-right">$11.20</span></p>
                                <hr>
                                <h4>Total <span class="float-right">$93.46</span></h4>
                            </div>

                            <div class="mt-4">
                                <h5>Payment Method</h5>
                                <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                    <label class="btn btn-outline-primary flex-fill">
                                        <input type="radio" name="payment" id="cash" autocomplete="off"> Cash
                                    </label>
                                    <label class="btn btn-outline-primary flex-fill">
                                        <input type="radio" name="payment" id="card" autocomplete="off"> Card
                                    </label>
                                    <label class="btn btn-outline-primary flex-fill">
                                        <input type="radio" name="payment" id="ewallet" autocomplete="off"> E-Wallet
                                    </label>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-block mt-4">Print Bills</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->

<?php include 'layouts/customizer.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>

</body>

</html>
