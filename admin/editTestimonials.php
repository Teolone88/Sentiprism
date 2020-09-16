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
                    <?php
                    // GET TESTIMONIALS DATA
                    $requestMethod = $_SERVER['REQUEST_METHOD'];
                    if ($requestMethod == 'GET'):
                        $editId = base64_decode($_GET['testiId']);
                        include './phpConnection.php';
                        $findTestimonialsQry = "CALL getTestimonialsById('$editId')";
                        $exTestimonialsQrys = mysqli_query($conn, $findTestimonialsQry);
                        $getTestimonialData = mysqli_fetch_assoc($exTestimonialsQrys);
                    else:
                        messageError('Invalid Request.');
                        header('Location:allTestimonials.php');
                    endif;
                    ?>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    EDIT EXISTING TESTIMONIALS
                                </h2>                               
                            </div>
                            <div class="body">
                                <form action="editTestimonialsCode.php" method="POST" enctype="multipart/form-data">
                                    <label for="email_address">Name of Testimonials</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="email_address" value="<?= $getTestimonialData['testimonial_name']; ?>" class="form-control" name="testi_name" placeholder="Enter Testimonials Name" required="">
                                        </div>
                                    </div>
                                    <label for="">Image of Testimonials</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file"  class="form-control" name="testi_image">
                                            <input type="hidden"  class="form-control" value="<?= $getTestimonialData['id']; ?>" name="testi_id" required="">
                                            <input type="hidden"  class="form-control" value="<?= $getTestimonialData['testimonial_image']; ?>" name="testi_image_name" required="">
                                        </div>
                                    </div>  
                                    <label for="">Add Details of Testimonials</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" name="testi_description"  class="form-control no-resize" placeholder="Please enter description of testimonials" required=""><?= $getTestimonialData['testimonial_description']; ?></textarea>
                                        </div>
                                    </div>
                                    <label for="">Testimonials Status</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <div class="demo-checkbox">
                                                <?php if ($getTestimonialData['is_active'] == 0): ?>
                                                    <input type="checkbox" name="is_active" value="YES" id="md_checkbox_21" class="filled-in chk-col-red" />
                                                <?php else: ?>
                                                    <input type="checkbox" name="is_active" value="NO" id="md_checkbox_21" class="filled-in chk-col-red" checked />
                                                <?php endif; ?>
                                                <label for="md_checkbox_21">
                                                    <?php if ($getTestimonialData['is_active'] == 0): ?>
                                                        ACTIVE
                                                    <?php else: ?>
                                                        DEACTIVE
                                                    <?php endif; ?>
                                                </label>                                      
                                            </div>
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