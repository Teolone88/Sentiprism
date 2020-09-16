<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="s_container">
    <div class="row ">
        <div class="col-lg-3 col-md-2">
            <a href="#" class="ss_details_logo">
                <img src="assets/images/logo_1.png" class="details_logo_width">
            </a>
        </div>
        <div class="col-lg-9 col-md-10 align-self-center">
            <ul class="ss_profile_detials">
                <li class="pt-2 ss_border_right position_relative">
                    <a href="#" class="welcome_profile rate_color pr-4  " data-toggle="dropdown">
                        feedback points : 4
                    </a>
                </li>
                <li class="pt-2 ss_border_right position_relative">
                    <?php
                    $currentUserEmail = $_SESSION['user']['email'];
                    $findUserQry = "CALL checkEmail('$currentUserEmail')";
                    $exUserQry = mysqli_query($conn, $findUserQry);
                    $getCurrentUserData = mysqli_fetch_assoc($exUserQry);
                    ?>                   
                    <a href="#" class="welcome_profile rate_color pr-4  " data-toggle="dropdown">
                        <?php $tatingCount = $getCurrentUserData['average_ratings']; ?>
                        <?php for ($i = 1; $i <= $tatingCount; $i++): ?>
                            <i class="fa fa-star px-1 "></i>                       
                        <?php endfor; ?>
                    </a>
                </li>
                <li class="top_padding">
                    <a href="#" class="welcome_profile pr-4 " data-toggle="dropdown">Welcome <?= $_SESSION['user']['user_fullname']; ?></a>
                    <?php if (empty($getCurrentUserData['profile_image'])): ?>
                        <a href="#" class=" ss_position_online pr-0" data-toggle="dropdown"><img src="uploads/default-avatar.png" onclick="getSquardMemberEditDetails(<?= $getCurrentUserData['id'] ?>)" alt="user_auth" class="img-thumbnail ss_profile_img"/><span class="user-online-status"></span></a>
                    <?php else: ?>
                        <a href="#" class=" ss_position_online pr-0" data-toggle="dropdown"><img src="<?= userProfileImageURL($getCurrentUserData['profile_image']); ?>" onclick="getSquardMemberEditDetails(<?= $getCurrentUserData['id'] ?>)" alt="user_auth" class="img-thumbnail ss_profile_img"/><span class="user-online-status"></span></a>
                    <?php endif; ?>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<script>
    function getSquardMemberEditDetails(userId) {
        if (userId != "") {
            $.ajax({
                url: "ajax/getSquardMemberDetails.php",
                type: "POST",
                data: "userId=" + userId,
                success: function (data) {
                    var UserData = JSON.parse(data);
                    $('#sq-member-image1').html('<img alt="example image"  src="' + UserData.profile_image + '" style="max-width:100px;max-height:100px;">');
                    $('#sq-member-name1').val(UserData.user_fullname);
                    $('#sq-member-title1').val(UserData.title);
                    $('#sq-member-years1').val(UserData.years_old);
                    $('#sq-member-desig1').val(UserData.business_name);
                    $('#sq-member-income1').val(UserData.yearly_income);
                    $('#sq-member-desig-name1').val(UserData.person_designation);
                    $('#sq-member-desig-description1').val(UserData.person_designation_details);
                    $('#sq-member-chars-name1').val(UserData.key_characteristic);
                    $('#sq-member-chars-details1').val(UserData.key_characteristic_details);
                    $('#sq-member-goals-name1').val(UserData.goals);
                    $('#sq-member-goals-description1').val(UserData.goals_details);
                    $('#squardMemberEditProfile').modal('show');
                    console.log(UserData);
                }
            });
        }
    }
</script>


