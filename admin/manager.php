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
                                    ADD NEW MANAGER
                                </h2>                              
                            </div>                            
                            <div class="body">
                                <form action="addUserCode.php" method="POST" enctype="multipart/form-data">
                                    <label>Full Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" value="" class="form-control" name="user_name" placeholder="Enter User Full Name" required="">
                                        </div>
                                    </div>
                                    <label>Email</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email"  id="user_email" onchange="validateUserEmail()" class="form-control" name="user_email" placeholder="Enter User Email" required="">                                            
                                        </div>
                                        <div id="validateMessage">
                                        </div>
                                    </div>
                                    <label>Phone</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text"  class="form-control" value="" name="user_phone" placeholder="Enter Phone No" required="">
                                        </div>
                                    </div>
                                    <label>Password</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text"  class="form-control" value="<?= rand(10000, 100000); ?>" name="user_pass" placeholder="Enter Phone No" required="">
                                        </div>
                                    </div>
                                    <label>Designation</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text"  class="form-control" value="" name="user_desig" placeholder="Enter User Designation" required="">
                                        </div>
                                    </div>
                                    <label>Birth Date</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="" name="user_birth" placeholder="Enter User Birth Date" required="">
                                        </div>
                                    </div>                                   
                                    <label>Business Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="" name="user_business_name" placeholder="Enter Business Name" required="">
                                        </div>
                                    </div>
                                    <label for="">Image of Manager</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file"  class="form-control" name="user_image" required="">
                                        </div>
                                    </div>  
                                    <button type="submit" name="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </section>           
        <?php require './buttom.php'; ?>

        <script>
            function validateUserEmail() {
                var email = $('#user_email').val();
                $.ajax({
                    url: "ajax/checkEmail.php",
                    type: "POST",
                    data: "email=" + email,
                    success: function (data) {
                        var userData = JSON.parse(data);
                        if (userData.starus == parseInt(0)) {
                            $('#user_email').val('');
//                            $('#emailMessage').removeClass('hidden-md-up');
                            $('#validateMessage').html('<label class="text-danger" >Email is already exist</label><input type="hidden" value="YES" class="form-control" name="isAvailable"required="">');
                        } else {
//                            $('#emailMessage').removeClass('hidden-md-up');
                            $('#validateMessage').html('<label class="text-success" >Available.</label><input type="hidden" value="NO" class="form-control" name="isAvailable"required="">');
                        }
                    }
                });
            }

        </script>
    </body>
</html>