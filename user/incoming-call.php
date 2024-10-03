<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Incoming Call - HRMS admin template</title>

    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>

</head>

<body>

    <div class="main-wrapper">
<?php include 'layouts/topbar.php'; ?>
<?php include 'layouts/chat_sidebar.php'; ?>
<?php include 'layouts/two-col-sidebar.php'; ?>

    <!-- Page Wrapper -->
            <div class="page-wrapper">
            
                <!-- Incoming Call -->
                <div class="call-box incoming-box">
                    <div class="call-wrapper">
                        <div class="call-inner">
                            <div class="call-user">
                                <img class="call-avatar" src="assets/img/profiles/avatar-11.jpg" alt="">
                                <h4>Wilmer Deluna</h4>
                                <span>Calling ...</span>
                            </div>                          
                            <div class="call-items">
                                <a href="chat.php" class="btn call-item call-end"><i class="material-icons">call_end</i></a>
                                <a href="video-call.php" class="btn call-item call-start"><i class="material-icons">call</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Incoming Call -->
                
            </div>
            <!-- /Page Wrapper -->


</div>
<!-- end main wrapper-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>



</body>

</html>