<div class="modal fade" id="squardMemberEditProfile" tabindex="-1" role="dialog" aria-labelledby="squardMemberEditProfile">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Edit Your Profile</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="widget-list">
                    <div class="row">
                        <!-- User Summary -->
                        <div class="col-md-4 widget-holder">
                            <div class="col-sm-12">
                                <div class="panel widget light-widget panel-bd-top">
                                    <div class="panel-heading no-title"> </div>
                                    <div class="panel-body">
                                        <div class="text-center vd_info-parent" id="sq-member-image"> 
                                            <img alt="example image"  src="<?= userProfileImageURL($getCurrentUserData['profile_image']); ?>" style="max-width:100px;max-height:100px;"> 
                                        </div>                                            
                                        <!--                                            <h2 class="font-semibold mgbt-xs-5 text-center" style="margin-top:15px;">Mariah Caraiban</h2>
                                                                                    <h4 class="text-center">Owner at Our Company, Inc.</h4>
                                                                                    <p class="text-center">Ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>-->
                                        <div class="mgtp-20">
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3" style="margin-top:9px;">
                                                    <h6 class="text-muted text-uppercase">Name</h6>
                                                </div>
                                                <!-- /.col-md-6 -->
                                                <div class="col-md-9">
                                                    <h3 class="text-muted"><input type="text" id="sq-member-name1" style="border:none;"/></h3>
                                                </div>                                                   
                                                <div class="col-md-3" style="margin-top:9px;">
                                                    <h6 class="text-muted text-uppercase">Title</h6>
                                                </div>
                                                <!-- /.col-md-6 -->
                                                <div class="col-md-9">
                                                    <h4 class="text-muted" ><input type="text" id="sq-member-title1" value="" style="border:none;"/></h4>
                                                </div>                                                   
                                            </div>
                                            <hr>
                                            <h6 class="text-uppercase PREFERENCES_af py-3">BACKGROUND</h6>                                                    
                                            <div class="row">

                                                <div class="col-md-2">
                                                    <h6 class="text-muted text-uppercase"><span class="fa fa-calendar"></span></h6>
                                                </div>
                                                <div class="col-md-10 left_text_Sss">
                                                    <h6 class="text-muted" ><input type="text" id="sq-member-years1" style="border:none;"/></h6>
                                                </div>   

                                                <div class="col-md-2">
                                                    <h6 class="text-muted text-uppercase"><span class="fa fa-user"></span></h6>
                                                </div>
                                                <div class="col-md-10 left_text_Sss">
                                                    <h6 class="text-muted" ><input type="tel" id="sq-member-desig1" value="" style="border:none;"/></h4>
                                                </div> 

                                                <div class="col-md-2 ">
                                                    <h6 class="text-muted text-uppercase"><span class="fa fa-usd"></span></h6>
                                                </div>
                                                <div class="col-md-10 left_text_Sss">
                                                    <h6 class="text-muted"><input type="text" id="sq-member-income1" value="" style="border:none;"/></h4>
                                                </div>                                                        
                                            </div>
                                            <hr>    
                                            <h6 class="text-uppercase PREFERENCES_af   py-3">TECH PREFERENCES</h6>                                                    
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <h6 class="text-muted text-uppercase"><span class="fa fa-desktop"></span></h6>
                                                </div>
                                                <div class="col-md-10 left_text_Sss">
                                                    <h6 class="text-muted">Windows</h3>
                                                </div>   

                                                <div class="col-md-2">
                                                    <h6 class="text-muted text-uppercase"><span class="fa fa-phone"></span></h6>
                                                </div>
                                                <div class="col-md-10 left_text_Sss">
                                                    <h6 class="text-muted">iPhone</h4>
                                                </div> 

                                                <div class="col-md-2">
                                                    <h6 class="text-muted text-uppercase"><span class="fa fa-book"></span></h6>
                                                </div>
                                                <div class="col-md-10 left_text_Sss">
                                                    <h6 class="text-muted">iPad</h4>
                                                </div>                                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                                
                        </div>



                        <!-- /.widget-holder -->
                        <!-- Tabs Content -->
                        <div class="col-md-8 widget-holder">
                            <div class="tab-pane active" id="profile-tab-bordered-1" aria-expanded="true">
                                <div class="contact-details-profile pd-lr-30">
                                    <hr>
                                    <h4>Persona Designation</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!--                                            <h6 id="sq-member-desig-name">
                                                                                            Lives in
                                                                                            <small><p>Enter Description....!</p></small>
                                                                                        </h6>-->
                                            <p class="mr-t-0">
                                                <textarea id="sq-member-desig-description1" rows="5" style="width:100%;border: none;"></textarea>
                                            </p>
                                        </div>                                            
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    <h4>Key Characteristics</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!--                                            <h6 id="sq-member-chars-name">
                                                                                            Lives in
                                                                                            <small><p>Enter Description....!</p></small>
                                                                                        </h6>-->
                                            <p class="mr-t-0">
                                                <textarea id="sq-member-chars-details1" rows="5" style="width:100%;border: none;"></textarea>
                                            </p>
                                        </div>                                            
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    <h4>Goals</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!--                                            <h6 id="sq-member-goals-name">
                                                                                            Lives in
                                                                                            <small><p>Enter Description....!</p></small>
                                                                                        </h6>-->
                                            <p class="mr-t-0">
                                                <textarea id="sq-member-goals-description1" rows="5" style="width:100%;border: none;"></textarea>
                                            </p>
                                        </div>                                            
                                    </div>
                                    <!-- /.row -->
                                    <hr class="border-0 mr-tb-50">
                                </div>
                                <!-- /.contact-details-profile -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                        <!-- /.widget-holder -->
                    </div>
                    <!-- /.row -->
                </div>

            </div>
            <div class="modal-footer" id="profileEditedMessage">

            </div>
            <div class="modal-footer">
                <button type="button" onclick="updateUserProfile(<?= $getCurrentUserData['id'] ?>)" class="btn btn-primary">Save Profile</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function updateUserProfile(userId) {
        var memberName = $('#sq-member-name1').val();
        var memberTitle = $('#sq-member-title1').val();
        var memberYears = $('#sq-member-years1').val();
        var memberDesignation = $('#sq-member-desig1').val();
        var memberIncome = $('#sq-member-income1').val();
//        $('#sq-member-desig-name1').val();
        var memberDesiDescription = $('#sq-member-desig-description1').val();
//        $('#sq-member-chars-name1').val();
        var memberCharDetails = $('#sq-member-chars-details1').val();
//        $('#sq-member-goals-name1').val();
        var memberGoalDescription = $('#sq-member-goals-description1').val();
        if (userId != "") {
            $.ajax({
                url: "ajax/editUserProdile.php",
                type: "POST",
                data: "userId=" + userId + "&memberName=" + memberName + "&memberTitle=" + memberTitle + "&memberYears=" + memberYears + "&memberDesignation=" + memberDesignation + "&memberIncome=" + memberIncome + "&memberDesiDescription=" + memberDesiDescription + "&memberCharDetails=" + memberCharDetails + "&memberGoalDescription=" + memberGoalDescription,
                success: function (data) {
//                    var UserData = JSON.parse(data);
//                    $('#sq-member-image1').html('<img alt="example image"  src="' + UserData.profile_image + '" style="max-width:100px;max-height:100px;">');                   
//                    $('#squardMemberEditProfile').hide('modal');

                    $('#profileEditedMessage').html('<span class="hidden" style="color:green;margin-right:100px;">Profile Updated.</span>');
                    setInterval(function () {
                        $('#profileEditedMessage').html('');
                    }, 3000);

                    console.log(UserData);
                }
            });
        }
    }
</script>