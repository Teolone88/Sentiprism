<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <?php require './core_functions.php'; ?>
    <?php require './constant.php'; ?>
    <?php checkSession(); ?>    
    <?php require './head.php'; ?>

    <body class="<?= THEME_COLOR ?>">
        <?php require './header.php'; ?>

        <!-- #Top Bar -->
        <section>
            <?php require './sidebar.php'; ?>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="block-header">
                    <h2>DASHBOARD</h2>
                </div>                
                <div class="block-header">
                    <?php
                    $msg = new \Plasticbrain\FlashMessages\FlashMessages();
                    $msg->display();
                    ?>                
                </div>            
                <?php
                include './phpConnection.php';
                $setUserCounts = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_type` LIKE 'USER' ORDER BY `user_fullname` ASC");
                include './phpConnection.php';
                $setManagerCounts = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_type` LIKE 'MANAGER' ORDER BY `user_fullname` ASC");
                include './phpConnection.php';
                $setSquardsCounts = mysqli_query($conn, "SELECT * FROM `squard`");
                ?>
                <!-- Widgets -->                
                <div class="row clearfix">                    
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-pink hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">person_add</i>
                            </div>
                            <div class="content">
                                <div class="text">TOTAL MANAGERS</div>
                                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php
                                    if (isset($setManagerCounts)): echo $setManagerCounts->num_rows;
                                    endif;
                                    ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-cyan hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">person_add</i>
                            </div>
                            <div class="content">
                                <div class="text">TOTAL USERS</div>
                                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php
                                    if (isset($setUserCounts)): echo $setUserCounts->num_rows;
                                    endif;
                                    ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-light-green hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">forum</i>
                            </div>
                            <div class="content">
                                <div class="text">TOTAL SQUARDS</div>
                                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?php
                                    if (isset($setSquardsCounts)): echo $setSquardsCounts->num_rows;
                                    endif;
                                    ?></div>
                            </div>
                        </div>
                    </div>                    
                </div>               
            </div>
        </section>

        <?php require './buttom.php'; ?>
    </body>
</html>