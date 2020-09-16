<?php session_start(); ?>
<?php $userId = $_GET['edit']; ?>
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

                </div>                
                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php
                        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
                        $msg->display();
                        ?> 
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    EDIT EXISTING MANAGER
                                </h2>                              
                            </div>
                            <?php
                            include './phpConnection.php';
                            $findUserQry = "SELECT * FROM users WHERE id=$userId";
                            $exUserQrys = mysqli_query($conn, $findUserQry);
                            $getUser = mysqli_fetch_assoc($exUserQrys);
                            ?>
                            <div class="body">
                                <form action="editManagerCode.php" method="POST" enctype="multipart/form-data">
                                    <label>Full Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" value="<?php
                                            if (!empty($getUser)): if (!empty($getUser['user_fullname'])): echo $getUser['user_fullname'];
                                                endif;
                                            endif;
                                            ?>" class="form-control" name="user_name" placeholder="Enter User Full Name" required="">
                                        </div>
                                    </div>
                                    <label>Phone</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text"  class="form-control" value="<?php
                                            if (!empty($getUser)): if (!empty($getUser['phone'])): echo $getUser['phone'];
                                                endif;
                                            endif;
                                            ?>" name="user_phone" placeholder="Enter Phone No" required="">
                                        </div>
                                    </div>
                                    <label>Designation</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text"  class="form-control" value="<?php
                                            if (!empty($getUser)): if (!empty($getUser['person_designation'])): echo $getUser['person_designation'];
                                                endif;
                                            endif;
                                            ?>" name="user_desig" placeholder="Enter User Designation" required="">
                                        </div>
                                    </div>
                                    <label>Birth Date</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?php
                                            if (!empty($getUser)): if (!empty($getUser['birth_date'])): echo $getUser['birth_date'];
                                                endif;
                                            endif;
                                            ?>" name="user_birth" placeholder="Enter User Birth Date" required="">
                                        </div>
                                    </div>                                   
                                    <label>Business Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?php
                                            if (!empty($getUser)): if (!empty($getUser['business_name'])): echo $getUser['business_name'];
                                                endif;
                                            endif;
                                            ?>" name="user_business_name" placeholder="Enter Business Name" required="">
                                        </div>
                                    </div>
                                    <input type="hidden" name="userId" value="<?= $userId ?>">
                                    <button type="submit" name="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </section>           
        <?php require './buttom.php'; ?>
    </body>
</html>