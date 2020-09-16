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
                                    ADD NEW TESTIMONIALS
                                </h2>                              
                            </div>
                            <div class="body">
                                <form action="addTestimonialsCode.php" method="POST" enctype="multipart/form-data">
                                    <label for="email_address">Name of Testimonials</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="email_address" class="form-control" name="testi_name" placeholder="Enter Testimonials Name" required="">
                                        </div>
                                    </div>
                                    <label for="">Image of Testimonials</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file"  class="form-control" name="testi_image" required="">
                                        </div>
                                    </div>  
                                    <label for="">Add Details of Testimonials</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" name="testi_description"  class="form-control no-resize" placeholder="Please enter description of testimonials" required=""></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
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