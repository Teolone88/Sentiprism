<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require './core_functions.php'; ?>
        <?php require './head.php'; ?>
    </head>
    <body>

        <div class="container-fluid py-2 header_bg">
            <?php require './header.php'; ?>
        </div>


        <!--  START YOUR CONTAIN PART  -->


        <div class="container-fluid py-5">
            <div class="s_container">
                <div class="row height_ss">
                    <div class="col-lg-7 align-self-center border border-left-0">
                        <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3751.9211788255225!2d75.32412441529293!3d19.88554993119255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bdb9813abe525f5%3A0x5867b28afcd396e0!2s2nd+fpoor%2C+Pranav+Plaza%2C+Aurangpura%2C+Aurangapura+Rd%2C+Naralibag%2C+Aurangabad%2C+Maharashtra+431001!5e0!3m2!1sen!2sin!4v1525588092601" class="map_location" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                        <!--<iframe src="assets/images/map.png" class="map_location" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                        <?php
                        include './phpConnection.php';
                        $findTestimonialsQry = "CALL getAllTestimonials()";
                        $exTestimonialsQrys = mysqli_query($conn, $findTestimonialsQry);
                        ?>

                        <!-- Section: Testimonials v.1 -->
                        <section class="text-center my-5" style="max-height:802px;overflow:auto;overflow-x:hidden;">                           
                            <!-- Grid row -->
                            <div class="row">
                                <?php foreach ($exTestimonialsQrys as $exTestimonialsQry): ?>
                                    <div class="col-lg-4 col-md-12 mb-lg-0 mb-4 my-3">
                                        <!--Card-->
                                        <div class="card testimonial-card">
                                            <!--Background color-->
                                            <div class="card-up info-color"></div>
                                            <!--Avatar-->
                                            <?php $imageUrl = testimonialsProfileImageURL($exTestimonialsQry['testimonial_image']); ?>
                                            <div class="avatar mx-auto white">
                                                <img src="<?= $imageUrl ?>" class="rounded-circle img-fluid">
                                            </div>
                                            <div class="card-body">
                                                <!--Name-->
                                                <h4 class="font-weight-bold mb-4"><?= $exTestimonialsQry['testimonial_name'] ?></h4>
                                                <hr>
                                                <!--Quotation-->
                                                <p class="dark-grey-text mt-4"><i class="fa fa-quote-left pr-2"></i><?= $exTestimonialsQry['testimonial_description'] ?></p>
                                            </div>
                                        </div>
                                        <!--Card-->
                                    </div>                                                           
                                    <!--Grid column-->                         
                                <?php endforeach; ?>
                            </div>

                        </section>
                        <!-- Section: Testimonials v.1 -->

                    </div>
                    <div class="col-lg-5 align-self-center">
                        <?php
                        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
                        $msg->display();
                        ?>
                        <form action="signUpCode.php" method="POST">
                            <div class="login_form py-3 ">                                
                                <div class="py-2">                                    
                                    <div class="s_Connects pt-3  text-center"> Connects for real with<br /> your squad </div>
                                    <div class="row">                                       
                                        <div class="col-lg-12 py-4">
                                            <div class="input-group ss_padding_text_box pt-4">
                                                <span class="input-group-addon s_text_box_abone" id="basic-addon1"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control ss_text_box" name="user_fullname" placeholder="Full Name" aria-describedby="basic-addon1" required>
                                            </div>
                                            <div class="ss_padding_text_box pt-2 hidden-md-up" id="emailMessage">

                                            </div>
                                            <div class="input-group ss_padding_text_box pt-3">
                                                <span class="input-group-addon s_text_box_abone" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                                <input type="email" class="form-control ss_text_box" onchange="validateUserEmail()" id="user_email" name="user_email" placeholder="Email" aria-describedby="basic-addon1" required>
                                            </div>
                                            <div class="ss_padding_text_box pt-2">
                                                <span class="text-danger hidden-md-up" >Your password is not match.</span>
                                            </div>
                                            <div class="input-group ss_padding_text_box pt-3  ">
                                                <span class="input-group-addon s_text_box_abone" id="basic-addon1"><i class="fa fa-unlock-alt"></i></span>
                                                <input type="text" class="form-control ss_text_box" id="user_password" name="user_password" placeholder="Password" aria-describedby="basic-addon1" required>
                                            </div>                                            
                                            <div class="input-group ss_padding_text_box pt-4  ">
                                                <span class="input-group-addon s_text_box_abone" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                                <input type="text" class="form-control ss_text_box" id="user_retype_password" name="user_retype_password" placeholder="Retype Password" aria-describedby="basic-addon1" required>
                                            </div>
                                            <div class="ss_padding_text_box pt-2">
                                                <span class="text-danger hidden-md-up" >This mobile no is already exist.</span>
                                            </div>
                                            <div class="input-group ss_padding_text_box pt-4  ">
                                                <span class="input-group-addon s_text_box_abone" id="basic-addon1"><i class="fa fa-phone"></i></span>
                                                <input type="text" class="form-control ss_text_box" id="user_phone" name="user_phone" placeholder="Phone" aria-describedby="basic-addon1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ss_padding_text_box">
                                        <div class="row py-2">
                                            <div class="col-lg-6 col-6 col-md-6 align-self-center">
                                                <label class="custom-control custom-checkbox ">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description ss_remember">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-6 align-self-center text-right">                                           
                                                <input type="submit" name="signUpSubmit" class="btn ss_btn" value="Sign Up">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ss_padding_text_box ss_bg_sign_up py-2 my-3">
                                        <div class="row py-2 my-3 ss_bg_sign_up ">
                                            <div class="col-lg-6 col-6 col-md-6 align-self-center">
                                                <div class="label_contain">
                                                    Join your squad
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-6 align-self-center text-right">
                                                <a href="index.php" class="btn ss_btn">
                                                    Sign In
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ss_padding_text_box ss_bg_sign_up py-2 my-3">
                                        <div class="row">
                                            <div class="col-lg-12 col-12 col-md-12 align-self-center">
                                                <span>
                                                    <button type="button" class="btn btn-fb" style="background-color:#3b5998;color:#fff;" onClick="document.location.href = 'code/facebooklogin.php'"><i class="fa fa-facebook pr-1"></i> Facebook</button>
                                                </span>                                                                                                                                                                                                                                                                                                                  
                                                <span>
                                                    <button type="button" class="btn btn-gplus"  style="background-color:#dd4b39;color:#fff;" onClick="document.location.href = 'code/googlelogin.php'"><i class="fa fa-google-plus pr-1"></i> Google +</button>
                                                </span>                                                                                                                                   
                                                <span>
                                                    <button type="button" class="btn btn-li" style="background-color:#0082ca;color:#fff;" onClick="document.location.href = 'code/linkedlogin.php'"><i class="fa fa-linkedin pr-1"></i> Linkedin</button>
                                                </span>
                                                <span>
                                                    <button type="button" class="btn btn-tw" style="background-color:#55acee;color:#fff;" onClick="document.location.href = 'code/twitterlogin.php'"><i class="fa fa-twitter pr-1"></i> Twitter</button>
                                                </span>   
                                            </div>                                   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!--  END YOUR CONTAIN PART  -->


        <div class="container-fluid footer_bg py-3">
            <?php require './footer.php'; ?>
        </div>
        <?php require './buttom.php'; ?>

        <script>
            function validateUserEmail() {
                var email = $('#user_email').val();
                $.ajax({
                    url: "ajax/checkEmail.php",
                    type: "POST",
                    data: "email=" + email,
                    success: function (data) {
                        if (data.staus == 0) {
                            $('#user_email').val('');
                            $('#emailMessage').removeClass('hidden-md-up');
                            $('#emailMessage').html('<span class="text-danger">This user is already exist.</span>');
                        } else {
                            $('#emailMessage').removeClass('hidden-md-up');
                            $('#emailMessage').html('<span class="text-success">Available.</span>');
                        }
                    }
                });
            }
        </script>

    </body>
</html>