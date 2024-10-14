<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title>Dashboard - GYYMS admin</title>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <style>
        .main-wrapper {
            width: 100%;
            height: auto;
            margin: 0%;
            flex-direction: column;
        }
        .card {
    transition: transform 0.3s ease; /* Smooth transition */
    
}

.card:hover {
    transform: scale(1.05); /* Zoom effect */
    background-color: #48c92f;
    color: #fff;
}
.description {
        white-space: pre-wrap; /* Preserve whitespace and wrap text */
    }
    </style>
</head>

<body>
    <?php include 'layouts/body.php'; ?>
    <div class="main-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Welcome Admin!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Targeted exercise</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Muscle Groups Section -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Muscle Groups</h4>
                        <div class="row">
                            <!-- Muscle Groups Array -->
                            <?php 
                           $muscle_groups = [
                            "Chest" => ["img" => "assets/img/chest.svg", "file" => "chest-exercises.php"],
                            "Shoulders" => ["img" => "assets/img/shoulder.svg", "file" => "shoulder-exercises.php"],
                            "Triceps" => ["img" => "assets/img/triceps.svg", "file" => "triceps-exercises.php"],
                            "Biceps" => ["img" => "assets/img/biceps.svg", "file" => "biceps-exercises.php"],
                            "Back" => ["img" => "assets/img/back.svg", "file" => "back-exercises.php"],
                            "Quads" => ["img" => "assets/img/quads.svg", "file" => "quads-exercises.php"],
                            "Calves" => ["img" => "assets/img/calves.svg", "file" => "calves-exercises.php"],
                            "Abs" => ["img" => "assets/img/abs.svg", "file" => "abs-exercises.php"],
                            "Hamstrings" => ["img" => "assets/img/hamstrings.svg", "file" => "hamstrings-exercises.php"],
                            "Forearms" => ["img" => "assets/img/forearms.svg", "file" => "forearm-exercises.php"],
                            "Glutes" => ["img" => "assets/img/glutes.svg", "file" => "glutes-exercises.php"],
                            "Abductor" => ["img" => "assets/img/abductor.svg", "file" => "abductor-exercises.php"],
                        ];

                        foreach ($muscle_groups as $muscle => $data) {
                            $image = $data['img'];
                            $file = $data['file'];
                            echo '
                            <div class="col-md-3 col-sm-6">
                                <div class="card text-center">
                                    <a href="' . $file . '">
                                        <img src="' . $image . '" class="card-img-top" alt="' . $muscle . '">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"> ' . $muscle . '</h5>
                                    </div>
                                </div>
                            </div>';
                        }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /Muscle Groups Section -->
            </div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Wrapper -->
    </div>
    <?php include 'layouts/customizer.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>
</body>

</html>
