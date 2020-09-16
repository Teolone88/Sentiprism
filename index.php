<!DOCTYPE html>
<html lang="en">
    <head>
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
                    <div class="col-lg-7 align-self-center">
                        <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3751.9211788255225!2d75.32412441529293!3d19.88554993119255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bdb9813abe525f5%3A0x5867b28afcd396e0!2s2nd+fpoor%2C+Pranav+Plaza%2C+Aurangpura%2C+Aurangapura+Rd%2C+Naralibag%2C+Aurangabad%2C+Maharashtra+431001!5e0!3m2!1sen!2sin!4v1525588092601" class="map_location" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                        <iframe src="assets/images/map.png" class="map_location" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>                   
                    <div class="col-lg-5 align-self-center">
                        <?php
                        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
                        $msg->display();
                        ?>
                        <form action="loginCode.php" method="POST">
                            <div class="login_form py-3 ">
                                <div class="py-2">
                                    <div class="s_Connects pt-3  text-center"> Connect for real with<br /> your squad </div>

                                    <div class="row">
                                        <div class="col-lg-12 py-4">
                                            <div class="input-group ss_padding_text_box pt-4">
                                                <span class="input-group-addon s_text_box_abone" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                                <input type="text" name="user_email" class="form-control ss_text_box" placeholder="Email" aria-describedby="basic-addon1">
                                            </div>
                                            <div class="input-group ss_padding_text_box pt-4  ">
                                                <span class="input-group-addon s_text_box_abone" id="basic-addon1"><i class="fa fa-unlock-alt"></i></span>
                                                <input type="text" name="user_password" class="form-control ss_text_box" placeholder="Password" aria-describedby="basic-addon1">
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
                                                <input type="submit" name="loginSubmit" class="btn ss_btn" value="Sign In">
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
                                                <a href="signUp.php" class="btn ss_btn">
                                                    Sign Up
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
    </body>
</html>