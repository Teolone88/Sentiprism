<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require './head.php'; ?>
        <?php require './quata.php'; ?>
        <?php checkSession(); ?> 
        <style>           
            .comment dl {
                margin-top: 0;
                margin-bottom: 0px;
                padding: 20px;
                background: #fff;
                -moz-box-shadow: 0 1px 2px rgba(0,0,0,.1);
                -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.1);
                box-shadow: 0 1px 2px rgba(0,0,0,.1);
            }                         
        </style>
    </head>
    <div class="container-fluid py-2 header_bg">
        <?php require './dashboardHeader.php'; ?>
    </div>
    <!--  START YOUR CONTAIN PART  -->
    <div class="container-fluid ss_toggle_bg py-2 ">
        <div class="row">
            <div class="col-md-2">
                <div class="s_container" style="float:right;">
                    <div class="" onclick="hide1(this)" id="toggle_menu">
                        <div class="bar1_os"></div>
                        <div class="bar2_os"></div>
                        <div class="bar3_os"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <a  href="admin/index.php"><span class="btn btn-primary" style="color:white;float:right;">Admin</span></a>
            </div>
        </div>
    </div>
    <?php
    // GET USER SQUARD  
    if ($_SESSION['user']['login_type'] == 'MANAGER' && $_SESSION['user']['user_type'] == 'MANAGER'):
        include './phpConnection.php';
        $currentUserID = $_SESSION['currentUserId'];
        //                $getUserSquard = mysqli_query($conn, "CALL getUserSquard('$currentUserID')");                
        $getUserSquard = mysqli_query($conn, "SELECT * FROM squard WHERE user_id='$currentUserID' LIMIT 1");
        $getData = mysqli_fetch_assoc($getUserSquard);
        $squardName = '';
        $squardId = '';
        if ($getUserSquard->num_rows > 0):
            $squardName = $getData['squard_name'];
            $squardId = $getData['id'];
        else:
            $squardName = 'Squard#';
            $squardId = 0;
        endif;
    else:
        include './phpConnection.php';
        $currentUserID = $_SESSION['currentUserId'];
        //                $getUserSquard = mysqli_query($conn, "CALL getUserSquard('$currentUserID')");                
        $getUserSquard = mysqli_query($conn, "SELECT a.*,b.squard_name FROM squard_member AS a JOIN squard AS b WHERE a.user_id='$currentUserID' LIMIT 1");
        $getData = mysqli_fetch_assoc($getUserSquard);
        $squardName = '';
        $squardId = '';
        if ($getUserSquard->num_rows > 0):
            $squardName = $getData['squard_name'];
            $squardId = $getData['squard_id'];
        else:
            $squardName = 'Squard#';
            $squardId = 0;
        endif;
    endif;
    ?>
    <div class="container-fluid mb-5">
        <div class="s_container">
            <div class="row">
                <div class="col-lg-2">
                    <nav class="nav ss_toggle_new flex-column py-2">
                        <a class="nav-link ss_menu_list" href="logOut.php">Sign Out</a>
                        <a class="nav-link active ss_menu_list" href="#"><?= $_SESSION['user']['user_fullname'] ?></a>
                        <a class="nav-link ss_menu_list" data-toggle="modal" data-target="#feedBackModal" onclick="getFeedbackAllDatas(<?= $squardId ?>)" href="#">FeedBack</a>
                        <a class="nav-link ss_menu_list" href="#" data-toggle="modal" onclick="getAllStatusChartsData()" data-target="#Status">Status</a>
                        <a class="nav-link ss_menu_list" href="#"  data-toggle="modal" onclick="getAllBDsChartsData()" data-target="#businessDriverModel">Business Drivers</a>
                        <a class="nav-link ss_menu_list" href="#">Calendar</a>
                        <?php if ($_SESSION['user']['login_type'] == 'MANAGER' && $_SESSION['user']['user_type'] == 'MANAGER'): ?>
                            <a class="nav-link ss_menu_list" href="#" data-toggle="modal" data-target="#addNewSquardMemberModal">Add New Member In Squard</a>
                            <a class="nav-link ss_menu_list" href="#" data-toggle="modal" data-target="#showCurrentMonthTopRatedSquard" onclick="showCurrentMonthTopRatedSquardMember(managerSquardId)">Current Month Top Rated Squards</a>
                        <?php endif; ?>
                        <!--                        <div class="pt-2">
                                                    <input type='text' id="preferredHex" />
                                                </div> -->


                        <div class="color_select">



                            <a href="#" class="ColorSelects btn dropbtn ">Squard Color</a>

                            <div class="vlnvipuw">

                                <div class="asff contain_color">

                                    <input type="button" value="#000"  onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background: #000">
                                    <input type="button" value="#8bc34a" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background:#8bc34a;color:#8bc34a;   ">

                                    <input type="button" value="#ffc107" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background: #ffc107;color:#ffc107; ">

                                    <input type="button" value="#03a9f4" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background: #03a9f4;color: #03a9f4">


                                    <input type="button" value="#e91e63" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style=" background: #e91e63;color:#e91e63;  ">


                                    <input type="button" value="#c62828" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background: #c62828;color: #c62828">

                                    <input type="button" value="#607d8b" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background: #607d8b;color: #607d8b">
                                    <input type="button" value="#65D360" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background:#65D360;color:#65D360;   ">


                                    <input type="button" value="#f8626a" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background: #f8626a;color:#f8626a; ">


                                    <input type="button" value="#4491f3" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background: #4491f3;color: #4491f3">

                                    <input type="button" value="#cddc39" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background: #cddc39;color: #cddc39">


                                    <input type="button" value="#65D360" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background:#65D360;color:#65D360;   ">
                                    <input type="button" value="#ef6c00" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background: #ef6c00;color:#ef6c00; ">
                                    <input type="button" value="#fff" onclick="getcolorHaxx(this.value)" class="color_optioncsac" name="" style="background: #fff;color: #fff">
                                    <div class="py-2 clearfix">

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>

                    </nav>
                </div>              
                <div class="col-lg-8 inner_sankk" style="color: #fff;">
                    <div style="padding:50px 0;color: #fff;">
                        <div id="thumbnail-slider">
                            <div class="inner">
                                <ul>
                                    <li>
                                        <a class="thumb" href="assets/slider1/img/6.jpg"></a>
                                    </li>
                                    <li>
                                        <a class="thumb" href="assets/slider1/img/7.jpg"></a>
                                    </li>
                                    <li>
                                        <a class="thumb" href="assets/slider1/img/2.jpg"></a>
                                    </li>
                                    <li>
                                        <a class="thumb" href="assets/slider1/img/3.jpg"></a>
                                    </li>
                                    <li>
                                        <a class="thumb" href="assets/slider1/img/4.jpg"></a>
                                    </li>
                                    <li>
                                        <a class="thumb" href="assets/slider1/img/5.jpg"></a>
                                    </li>
                                    <li>
                                        <a class="thumb" href="assets/slider1/img/8.jpg"></a>
                                    </li>
                                    <li>
                                        <a class="thumb" href="assets/slider1/img/9.jpg"></a>
                                    </li>
                                    <li>
                                        <a class="thumb" href="assets/slider1/img/10.jpg"></a>
                                    </li>
                                    <li>
                                        <a class="thumb" href="assets/slider1/img/11.jpg"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">                            
                        <button type="button" class="btn btn-primary ss_btn_tab"  data-toggle="modal" data-target="#informationModal">Information</button>
                        <button type="button" class="btn btn-primary ss_btn_tab"  data-toggle="modal" data-target="#helpRightNowModal">Help Right Now</button>
                        <button type="button" class="btn btn-primary ss_btn_tab"  data-toggle="modal" data-target="#copingStategiesModal">Coping Stategies</button>                                                        
                        <button type="button" class="btn btn-primary ss_btn_tab"  data-toggle="modal" data-target="#personalModal">Personal</button>                                                        
                    </div>
                </div>
                <script>
                    var managerSquardId = <?= $squardId; ?>
                </script>
                <div class="col-lg-2" style="margin-top:10px;margin-bottom:10px;">
                    <div class="col-lg-12 text-center" style="margin:10px 0 ;">     
                        <a href="#" class="text-center ss_squard_name" data-toggle="modal" onclick="getManagerSquardDetails()" data-target="#personalSquardModal" ><?= $squardName; ?></a>
                    </div>
                    <?php
                    // GET SQUARD MEMBERS     
                    include './phpConnection.php';
                    $getSquardMembersQry = "CALL getSquardMembers('$squardId')";
                    $getSquardMembers = mysqli_query($conn, $getSquardMembersQry);
                    ?>
                    <input type="hidden" id="selectedSquardMemberId"/>
                    <?php foreach ($getSquardMembers as $getSquardMember): ?>                       
                        <div class="card testimonial-card col-lg-12 btn btn-info" id="card-<?= $getSquardMember['id'] ?>" style="background-color:<?= $getSquardMember['squard_color']; ?>;padding:10px; margin:5px;cursor:pointer;">
                            <label>
                                <?php $cardID = 'card-' . $getSquardMember['id']; ?>
                                <div class="avatar mx-auto white text-center" style="cursor:pointer;" onclick="getSelectedSquardValue(<?= $squardId ?>,<?= $getSquardMember['user_id'] ?>, '<?= $cardID; ?>')" >
                                   <!--<img src="https://mdbootstrap.com/img/Photos/Avatars/img%20%2810%29.jpg" data-toggle="modal" data-target="#squardMemberProfile" onclick="getSquardMemberDetails(<?= $getSquardMember['user_id'] ?>)" for="input_check1" style="height:100px;width:100px;" class="img-thumbnail" alt="Cinque Terre">-->                                                                   
                                    <img src="<?= userProfileImageURL($getSquardMember['profile_image']); ?>" onclick="getSquardMemberDetails(<?= $getSquardMember['user_id'] ?>)" for="input_check1" style="height:100px;width:100px;" class="img-thumbnail" alt="Cinque Terre">                           
                                </div>
                                <!--<input type="radio" name="card" value="1"  id="input_check1" >-->
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
        // GET SQUARD MEMBERS     
        $getCurrentUserId = $_SESSION['currentUserId'];
        $getCurrentDate = date('Y-m-d');
        include './phpConnection.php';
        $getLastSubmittedQry = "SELECT * FROM user_moods WHERE user_id='$getCurrentUserId' AND mood_date='$getCurrentDate'";
        $isMoodRowAvailable = mysqli_query($conn, $getLastSubmittedQry);
        $getAvailableMoodRow = mysqli_fetch_assoc($isMoodRowAvailable);
        $moodSubmissionIsAvailable = '';
        if (!empty($getAvailableMoodRow)):
            $moodSubmissionIsAvailable = 'YES';
        else:
            $moodSubmissionIsAvailable = 'NO';
        endif;


        // CHECK WEEKLY FEED BACK
        $getCurrentWeekStartandEndTime = getStartAndEndDate();
        if (!empty($getCurrentWeekStartandEndTime)):
            $startDate = trim($getCurrentWeekStartandEndTime['start_date']);
            $endDate = trim($getCurrentWeekStartandEndTime['end_date']);
            $getCurrentUserId = $_SESSION['currentUserId'];

            include './phpConnection.php';
            $getSquardMemberQry = "SELECT * FROM squard_member WHERE user_id='$getCurrentUserId'";
            $isSquardIsAvailable = mysqli_query($conn, $getSquardMemberQry);
            $getMemberSquardId = mysqli_fetch_assoc($isSquardIsAvailable);
            $squardMemberId = $getMemberSquardId['id'];

            include './phpConnection.php';
            $getFeedbackSubmitQry1 = "SELECT * FROM members_feedback WHERE (DATE(created_at) BETWEEN DATE('$startDate') AND DATE('$endDate')) AND user_id='$getCurrentUserId'";
            $isFeedBackIsAvailable1 = mysqli_query($conn, $getFeedbackSubmitQry1);
            $getFeedBack = mysqli_fetch_assoc($isFeedBackIsAvailable1);
            $isForThreeDaysEligible = '';
            $isForTodayDaysEligible = '';
            if ($isFeedBackIsAvailable1->num_rows <= 3):
                $isForThreeDaysEligible = 'YES';
                $currentDate = date('Y-m-d');
                $getFeedbackSubmitQry = "SELECT * FROM members_feedback WHERE DATE(created_at)='$currentDate' AND user_id='$getCurrentUserId'";
                $isFeedBackIsAvailable = mysqli_query($conn, $getFeedbackSubmitQry);
                $getFeedBackTody = mysqli_fetch_assoc($isFeedBackIsAvailable);
                if (empty($getFeedBackTody)):
                    $isForTodayDaysEligible = 'NO';
                else:
                    $isForTodayDaysEligible = 'YES';
                endif;
            else:
                $isForThreeDaysEligible = 'No';
            endif;
        endif;

        // GET EVP SUBMISSION     
        $getCurrentUserId = $_SESSION['currentUserId'];
        $getCurrentMonth = date('m');
        $getCurrentYear = date('Y');
        include './phpConnection.php';
        $getLastSubmittedQry = "SELECT * FROM members_evp WHERE user_id='$getCurrentUserId' AND MONTH(date)='$getCurrentMonth' AND YEAR(date)='$getCurrentYear'";
        $isEvpRowAvailable = mysqli_query($conn, $getLastSubmittedQry);
        $getAvailableEvpRow = mysqli_fetch_assoc($isEvpRowAvailable);
        $EvpSubmissionIsAvailable = '';
        if (!empty($getAvailableEvpRow)):
            $EvpSubmissionIsAvailable = 'YES';
        else:
            $EvpSubmissionIsAvailable = 'NO';
        endif;


        // CHECK BDS ONCE PER WEEK
        $getBdsWeekStartandEndTime = getStartAndEndDate();
        if (!empty($getBdsWeekStartandEndTime)):
            $weekBdsStartDate = trim($getBdsWeekStartandEndTime['start_date']);
            $weekBdsEndDate = trim($getBdsWeekStartandEndTime['end_date']);
            $getCurrentUserId = $_SESSION['currentUserId'];

            include './phpConnection.php';
            $getBdsSubmitQry1 = "SELECT * FROM business_drivers_selection WHERE (DATE(date) BETWEEN DATE('$weekBdsStartDate') AND DATE('$weekBdsEndDate')) AND user_id='$getCurrentUserId'";
            $isBdsIsAvailable1 = mysqli_query($conn, $getBdsSubmitQry1);
            $getBds = mysqli_fetch_assoc($isBdsIsAvailable1);

            $isThisWeek = '';
            $isForTodayBdsEligible = '';
            if ($isBdsIsAvailable1->num_rows == 1):
                $isThisWeek = 'YES';
                $currentDate = date('Y-m-d');
                $getBsdSubmitQry = "SELECT * FROM business_drivers_selection WHERE DATE(date)='$currentDate' AND user_id='$getCurrentUserId'";
                $isBdsIsAvailable = mysqli_query($conn, $getBsdSubmitQry);
                $getBdsTody = mysqli_fetch_assoc($isBdsIsAvailable);
                if (empty($getBdsTody)):
                    $isForTodayBdsEligible = 'NO';
                else:
                    $isForTodayBdsEligible = 'YES';
                endif;
            else:
                $isThisWeek = 'NO';
            //                $isForTodayBdsEligible = 'NO';
            endif;

        endif;
        ?>
        <div class="s_container">
            <div class="row my-5">
                <div class="col-md-2"> 
                    <?php if ($moodSubmissionIsAvailable == 'YES'): ?>
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="right" title="Once a Day">
                            <button type="button" class="btn btn-primary my-3 ss_btn_tab" disabled style="width:95%" data-toggle="modal" data-target="#moodSelectionModal">Submit your Mood Now</button>
                        </span>
                    <?php else: ?>
                        <span class="d-inline-block"  tabindex="0" data-toggle="tooltip" data-placement="right" title="Once a Day">
                            <button type="button" class="btn btn-primary my-3 ss_btn_tab" style="width:95%" data-toggle="modal" data-target="#moodSelectionModal">Submit your Mood Now</button>
                        </span>
                    <?php endif; ?>
                    <?php if ($isThisWeek == 'NO' && $isForTodayBdsEligible == 'NO'): ?>                        
                        <span class="d-inline-block" id="bds" tabindex="0" data-toggle="tooltip" data-placement="right" title="Once a Week">
                            <button type="button" class="btn btn-primary my-3 ss_btn_tab" style="width:95%" disabled data-toggle="modal" data-target="#SubmitBDSnow">Submit your BDs Now</button>
                        </span>
                    <?php else: ?>
                        <span class="d-inline-block" id="bds" tabindex="0" data-toggle="tooltip" data-placement="right" title="Once a Week">
                            <button type="button" class="btn btn-primary my-3 ss_btn_tab" style="width:95%" data-toggle="modal" data-target="#SubmitBDSnow">Submit your BDs Now</button>
                        </span>
                    <?php endif; ?>
                    <?php if ($isForThreeDaysEligible == 'YES' && $isForTodayDaysEligible == 'YES'): ?>                        
                        <span class="d-inline-block" id="feedback" tabindex="0"  data-toggle="tooltip" data-placement="right" title="+1every 3 days (Reset Every Month)">
                            <button type="button" class="btn btn-primary my-3 ss_btn_tab" disabled style="width:95%" data-toggle="modal" data-target="#provideFeedbackModals" >Submit a feedback Now</button>                        
                        </span>
                    <?php else: ?>
                        <span class="d-inline-block" id="feedback" tabindex="0" data-toggle="tooltip" data-placement="right" title="+1every 3 days (Reset Every Month)">
                            <button type="button" class="btn btn-primary my-3 ss_btn_tab" style="width:95%" data-toggle="modal" data-target="#provideFeedbackModals" >Submit a feedback Now</button>                        
                        </span>
                    <?php endif; ?>  
                    <?php if ($EvpSubmissionIsAvailable == 'YES'): ?>                        
                        <span class="d-inline-block" id="evp" tabindex="0" data-toggle="tooltip" data-placement="right" title="Once a Month">
                            <button type="button" class="btn btn-primary my-3 ss_btn_tab" disabled style="width:95%" data-toggle="modal" data-target="#evpSelectionsModals" >Submit your EVP Now</button>                        
                        </span>
                    <?php else: ?>
                        <span class="d-inline-block" id="evp" tabindex="0" data-toggle="tooltip" data-placement="right" title="Once a Month">
                            <button type="button" class="btn btn-primary my-3 ss_btn_tab" style="width:95%" data-toggle="modal" data-target="#evpSelectionsModals" >Submit your EVP Now</button>                        
                        </span>
                    <?php endif; ?>  
                </div>
                <div class="col-md-8  text-center">
                    <div class="row">
                        <div class="offset-1 col-md-10">
                            <div class="jumbotron py-1">
                                <br>
                                <h6 class="text-left"><b>Information</b></h6>
                                <br>
                                <br>
                                    <p id="quoteDisplay">"the people who are crazy enough to think they can change the world are the ones who do." <br/>- Steve Jobs</p>
                            <ul>
                                <button onclick="newQuote()">New Quote</button>
                            </ul>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>                                    <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">                            
                </div>
            </div>
        </div>
        <!--  END YOUR CONTAIN PART  -->
    </div>
</div>
<div class="container-fluid footer_bg py-3">
    <?php require './footer.php'; ?>
</div>
<?php require './buttom.php'; ?>
<!--  THIS IS FOR INFORMATION MODEL  -->
<div class="modal fade" id="informationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Informationnnnn</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Anger
                                </a>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="headingTwo">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Anxiety
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="headingThree">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Depression
                                </a>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="heading4">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapseThree">
                                    Self Esteem
                                </a>
                            </h5>
                        </div>
                        <div id="collapse3" class="collapse" role="tabpanel" aria-labelledby="heading4">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="heading5">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapseThree">
                                    Stress
                                </a>
                            </h5>
                        </div>
                        <div id="collapse5" class="collapse" role="tabpanel" aria-labelledby="heading5">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<!--  THIS IS FOR HELP RIGHT NOW MODEL  -->
<div class="modal fade" id="helpRightNowModal" tabindex="-1" role="dialog" aria-labelledby="helpRightNowModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Help Right Now</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="card">
                        <div class="card-header" role="tab" id="helpHeadingOne">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#helpCollapseOne" aria-expanded="true" aria-controls="helpCollapseOne">
                                    Stop!
                                </a>
                            </h5>
                        </div>
                        <div id="helpCollapseOne" class="collapse show" role="tabpanel" aria-labelledby="helpHeadingOne">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="helpHeadingTwo">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#helpCollapseTwo" aria-expanded="false" aria-controls="helpCollapseTwo">
                                    Get Grounded
                                </a>
                            </h5>
                        </div>
                        <div id="helpCollapseTwo" class="collapse" role="tabpanel" aria-labelledby="helpHeadingTwo">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="helpHeadingThree">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#helpCollapseThree" aria-expanded="false" aria-controls="helpCollapseThree">
                                    Breathing Control
                                </a>
                            </h5>
                        </div>
                        <div id="helpCollapseThree" class="collapse" role="tabpanel" aria-labelledby="helpHeadingThree">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="helpHeading4">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#helpCollapse3" aria-expanded="false" aria-controls="helpCollapseThree">
                                    Uplifting Quotes
                                </a>
                            </h5>
                        </div>
                        <div id="helpCollapse3" class="collapse" role="tabpanel" aria-labelledby="helpHeading4">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="helpHeading5">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#helpCollapse5" aria-expanded="false" aria-controls="helpCollapseThree">
                                    Here & Now
                                </a>
                            </h5>
                        </div>
                        <div id="helpCollapse5" class="collapse" role="tabpanel" aria-labelledby="helpHeading5">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="helpHeading6">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#helpCollapse6" aria-expanded="false" aria-controls="helpCollapse6">
                                    Stay in Today
                                </a>
                            </h5>
                        </div>
                        <div id="helpCollapse6" class="collapse" role="tabpanel" aria-labelledby="helpHeading6">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="helpHeading7">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#helpCollapse7" aria-expanded="false" aria-controls="helpCollapse7">
                                    Affirmations
                                </a>
                            </h5>
                        </div>
                        <div id="helpCollapse7" class="collapse" role="tabpanel" aria-labelledby="helpHeading7">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="helpHeading8">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#helpCollapse8" aria-expanded="false" aria-controls="helpCollapse8">
                                    Helpfull Websites
                                </a>
                            </h5>
                        </div>
                        <div id="helpCollapse8" class="collapse" role="tabpanel" aria-labelledby="helpHeading8">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<!--  THIS IS FOR COPING STRATEGIES MODEL  -->
<div class="modal fade" id="copingStategiesModal" tabindex="-1" role="dialog" aria-labelledby="copingStategiesModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Coping Stategies</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="card">
                        <div class="card-header" role="tab" id="copingHeadingOne">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#copingCollapseOne" aria-expanded="true" aria-controls="copingCollapseOne">
                                    Thinking Patterns
                                </a>
                            </h5>
                        </div>
                        <div id="copingCollapseOne" class="collapse show" role="tabpanel" aria-labelledby="copingHeadingOne">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="copingHeadingTwo">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#copingCollapseTwo" aria-expanded="false" aria-controls="copingCollapseTwo">
                                    Metaphors
                                </a>
                            </h5>
                        </div>
                        <div id="copingCollapseTwo" class="collapse" role="tabpanel" aria-labelledby="copingHeadingTwo">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="copingHeadingThree">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#copingCollapseThree" aria-expanded="false" aria-controls="copingCollapseThree">
                                    Manage Worries
                                </a>
                            </h5>
                        </div>
                        <div id="copingCollapseThree" class="collapse" role="tabpanel" aria-labelledby="copingHeadingThree">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header" role="tab" id="copingHeading4">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#copingCollapse4" aria-expanded="false" aria-controls="copingCollapse4">
                                    Positive Steps
                                </a>
                            </h5>
                        </div>
                        <div id="copingCollapse4" class="collapse" role="tabpanel" aria-labelledby="copingHeading4">
                            <div class="card-block">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<!--  THIS IS FOR COPING STRATEGIES MODEL  -->
<div class="modal fade" id="personalSquardModal" tabindex="-1" role="dialog" aria-labelledby="personalSquiredModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Personal</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="container_ss_san">
                    <div class="OverviewOverview py-2 mb-2">Squad Overview</div>
                    <div class="row" id="squardDetailsModel">

                        <div class="col-lg-3 text-center  my-3 ">
                            <div class="borde_right_side_1px">

                                <div class="pb-4 px-3">
                                    <div class="sS_profile my-4">
                                        <img src="http://192.168.0.125:8080/sawan/sentipresim/assets/images/5afe8e34410cab41890a9cde6f4c8641102fd03349e3b5afe8e34410f8.jpeg" />
                                    </div>
                                    <div class="border_1px_solid py-3">
                                        <div class="member_namecsd">Name</div>
                                        <div class="member_name_vdsjk">Oluwarotimi Adesina</div>
                                    </div>
                                    <div class="border_1px_solid py-3">
                                        <div class="member_namecsd">Job Title</div>
                                        <div class="member_name_vdsjk">Head-Chef</div>
                                    </div>
                                    <div class="border_1px_solid height_goals py-3 px-3">
                                        <div class="member_namecsd"> Background</div>
                                        <div class="member_name_vdsjk">The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</div>
                                    </div>
                                    <div class="border_1px_solid height_goals py-3 px-3">
                                        <div class="member_namecsd"> Quote </div>
                                        <div class="member_name_vdsjk">The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</div>
                                    </div>
                                    <div class=" py-3 height_goals px-3">
                                        <div class="member_namecsd"> Goals</div>
                                        <div class="member_name_vdsjk">The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</div>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>                 
                </div>
            </div>
            <div class="modal-footer">

                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<script>
    function getManagerSquardDetails() {
        var squardId = <?= $squardId ?>;
        $('#squardDetailsModel').empty();
        if (squardId) {
            $.ajax({
                url: "ajax/getManagerSquardDetails.php",
                type: "POST",
                data: "squardId=" + squardId,
                success: function (data) {
                    var userData = JSON.parse(data);
                    for (i = 0; i <= userData.length; i++) {
                        $('#squardDetailsModel').append('<div class="col-lg-3 text-center my-3 "> <div class="borde_right_side_1px"> <div class="pb-4 px-3"> <div class="sS_profile my-4"> <img src="' + userData[i]['profile_image'] + '" /> </div> <div class="border_1px_solid py-3"> <div class="member_namecsd">Name</div> <div class="member_name_vdsjk">' + userData[i]['user_fullname'] + '</div> </div> <div class="border_1px_solid py-3"> <div class="member_namecsd">Job Title</div> <div class="member_name_vdsjk">' + userData[i]['title'] + '</div> </div> <div class="border_1px_solid height_goals py-3 px-3"> <div class="member_namecsd"> Background</div> <div class="member_name_vdsjk">' + userData[i]['person_designation'] + '</div> </div> <div class="border_1px_solid height_goals py-3 px-3"> <div class="member_namecsd"> Quote </div> <div class="member_name_vdsjk">' + userData[i]['goals_details'] + '</div> </div> <div class=" py-3 height_goals px-3"> <div class="member_namecsd"> Goals</div> <div class="member_name_vdsjk">' + userData[i]['key_characteristic_details'] + '</div> </div> </div> </div> </div> ');
                    }
                }
            });
        }
    }
</script>
<!-- all members -->
<!--  THIS IS FOR COPING STRATEGIES MODEL  -->
<div class="modal fade" id="allmember" tabindex="-1" role="dialog" aria-labelledby="allmember">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Personal</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                ......
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<!--  THIS IS FOR CURRENT MONTH TOP RATED SQUARD MEMBER  -->
<div class="modal fade" id="showCurrentMonthTopRatedSquard" tabindex="-1" role="dialog" aria-labelledby="showCurrentMonthTopRatedSquard">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Current Month Top Rated Member In <?= $squardName; ?></h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="overflow:auto;height:720px;">
                <div class="row" id="all-Top-Rated-User">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addNewSquardMemberModal" tabindex="-1" role="dialog" aria-labelledby="addNewSquardMemberModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Add New Member In <?= $squardName; ?></h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <?php
            include './phpConnection.php';
            $getAllSquardUser = "SELECT * FROM users WHERE is_joined_to_squard='0' AND login_type='USER' AND user_type='USER'";
            $getUnJoinedUsers = mysqli_query($conn, $getAllSquardUser);
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-3 py-3">
                        <div class="form-group">
                            <h3 class="text-center"><?= $squardName; ?></h3>
                        </div>
                        <div class="form-group">
                            <!--<label>Add New Member</label>-->
                            <select class="form-control" id="getCurrentManagerSelectedUser" onchange="getManagerSelectedUserDetails()">
                                <option>Select Member</option>
                                <?php foreach ($getUnJoinedUsers as $getUnJoinedUser): ?>
                                    <option value="<?= $getUnJoinedUser['id']; ?>"><?= $getUnJoinedUser['user_fullname'] . '  -( ' . $getUnJoinedUser['email'] . ' )' ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <h5 class="text-center">Selected Member Details.</h5>
                            <div class="col-md-12" style="margin-bottom:5px;">
                                <div class="card testimonial-card">
                                    <div class="card-body">
                                        <div class="card-up info-color"></div>
                                        <!--Avatar-->
                                        <div class="avatar mx-auto white text-center" id="manSelectedUserImg" style="margin-top:15px;">
                                            <?php
                                            $imagePath = '/uploads/';
                                            $imageBastPath = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
                                            $imageUrl = $imageBastPath . $imagePath . 'default_image.png';
                                            ?>
                                            <img src="<?= $imageUrl ?>" style="height:170px;width:170px;" class="rounded-circle img-fluid">
                                        </div>
                                        <!--Name-->
                                        <hr>
                                        <h4 class="font-weight-bold mb-4 text-center" id="manSelectedUserName">No Name</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="text-center">
                                <!--<h5 style="color:green;">Added Successfully.</h5>-->                               
                                <button type="button" class="btn btn-primary" onclick="addNewMember()" style="margin-top:10px;">Add Member</button>
                            </h5>
                        </div>
                    </div>
                    <?php
                    include './phpConnection.php';
                    $getAllSquardUser = "SELECT a.*,b.user_fullname,b.title,b.email,b.profile_image FROM squard_member as a JOIN users as b ON a.user_id=b.id WHERE a.squard_id='$squardId' ORDER BY a.created_at DESC LIMIT 15";
                    $getSquardUsers = mysqli_query($conn, $getAllSquardUser);
                    ?>
                    <div class="col-lg-9 py-3">
                        <div class="row" id="managerSquardAllUser" style="overflow:auto;height:700px;">
                            <?php foreach ($getSquardUsers as $getSquardUser): ?>
                                <div class="col-md-3" id="user-<?= $getSquardUser['id'] ?>" style="margin-bottom:5px;">
                                    <div class="card testimonial-card" >
                                        <!--Background color-->
                                        <div class="card-up info-color"></div>
                                        <!--Avatar-->
                                        <div class="avatar mx-auto white" style="margin-top:15px;">
                                            <img src="<?= userProfileImageURL($getSquardUser['profile_image']); ?>" style="height:170px;width:170px;" class="rounded-circle img-fluid">
                                        </div>
                                        <div class="card-body">
                                            <!--Name-->
                                            <hr>
                                            <h4 class="font-weight-bold mb-4 text-center"><?= $getSquardUser['user_fullname'] ?></h4>
                                            <hr>
                                            <h4 class="font-weight-bold mb-4 text-center">
                                                <span class="fa fa-trash-o" onclick="deleteNewMember(<?= $getSquardUser['id'] ?>)" style="color:red;cursor: pointer;"></span>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<script>
    function getManagerSelectedUserDetails() {
        var selectedUserId = $('#getCurrentManagerSelectedUser').val();
        if (selectedUserId) {
            $.ajax({
                url: "ajax/getManagerSquardNewMembers.php",
                type: "POST",
                data: "selectedUserId=" + selectedUserId, success: function (data) {
                    var userData = JSON.parse(data);
                    $('#manSelectedUserImg').html('<img src="' + userData.profile_image + '" class="rounded-circle img-fluid" style="height:170px;width:170px;">');
                    $('#manSelectedUserName').text(userData.user_fullname);
                    console.log(userData);
                    //                    var setCardColor = $('#selectedSquardMemberId').val();
                    //                    $('#' + setCardColor).css("background-color", color.toHexString());
                }
            });
        }
    }
    function addNewMember() {
        var selectedUserId = $('#getCurrentManagerSelectedUser').val();
        if (selectedUserId != 'Select Member') {
            var squardId = <?= $squardId ?>;
            var memberId = selectedUserId;
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to add this member in your squard.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                            });
                            $.ajax({
                                url: "ajax/addManagerSquardNewMembers.php",
                                type: "POST",
                                data: "squardId=" + squardId + "&memberId=" + memberId, success: function (data) {
                                    var userData = JSON.parse(data);
                                    console.log(userData);
                                    $("#getCurrentManagerSelectedUser option[value='" + selectedUserId + "']").remove();
                                    $('#managerSquardAllUser').append('<div class="col-md-3" id="user-' + userData.id + '" style="margin-bottom:5px;"><div class="card testimonial-card" ><div class="card-up info-color"></div><div class="avatar mx-auto white" style="margin-top:15px;"><img src="' + userData.profile_image + '" style="height:170px;width:170px;" class="rounded-circle img-fluid"></div><div class="card-body"><hr><h4 class="font-weight-bold mb-4 text-center">' + userData.user_fullname + '</h4><hr><h4 class="font-weight-bold mb-4 text-center"><span class="fa fa-trash-o" onclick="deleteNewMember(' + userData.id + ')" style="color:red;cursor: pointer;"></span></h4></div></div></div>');
                                    //                                    $('#addNewSquardMemberModal').modal('hide');
                                    //                                    var userData = JSON.parse(data);
                                    //                                    $('#manSelectedUserImg').html('<img src="' + userData.profile_image + '" class="rounded-circle img-fluid" style="height:170px;width:170px;">');
                                    //                                    $('#manSelectedUserName').text(userData.user_fullname);
                                }
                            });
                        } else {
                            swal("Member adding is stop");
                        }
                    });
        } else {
            swal("Please select Member First.");
        }
    }
    function deleteNewMember(memberId) {
        //        var selectedUserId = $('#getCurrentManagerSelectedUser').val();
        //        alert(memberId);
        if (memberId) {
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to delete this member!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Success! Your member Deleted successfully.!", {
                                icon: "success",
                            });
                            $.ajax({
                                url: "ajax/deleteManagerSquardNewMember.php",
                                type: "POST",
                                data: "memberId=" + memberId, success: function (data) {
                                    var userData = JSON.parse(data);
                                    console.log(userData);
                                    console.log(userData['user_fullname']);
                                    console.log(userData.user_fullname);
                                    //                                    var userData = JSON.parse(data);
                                    //                                    $('#manSelectedUserImg').html('<img src="' + userData.profile_image + '" class="rounded-circle img-fluid" style="height:170px;width:170px;">');
                                    //                                    $('#manSelectedUserName').text(userData.user_fullname);


                                    $("#user-" + memberId).remove();
                                    $("#getCurrentManagerSelectedUser").append('<option value="' + userData.id + '">' + userData.user_fullname + ' -( ' + userData.email + ' ) ' + '</option>');
                                    //                                    $('#addNewSquardMemberModal').modal('hide');
                                }
                            });
                        } else {
                            swal("Member adding is stop");
                        }
                    });
        }
    }
</script>
<!--  THIS IS FOR COPING STRATEGIES MODEL  -->
<div class="modal fade" id="Status" tabindex="-1" role="dialog" aria-labelledby="Status">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Status</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="overflow:auto;">
                <div class="row">
                    <div class="col-lg-12 py-3">
                        <div class="row justify-content-center py-4">
                            <div class="col-lg-4 col-8">
                                <div class="input-group ss_heightc">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar-o"></i>
                                    </span>
                                    <input name="daterange" id="daterange" class="form-control" type="text">
                                    <div class="input-group-addon sslvmv">
                                        <a href="#" onclick="getAllStatusChartsData()" class=" btn btn-primary Submit_Ss mx-4">Submit</a>
                                    </div>
                                </div>
                                <!--       <div class="card">
                                   <div class="card-header">
                                       <i class="icon-note"></i> DateRangePicker
                                       <div class="card-actions">
                                           <a >
                                               <small class="text-muted">docs</small>
                                           </a>
                                       </div>
                                   </div>
                                   
                                   <div class="card-body">
                                       <fieldset class="form-group">
                                           
                                           <div class="input-group">
                                               <span class="input-group-prepend">
                                                   <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                               </span>
                                               <input name="daterange" class="form-control" type="text">
                                           </div>
                                       </fieldset>
                                   </div>
                                   
                                   </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="py-4 col-lg-6 px-4 pt-4 pb-5 height_skk ">
                        <div class="row bg_color_f1f11f mx-0">
                            <div class="col-10">
                                <div class="ss_month py-2 my-2 text-left" id="ss_month111">
                                    Monthly Mood Chart
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#" class="fa fa-retweet icon_reseat_map mt-3 float-md-right" id="randomizeData"></a>
                            </div>
                        </div>
                        <div style="width: 100%" class="pt-4 pb-5 ss_dflfb">
                            <div id="curve_chart" style="width: 100%;"></div>
                        </div>
                    </div>
                    <div class="py-4 col-lg-6 px-4 py-4 height_skk " >
                        <div class="row bg_color_f1f11f mx-0">
                            <div class="col-10">
                                <div class="ss_month py-2 my-2 text-left" id="ss_month111">
                                    Monthly Mood Chart
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#" class="fa fa-retweet icon_reseat_map mt-3 float-md-right" id="randomizeData"></a>
                            </div>
                        </div>
                        <div style="width: 100%" class="py-4 ss_dflfb">
                            <div id="donutchart" style="width: 100%;"></div>
                        </div>
                        <!--<div id="container_123" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>-->
                    </div>
                    <div class="py-4 col-lg-6 px-4 py-4 height_skk " >
                        <div class="row bg_color_f1f11f mx-0">
                            <div class="col-10">
                                <div class="ss_month py-2 my-2 text-left" id="ss_month111">
                                    Loliness <?= date('d-m-Y'); ?>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#" class="fa fa-retweet icon_reseat_map mt-3 float-md-right" id="randomizeData"></a>
                            </div>
                        </div>
                        <div style="width: 100%" class="py-4 ss_dflfb">
                            <div id="piechart_3d" style="width: 100%;"></div>
                        </div>
                    </div>
                    <div class="py-4 col-lg-6 px-4 py-4 height_skk" >
                        <div class="row bg_color_f1f11f mx-0">
                            <div class="col-10">
                                <div class="ss_month py-2 my-2 text-left" id="ss_month111">
                                    Average Daily Mood
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#" class="fa fa-retweet icon_reseat_map mt-3 float-md-right" id="randomizeData"></a>
                            </div>
                        </div>
                        <div style="width: 100%" class="py-4 mt-5 ss_dflfb">
                            <div id="barchart_material" style="width: 100%;height: 600px"></div>
                        </div>
                    </div>
                    <!--  <div class="py-4 col-lg-6 px-5 py-4 height_skk " >
                         <div class="row bg_color_f1f11f mx-0">
                             <div class="col-10">
                                 <div class="ss_month py-2 my-2 text-left" id="ss_month111">
                                     Mood Chart
                                 </div>
                             </div>
                             <div class="col-2">
                                 <a href="#" class="fa fa-retweet icon_reseat_map mt-3 float-md-right" id="randomizeData"></a>
                             </div>
                         </div>
                         <div style="width: 100%" class="py-4 ss_dflfb">
                         </div>
                     </div> -->
                </div>
                <!--    <div class="modal-footer py-5">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       <button type="button" class="btn btn-primary">Send message</button>
                   </div> -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getAllStatusChartsData() {
        var selectedDate = $('#daterange').val();
        //        alert(selectedDate);

        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart1);

        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart3);

        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart2);

        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart4);

    }

    function drawChart1() {
        var selectedDate = $('#daterange').val();
        var data = $.parseJSON($.ajax({
            url: "ajax/getMonthlyMoodLineChart.php",
            type: "POST",
            data: "selectedDate=" + selectedDate,
            dataType: "json",
            async: false
        }).responseText);

        console.log(data);

        var data = google.visualization.arrayToDataTable(data);
        var options = {title: 'Monthly Moods',
            curveType: 'function',
            //            legend: {position: 'bottom'},
            width: 700,
            height: 350,
            chartArea: {left: 100},
        };
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
    }

</script>
<script type="text/javascript">
    function drawChart2() {
        //        alert(drawChart2);
        var selectedDate = $('#daterange').val();
        var data = $.parseJSON($.ajax({
            url: "ajax/getDailyMoodPieChart.php",
            type: "POST",
            data: "selectedDate=" + selectedDate,
            dataType: "json",
            async: false
        }).responseText);

        var data = google.visualization.arrayToDataTable(data);
        var options = {title: 'Loliness', is3D: true,
            width: 700,
            height: 350,
            chartArea: {right: 100},
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }

</script>
<script type="text/javascript">
    function drawChart3() {
        //        alert(drawChart3);

        var selectedDate = $('#daterange').val();
        var data = $.parseJSON($.ajax({
            url: "ajax/getMonthlyMoodPieChart.php",
            type: "POST",
            data: "selectedDate=" + selectedDate,
            dataType: "json",
            async: false
        }).responseText);


        var data = google.visualization.arrayToDataTable(data);

        var options = {title: 'Mood Chart',
            pieHole: 0.4,
            width: 700,
            height: 350,
            chartArea: {right: 100, left: 100},
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }

</script>
<script type="text/javascript">
    function drawChart4() {

        var selectedDate = $('#daterange').val();
        var data = $.parseJSON($.ajax({
            url: "ajax/getAverageDailyMoodBarChart.php",
            type: "POST",
            data: "selectedDate=" + selectedDate,
            dataType: "json",
            async: false
        }).responseText);

        var data = google.visualization.arrayToDataTable(data);
        var options = {chart: {title: 'Daily Average Mood',
                subtitle: '1 : NotGivenMood 2: Given Mood',
            }, bars: 'vertical', // Required for Material Bar Charts.
            width: 700,
            height: 350,
            chartArea: {left: 100},
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }

</script>
<!--  SubmitBDSnow  -->
<!--  THIS IS FOR COPING STRATEGIES MODEL  -->
<div class="modal fade" id="businessDriverModel" tabindex="-1" role="dialog" aria-labelledby="businessDriverModel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Business Drivers</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="overflow:auto;">
                <div class="row">
                    <div class="col-lg-12 py-3">
                        <div class="row justify-content-center py-4">
                            <div class="col-lg-4 col-8">
                                <div class="input-group ss_heightc">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar-o"></i>
                                    </span>
                                    <input name="daterange1" id="daterange1" class="form-control" type="text">
                                    <div class="input-group-addon sslvmv">
                                        <a href="#" onclick="getAllBDsChartsData()" class=" btn btn-primary Submit_Ss mx-4">Submit</a>
                                    </div>
                                </div>
                                <!--       <div class="card">
                                   <div class="card-header">
                                       <i class="icon-note"></i> DateRangePicker
                                       <div class="card-actions">
                                           <a >
                                               <small class="text-muted">docs</small>
                                           </a>
                                       </div>
                                   </div>
                                   
                                   <div class="card-body">
                                       <fieldset class="form-group">
                                           
                                           <div class="input-group">
                                               <span class="input-group-prepend">
                                                   <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                               </span>
                                               <input name="daterange" class="form-control" type="text">
                                           </div>
                                       </fieldset>
                                   </div>
                                   
                                   </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="py-4 col-lg-6 px-5 py-4 height_skk " >
                        <div class="row bg_color_f1f11f mx-0">
                            <div class="col-10">
                                <div class="ss_month py-2 my-2 text-left" id="ss_month111">
                                    Current Business Drive Trend
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#" class="fa fa-retweet icon_reseat_map mt-3 float-md-right" id="randomizeData"></a>
                            </div>
                        </div>
                        <div style="width: 100%" class="py-4 ss_dflfb">
                            <div id="barchart_material1" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                    <div class="py-4 col-lg-6 px-5 py-4 height_skk" >
                        <div class="row bg_color_f1f11f mx-0">
                            <div class="col-10">
                                <div class="ss_month py-2 my-2 text-left" id="ss_month111">
                                    Daily Business Drive Trend
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#" class="fa fa-retweet icon_reseat_map mt-3 float-md-right" id="randomizeData"></a>
                            </div>
                        </div>
                        <div style="width: 100%" class="py-4 ss_dflfb">
                            <div id="barchart_material2" style="width: 100%; height: 500px;"></div>
                        </div>
                        <!--<div id="container_123" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>-->
                    </div>
                </div>
                <!--  <div class="modal-footer py-5">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary">Send message</button>
                 </div> -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getAllBDsChartsData() {
        var selectedDate = $('#daterange1').val();
        //        alert(selectedDate);

        google.charts.load("current", {packages: ["bar"]});
        google.charts.setOnLoadCallback(drawChart6);


        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart7);

    }

</script>
<script type="text/javascript">
    function drawChart6() {
        var selectedDate = $('#daterange1').val();
        var data = $.parseJSON($.ajax({
            url: "ajax/getbdstrentBarChart1.php",
            type: "POST",
            data: "selectedDate=" + selectedDate,
            dataType: "json",
            async: false
        }).responseText);

        var data = google.visualization.arrayToDataTable(data);
        var options = {chart: {title: 'Daily Business Drive Trend',
                subtitle: 'Daily Business Drive Trend',
            }, bars: 'vertical', // Required for Material Bar Charts.
            width: 700,
            height: 350,
            chartArea: {left: 100},
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material2'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }

</script>
<script type="text/javascript">
    function drawChart7() {

        var selectedDate = $('#daterange1').val();
        var data = $.parseJSON($.ajax({
            url: "ajax/getbdstrentBarChart.php",
            type: "POST",
            data: "selectedDate=" + selectedDate,
            dataType: "json",
            async: false
        }).responseText);

        var data = google.visualization.arrayToDataTable(data);
        var options = {chart: {title: 'Current Business Drive Trend',
                subtitle: 'Current Business Drive Trend',
            }, bars: 'vertical', // Required for Material Bar Charts.
            width: 700,
            height: 350,
            chartArea: {left: 100},
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material1'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }

</script>
<!--  SubmitBDSnow  -->
<div class="modal fade" id="SubmitBDSnow" tabindex="-1" role="dialog" aria-labelledby="SubmitBDSnow">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">BDs Selection</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="container_ss_san">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h3>BDs Selection</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12  form-box">
                            <form role="form" action="" method="post" class="f2">
                                <!--<h3>Register To Our App</h3>-->
                                <!--<p>Fill in the form to get instant access</p>-->
                                <div class="py-4">
                                    <div class="f2-steps ">
                                        <div class="f2-progress">
                                            <div class="f2-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                                        </div>
                                        <div class="f2-step active">
                                            <div class="f2-step-icon">1</div>
                                            <!--<p>about</p>-->
                                        </div>
                                        <div class="f2-step">
                                            <div class="f2-step-icon">2</div>
                                            <!--<p>account</p>-->
                                        </div>
                                        <div class="f2-step">
                                            <div class="f2-step-icon">3</div>
                                            <!--<p>social</p>-->
                                        </div>
                                    </div>
                                </div>
                                <fieldset class="px-4 py-5">
                                    <hr>
                                    <script>
                                        function bdsQtyFun(arg, type) {
                                            var value = $('#tax' + type).val();
                                            if (arg == 'pls') {
                                                if (value < 5) {
                                                    value++;
                                                    $('#tax' + type).val(value);
                                                    $('#div' + type).append('<div class="position_1" id="sub' + type + value + '"></div>');
                                                } else {
                                                    $('#plus' + type).addClass('disabled');
                                                }
                                                bdsIsSelected();
                                            } else {
                                                if (value == 1) {
                                                    $('#mins' + type).addClass('disabled');
                                                } else {
                                                    var removeDive = "sub" + type + value;
                                                    $("#" + removeDive).remove();
                                                    value--;
                                                    $('#tax' + type).val(value);
                                                }
                                                bdsIsSelected();
                                            }

                                            //                                            var taxQuality = ('#taxQuality').val();
                                            //                                            var taxWork = ('#taxWork').val();
                                            //                                            var taxControl = ('#taxControl').val();
                                            //                                            var taxInnovation = ('#taxInnovation').val();
                                            //                                            var taxLegacy = ('#taxLegacy').val();
                                            //                                            var taxResponsiveness = ('#taxResponsiveness').val();
                                        }
                                    </script>
                                    <div class="row mx-0">
                                        <div class="col-lg-2 col-sm-3 col-12 px-3 py-3">
                                            <div class="ss_bds_selection text-center">
                                                <div class="verticle_centercac">
                                                    Quality
                                                </div>
                                                <input type="hidden" value="1" id="taxQuality">
                                                <div class="position_ab_osm" id="divQuality">
                                                    <div class="position_1" id="subQuality" ></div>
                                                </div>
                                            </div>
                                            <div class="row py-4">
                                                <div class="col-lg-6 col-6">
                                                    <a href="#" id="plusQuality" onclick="bdsQtyFun(
                                                                    'pls', 'Quality');" class="ss_icon_Add">
                                                        <i class=" fa fa-plus icon_add_class"></i>
                                                    </a>
                                                </div>
                                                <div class="col-lg-6 col-6 text-right">
                                                    <a href="#" id="minsQuality" onclick="bdsQtyFun('mns', 'Quality');" class="ss_icon_Add_add">
                                                        <i class=" fa fa-minus icon_add_class"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-3 col-12 px-3 py-3">
                                            <div class="ss_bds_selection text-center">
                                                <div class="verticle_centercac">
                                                    Team-Work
                                                </div>
                                                <input type="hidden" value="1" id="taxWork">
                                                <div class="position_ab_osm" id="divWork">
                                                    <div class="position_1" id="subWork" ></div>
                                                </div>
                                            </div>
                                            <div class="row py-4">
                                                <div class="col-lg-6 col-6">
                                                    <a href="#" id="plusWork" onclick="bdsQtyFun('pls', 'Work');" class="ss_icon_Add">
                                                        <i class=" fa fa-plus icon_add_class"></i>
                                                    </a>
                                                </div>
                                                <div class="col-lg-6 col-6 text-right">
                                                    <a href="#" id="minsWork" onclick="bdsQtyFun('mns', 'Work');" class="ss_icon_Add_add">
                                                        <i class=" fa fa-minus icon_add_class"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-3 col-12 px-3 py-3">
                                            <div class="ss_bds_selection text-center">
                                                <div class="verticle_centercac">
                                                    Control
                                                </div>
                                                <input type="hidden" value="1" id="taxControl">
                                                <div class="position_ab_osm" id="divControl">
                                                    <div class="position_1" id="subControl" ></div>
                                                </div>
                                            </div>
                                            <div class="row py-4">
                                                <div class="col-lg-6 col-6">
                                                    <a href="#" id="plusControl" onclick="bdsQtyFun('pls', 'Control');" class="ss_icon_Add">
                                                        <i class=" fa fa-plus icon_add_class"></i>
                                                    </a>
                                                </div>
                                                <div class="col-lg-6 col-6 text-right">
                                                    <a href="#" id="minsControl" onclick="bdsQtyFun('mns', 'Control');" class="ss_icon_Add_add">
                                                        <i class=" fa fa-minus icon_add_class"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-3 col-12 px-3 py-3">
                                            <div class="ss_bds_selection text-center">
                                                <div class="verticle_centercac">
                                                    Innovation
                                                </div>
                                                <input type="hidden" value="1" id="taxInnovation">
                                                <div class="position_ab_osm" id="divInnovation">
                                                    <div class="position_1" id="subInnovation" ></div>
                                                </div>
                                            </div>
                                            <div class="row py-4">
                                                <div class="col-lg-6 col-6">
                                                    <a href="#" id="plusInnovation" onclick="bdsQtyFun('pls', 'Innovation');" class="ss_icon_Add">
                                                        <i class=" fa fa-plus icon_add_class"></i>
                                                    </a>
                                                </div>
                                                <div class="col-lg-6 col-6 text-right">
                                                    <a href="#" id="minsInnovation" onclick="bdsQtyFun('mns', 'Innovation');" class="ss_icon_Add_add">
                                                        <i class=" fa fa-minus icon_add_class"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-3 col-12 px-3 py-3">
                                            <div class="ss_bds_selection text-center">
                                                <div class="verticle_centercac">
                                                    Legacy
                                                </div>
                                                <input type="hidden" value="1" id="taxLegacy">
                                                <div class="position_ab_osm" id="divLegacy">
                                                    <div class="position_1" id="subLegacy" ></div>
                                                </div>
                                            </div>
                                            <div class="row py-4">
                                                <div class="col-lg-6 col-6">
                                                    <a href="#" id="plusLegacy" onclick="bdsQtyFun('pls', 'Legacy');" class="ss_icon_Add">
                                                        <i class=" fa fa-plus icon_add_class"></i>
                                                    </a>
                                                </div>
                                                <div class="col-lg-6 col-6 text-right">
                                                    <a href="#" id="minsLegacy" onclick="bdsQtyFun('mns', 'Legacy');" class="ss_icon_Add_add">
                                                        <i class=" fa fa-minus icon_add_class"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-3 col-12 px-3 py-3">
                                            <div class="ss_bds_selection text-center">
                                                <div class="verticle_centercac">
                                                    Responsiveness
                                                </div>
                                                <input type="hidden" value="1" id="taxResponsiveness">
                                                <div class="position_ab_osm" id="divResponsiveness">
                                                    <div class="position_1" id="subResponsiveness" ></div>
                                                </div>
                                            </div>
                                            <div class="row py-4">
                                                <div class="col-lg-6 col-6">
                                                    <a href="#" id="plusResponsiveness" onclick="bdsQtyFun('pls',
                                                                    'Responsiveness');" class="ss_icon_Add">
                                                        <i class=" fa fa-plus icon_add_class"></i>
                                                    </a>
                                                </div>
                                                <div class="col-lg-6 col-6 text-right">
                                                    <a href="#" id="minsResponsiveness" onclick="bdsQtyFun('mns',
                                                                    'Responsiveness');" class="ss_icon_Add_add">
                                                        <i class=" fa fa-minus icon_add_class"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="">                                      
                                        <div class="row  justify-content-center" style="margin-top:15px;">
                                            <div class="col-lg-6">
                                                <div class="owl-carousel weev owl-theme ss_theme pt-5 text-center" id="special_2">
                                                    <div class="item py-3" style="border:2px solid black;height:200px;">
                                                        <?= $quata['authoe'] ?>
                                                    </div>
                                                    <div class="item py-3" style="border:2px solid black;height:200px;">
                                                        <?= $quata1['authoe'] ?>
                                                    </div>                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="f2-buttons">
                                        <button type="button" id="isNextBdsButtonIdDisabled" disabled class="btn btn-next">Next</button>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h4>Enter Comments:</h4>
                                    <div class="form-group">
                                        <label class="sr-only" for="">Comment</label>
                                        <textarea name="bds_comment" id="bds_comment" placeholder="Please Enter Comment..." class="form-control" rows="10"></textarea>
                                    </div>
                                    <div class="f2-buttons">
                                        <!--<button type="button" class="btn btn-previous">Previous</button>-->
                                        <button type="button" class="btn btn-next" onclick="isBdsSubmit()" >Submit</button>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group text-center" style="margin-top:10px;">
                                        <span><img src="uploads/completed.png" style="width:25%" ></span>
                                    </div>
                                    <div class="f2-buttons">
                                        <!--                                            <button type="button" class="btn btn-previous">Previous</button>
                                           <button type="submit" class="btn btn-submit">Submit</button>-->
                                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<script>
    function  bdsIsSelected() {

        var taxQuality = $('#taxQuality').val();
        var taxWork = $('#taxWork').val();
        var taxControl = $('#taxControl').val();
        var taxInnovation = $('#taxInnovation').val();
        var taxLegacy = $('#taxLegacy').val();
        var taxResponsiveness = $('#taxResponsiveness').val();
        //    if (mood1IsSelected != null && mood2IsSelected != null && mood3IsSelected != null && mood4IsSelected != null && mood5IsSelected != null) {
        //    $('#isNextButtonIdDisabled').prop('disabled', false);
        //    } else {
        //    $('#isNextButtonIdDisabled').prop('disabled', true);         //    }
        if (taxQuality > 1 || taxWork > 1 || taxControl > 1 || taxInnovation > 1 || taxLegacy > 1 || taxResponsiveness > 1) {
            $('#isNextBdsButtonIdDisabled').prop('disabled', false);
        } else {
            $('#isNextBdsButtonIdDisabled').prop('disabled', true);
        }
    }
    function isBdsSubmit() {
        var taxQuality = $('#taxQuality').val();
        var taxWork = $('#taxWork').val();
        var taxControl = $('#taxControl').val();
        var taxInnovation = $('#taxInnovation').val();
        var taxLegacy = $('#taxLegacy').val();
        var taxResponsiveness = $('#taxResponsiveness').val();
        var getCurrentUserId = '<?= $_SESSION['currentUserId']; ?>';
        var bds_comment = $('#bds_comment').val();
        $.ajax({url: "ajax/addNewBds.php", type: "POST", data: "taxQuality=" + taxQuality + "&taxWork=" + taxWork + "&taxControl=" + taxControl + "&taxInnovation=" + taxInnovation + "&taxLegacy=" + taxLegacy + "&bds_comment=" + bds_comment + "&getCurrentUserId=" + getCurrentUserId + "&taxResponsiveness=" + taxResponsiveness,
            success: function (data) {
                setTimeout(function () {
                    //                                                        $('#moodSelectionModal').addClass('disabled');
                    $('#SubmitBDSnow').modal('hide');
                }, 1000);
            }
        });
    }

</script>
<!--  SQUARD MEMBER DETAILS  -->
<div class="modal fade" id="squardMemberProfile" tabindex="-1" role="dialog" aria-labelledby="squardMemberProfile">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Squard Member Personal Details</h4>
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
                                            <img alt="example image"  src="http://www.venmond.com/demo/vendroid/img/avatar/big.jpg" style="max-width:100px;max-height:100px;"> 
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
                                                    <h3 class="text-muted" id="sq-member-name">Major</h3>
                                                </div>
                                                <div class="col-md-3" style="margin-top:9px;">
                                                    <h6 class="text-muted text-uppercase">Title</h6>
                                                </div>
                                                <!-- /.col-md-6 -->
                                                <div class="col-md-9">
                                                    <h4 class="text-muted" id="sq-member-title" >Here The title</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <h6 class="text-uppercase PREFERENCES_af py-3">BACKGROUND</h6>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <h6 class="text-muted text-uppercase"><span class="fa fa-calendar"></span></h6>
                                                </div>
                                                <div class="col-md-10 left_text_Sss">
                                                    <h6 class="text-muted" id="sq-member-years" >28 Years Old</h6>
                                                </div>
                                                <div class="col-md-2">
                                                    <h6 class="text-muted text-uppercase"><span class="fa fa-user"></span></h6>
                                                </div>
                                                <div class="col-md-10 left_text_Sss">
                                                    <h6 class="text-muted" id="sq-member-desig" >
                                                        Restorent Owner</h4>
                                                </div>
                                                <div class="col-md-2 ">
                                                    <h6 class="text-muted text-uppercase"><span class="fa fa-usd"></span></h6>
                                                </div>
                                                <div class="col-md-10 left_text_Sss">
                                                    <h6 class="text-muted" id="sq-member-income">
                                                        Restorent Owner</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <h6 class="text-uppercase PREFERENCES_af   py-3">TECH PREFERENCES</h6>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <h6 class="text-muted text-uppercase"><span class="fa fa-desktop"></span></h6>
                                                </div>
                                                <div class="col-md-10 left_text_Sss">
                                                    <h6 class="text-muted">
                                                        Windows</h3>
                                                </div>
                                                <div class="col-md-2">
                                                    <h6 class="text-muted text-uppercase"><span class="fa fa-phone"></span></h6>
                                                </div>
                                                <div class="col-md-10 left_text_Sss">
                                                    <h6 class="text-muted">
                                                        iPhone</h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <h6 class="text-muted text-uppercase"><span class="fa fa-book"></span></h6>
                                                </div>
                                                <div class="col-md-10 left_text_Sss">
                                                    <h6 class="text-muted">
                                                        iPad</h4>
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
                                            <h6 id="sq-member-desig-name">
                                                Lives in
                                                <!--<small><p>Enter Description....!</p></small>-->
                                            </h6>
                                            <p class="mr-t-0" id="sq-member-desig-description">
                                                Both words derive from the same Latin word discretus meaning “separated.” Until the 1700s, these words were each spelled many different ways including discrete, discreet, dyscrete, discreete, etc. Eventually discrete and discreet came to be differentiated in spelling as well as in meaning.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    <h4>Key Characteristics</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 id="sq-member-chars-name">
                                                Lives in
                                                <!--<small><p>Enter Description....!</p></small>-->
                                            </h6>
                                            <p class="mr-t-0" id="sq-member-chars-details">
                                                Both words derive from the same Latin word discretus meaning “separated.” Until the 1700s, these words were each spelled many different ways including discrete, discreet, dyscrete, discreete, etc. Eventually discrete and discreet came to be differentiated in spelling as well as in meaning.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    <h4>Goals</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 id="sq-member-goals-name">
                                                Lives in
                                                <!--<small><p>Enter Description....!</p></small>-->
                                            </h6>
                                            <p class="mr-t-0" id="sq-member-goals-description">
                                                Both words derive from the same Latin word discretus meaning “separated.” Until the 1700s, these words were each spelled many different ways including discrete, discreet, dyscrete, discreete, etc. Eventually discrete and discreet came to be differentiated in spelling as well as in meaning.
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<!--  THIS IS FOR COPING STRATEGIES MODEL  -->
<div class="modal fade" id="feedBackModal" tabindex="-1" role="dialog" aria-labelledby="feedBackModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Feedback Interface</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style=" background-color:#f5f5f5;max-height:720px;overflow:auto;">
                <div class="row">
                    <div class="col-md-2">
                        <!--                        <div class="comment span12" style="margin:3px;padding:5px;">                                                                
                           <dl class="dl-horizontal d-flex justify-content-center">                                   
                               <dt>
                                   <img src="uploads/default-avatar1.png" alt="user_auth" class="img-thumbnail" style="width:120px;height:120px;"/>
                               </dt>                                                                                                                                                                                                                                                                                                                       
                           </dl>                                                                
                           </div>-->
                    </div>
                    <div class="col-md-8" id="all-Feedback-Details">
                    </div>
                    <div class="col-md-2">
                        <div class="comment span12" id="allTopRatedUserOfThisSquard" style="margin:3px;padding:5px;">                                
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<script>
    function getFeedbackAllDatas(currentSquardId) {

        var i;
        if (currentSquardId) {
            $('#all-Feedback-Details').empty();
            $.ajax({
                url: "ajax/getAllFeedbackComment.php",
                type: "POST",
                data: "currentSquardId=" + currentSquardId,
                success: function (data) {
                    var feedbackUserData = JSON.parse(data);
                    for (i = 0; i <= feedbackUserData.length; i++) {
                        $('#all-Feedback-Details').append('<div class="comment span12" style="margin:3px;padding:5px;"><dl class="dl-horizontal"> <dt> <img src="https://codeless.co/specular/default/wp-content/plugins/user-avatar/user-avatar-pic.php?src=https://codeless.co/specular/default/wp-content/uploads/avatars/1/1394045391-bpfull.jpg&amp;w=64&amp;id=1&amp;random=1394070590" alt="" class=" avatar avatar-64 photo user-1-avatar" width="64" height="64"> </dt> <dd> <span class="author"><a href="">' + feedbackUserData[i]['feedback_title'] + '</a></span> <div class="comment_text"> ' + feedbackUserData[i]['small_description'] + ' </div> </dd> <hr> <div> <div class="row"> <div class="col-md-1"> <div class="collapsed" data-toggle="collapse" href="#collapse' + i + '" style="padding:3px;"> <span class="badge badge-default fa fa-caret-square-o-down fontawesome_icon" style="padding:7px;">&nbsp;<span class="icon_roboto"> Expands</span></span> </div> </div><div class="col-md-1"> <div class="collapsed" style="padding:3px;margin-left:30px;"> <span class="badge badge-default fa fa-thumbs-o-up" style="padding:7px;"></span> </div> </div> </div> <div id="collapse' + i + '" class="card-body collapse" data-parent="#accordion" > <p>' + feedbackUserData[i]['long_description'] + '</p> </div> </div> </dl> </div>');
//                        $('#all-Feedback-Details').append('<div class="comment span12" style="margin:3px;padding:5px;"><dl class="dl-horizontal"> <dt> <img src="https://codeless.co/specular/default/wp-content/plugins/user-avatar/user-avatar-pic.php?src=https://codeless.co/specular/default/wp-content/uploads/avatars/1/1394045391-bpfull.jpg&amp;w=64&amp;id=1&amp;random=1394070590" alt="" class=" avatar avatar-64 photo user-1-avatar" width="64" height="64"> </dt> <dd> <span class="author"><a href="">' + feedbackUserData[i]['feedback_title'] + '</a></span> <div class="comment_text"> ' + feedbackUserData[i]['small_description'] + ' </div> </dd> <hr> <div> <div class="row"> <div class="col-md-1"> <div class="collapsed" data-toggle="collapse" href="#collapse' + i + '" style="padding:3px;"> <span class="badge badge-default fa fa-caret-square-o-down fontawesome_icon" style="padding:7px;">&nbsp;<span class="icon_roboto"> Expands</span></span> </div> </div><div class="col-md-1"> <div class="collapsed" style="padding:3px;margin-left:30px;"> <span class="badge badge-default fa fa-thumbs-o-up" style="padding:7px;">&nbsp;&nbsp; <span class="icon_roboto" id="isLikedON" onclick="getCommentPopuo(' + feedbackUserData[i]['id'] + ',<?= $currentUserID ?>)">Like</span></span> </div> </div> </div> <div id="collapse' + i + '" class="card-body collapse" data-parent="#accordion" > <p>' + feedbackUserData[i]['long_description'] + '</p> </div> </div> </dl> </div>');
                    }
                }
            });
        }

        if (currentSquardId) {
            $('#allTopRatedUserOfThisSquard').empty();
            $.ajax({
                url: "ajax/getCurrentMonthTopRatedUser.php",
                type: "POST",
                data: "managerCurrentSquardId=" + currentSquardId,
                success: function (data) {
                    var topUserData = JSON.parse(data);
                    $('#allTopRatedUserOfThisSquard').append('<dl class="dl-horizontal d-flex justify-content-center"><dt><h5>Monthly Chart</h5><hr></dt></dl>');
                    for (i = 0; i <= topUserData.length; i++) {
                        $('#allTopRatedUserOfThisSquard').append('<dl class="dl-horizontal d-flex justify-content-center"> <dt> <img src="' + topUserData[i]['profile_image'] + '" alt="user_auth" class="img-thumbnail" style="width:120px;height:120px;"/> </dt> </dl> ');
                    }
                }
            });
        }
    }

    function getCommentPopuo(feedBackId, UserId = NULL) {
        $.ajax({
            url: "ajax/addLike.php",
            type: "POST",
            data: "feedBackId=" + feedBackId + "&UserId=" + UserId,
            success: function (data) {
                likeData = JSON.parse(data);
                if (likeData.is_liked == 1) {
                    $('#isLikedON').text('Liked');
                } else {
                    $('#isLikedON').text('Disliked');
                }
            }
        });
    }

</script>
<!--  THIS IS FOR COPING STRATEGIES MODEL  -->
<div class="modal fade" id="moodSelectionModal" tabindex="-1" role="dialog" aria-labelledby="moodSelectionModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Mood Selection</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="max-height:720px;overflow:auto;">
                <div class="container_ss_san">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12  form-box">
                            <h3>Mood Selection</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12  form-box">
                            <form role="form" action="" method="post" class="f1">
                                <!--<h3>Register To Our App</h3>-->
                                <!--<p>Fill in the form to get instant access</p>-->
                                <div class="py-4">
                                    <div class="f1-steps">
                                        <div class="f1-progress">
                                            <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                                        </div>
                                        <div class="f1-step active">
                                            <div class="f1-step-icon">1</div>
                                            <!--<p>about</p>-->
                                        </div>
                                        <div class="f1-step">
                                            <div class="f1-step-icon">2</div>
                                            <!--<p>account</p>-->
                                        </div>
                                        <div class="f1-step">
                                            <div class="f1-step-icon">3</div>
                                            <!--<p>social</p>-->
                                        </div>
                                    </div>
                                </div>
                                <fieldset class="py-3">
                                    <hr>
                                    <div class="row" style="margin-top:15px;">
                                        <div class="offset-1"></div>
                                        <div class="col-md-2 text-center py-3"> 
                                            <span><img src="uploads/moods/sad-face-in-rounded-square.png" style="width:50%;"></span>
                                        </div>
                                        <div class="col-md-2 text-center py-3">
                                            <span><img src="uploads/moods/sad-sleepy-emoticon-face-square.png" style="width:50%;"></span>
                                        </div>
                                        <div class="col-md-2 text-center py-3">
                                            <span><img src="uploads/moods/emoticon-square-face-with-closed-eyes-and-mouth-of-straight.png" style="width:50%;"></span>
                                        </div>
                                        <div class="col-md-2 text-center py-3">
                                            <span><img src="uploads/moods/smiling-emoticon-square-face.png" style="width:50%;"></span>
                                        </div>
                                        <div class="col-md-2 text-center py-3">
                                            <span><img src="uploads/moods/smiling-happy-emoticon-square-face-with-eyes-like-stars.png" style="width:50%;"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <?php
                                    include './phpConnection.php';
                                    $getMoodQry1 = "SELECT * FROM members_moods WHERE mood_type='MOOD_1' AND is_deleted='0'";
                                    $exGetMoodQrys = mysqli_query($conn, $getMoodQry1);
                                    ?>    
                                    <div class="row" style="margin-top:15px;">
                                        <div class="offset-1"></div>
                                        <div class="col-md-2 text-center" style="padding:0;margin:0;">
                                            <label class="select_mood">Select Your Feel</label>
                                            <select multiple class="form-control" id="isSelectedMood-1" onchange="moodIsSelected()">
                                                <?php foreach ($exGetMoodQrys as $exGetMoodQry): ?>
                                                    <option value="<?= $exGetMoodQry['id'] ?>"><?= $exGetMoodQry['mood_feel'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php
                                        include './phpConnection.php';
                                        $getMoodQry2 = "SELECT * FROM members_moods WHERE mood_type='MOOD_2' AND is_deleted='0'";
                                        $exGetMood2Qrys = mysqli_query($conn, $getMoodQry2);
                                        ?>   
                                        <div class="col-md-2 text-center">
                                            <label class="select_mood">Select Your Feel</label>
                                            <select multiple class="form-control" id="isSelectedMood-2" onchange="moodIsSelected()">
                                                <?php foreach ($exGetMood2Qrys as $exGetMood2Qry): ?>
                                                    <option value="<?= $exGetMood2Qry['id'] ?>"><?= $exGetMood2Qry['mood_feel'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php
                                        include './phpConnection.php';
                                        $getMoodQry3 = "SELECT * FROM members_moods WHERE mood_type='MOOD_3' AND is_deleted='0'";
                                        $exGetMood3Qrys = mysqli_query($conn, $getMoodQry3);
                                        ?> 
                                        <div class="col-md-2 text-center">
                                            <label class="select_mood">Select Your Feel</label>
                                            <select multiple class="form-control" id="isSelectedMood-3" onchange="moodIsSelected()">
                                                <?php foreach ($exGetMood3Qrys as $exGetMood3Qry): ?>
                                                    <option value="<?= $exGetMood3Qry['id'] ?>"><?= $exGetMood3Qry['mood_feel'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php
                                        include './phpConnection.php';
                                        $getMoodQry4 = "SELECT * FROM members_moods WHERE mood_type='MOOD_4' AND is_deleted='0'";
                                        $exGetMood4Qrys = mysqli_query($conn, $getMoodQry4);
                                        ?> 
                                        <div class="col-md-2 text-center">
                                            <label class="select_mood">Select Your Feel</label>
                                            <select multiple class="form-control" id="isSelectedMood-4" onchange="moodIsSelected()">
                                                <?php foreach ($exGetMood4Qrys as $exGetMood4Qry): ?>
                                                    <option value="<?= $exGetMood4Qry['id'] ?>"><?= $exGetMood4Qry['mood_feel'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php
                                        include './phpConnection.php';
                                        $getMoodQry5 = "SELECT * FROM members_moods WHERE mood_type='MOOD_5' AND is_deleted='0'";
                                        $exGetMood5Qrys = mysqli_query($conn, $getMoodQry5);
                                        ?> 
                                        <div class="col-md-2 text-center">
                                            <label class="select_mood">Select Your Feel</label>
                                            <select multiple class="form-control" id="isSelectedMood-5" onchange="moodIsSelected()">
                                                <?php foreach ($exGetMood5Qrys as $exGetMood5Qry): ?>
                                                    <option value="<?= $exGetMood5Qry['id'] ?>"><?= $exGetMood5Qry['mood_feel'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="">
                                        <div class="row  justify-content-center" style="margin-top:15px;">
                                            <div class="col-lg-6">
                                                <div class="owl-carousel owl-theme weev ss_theme pt-5 text-center" id="special_1">
                                                    <div class="item py-4" style="border:2px solid black;height:200px;">
                                                        <?= $quata['authoe'] ?>
                                                    </div>
                                                    <div class="item py-4" style="border:2px solid black;height:200px;">
                                                        <?= $quata2['authoe'] ?>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="f1-buttons">
                                        <button type="button" id="isNextButtonIdDisabled" disabled class="btn btn-next">Next</button>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h4>Enter Comments:</h4>
                                    <div class="form-group">
                                        <label class="sr-only" for="">Comment</label>
                                        <textarea name="mood_comment" id="mood_comment" placeholder="Please Enter Comment..." class="form-control" rows="10"></textarea>
                                    </div>
                                    <div class="f1-buttons">
                                        <!--<button type="button" class="btn btn-previous">Previous</button>-->
                                        <button type="button" class="btn btn-next" onclick="isMoodSubmit()" >Next</button>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group text-center" style="margin-top:10px;">
                                        <span><img src="uploads/completed.png" style="width:25%" ></span>
                                    </div>
                                    <div class="f1-buttons">
                                        <!--                                            <button type="button" class="btn btn-previous">Previous</button>
                                           <button type="submit" class="btn btn-submit">Submit</button>-->
                                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="evpSelectionsModals" tabindex="-1" role="dialog" aria-labelledby="evpSelectionsModals">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">EVP Selection</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="max-height:720px;overflow:auto;">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h3>EVP Selection</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12  form-box">
                            <form role="form" action="" method="post" class="f4">
                                <!--<h3>Register To Our App</h3>-->
                                <!--<p>Fill in the form to get instant access</p>-->
                                <div class="py-4">
                                    <div class="f4-steps">
                                        <div class="f4-progress">
                                            <div class="f4-progress-line" data-now-value="16.67" data-number-of-steps="3" style="width: 16.66%;"></div>
                                        </div>
                                        <div class="f4-step active">
                                            <div class="f4-step-icon">1</div>
                                            <!--<p>about</p>-->
                                        </div>
                                        <div class="f4-step">
                                            <div class="f4-step-icon">2</div>
                                            <!--<p>account</p>-->
                                        </div>
                                        <div class="f4-step">
                                            <div class="f4-step-icon">3</div>
                                            <!--<p>social</p>-->
                                        </div>
                                    </div>
                                </div>
                                <fieldset>
                                    <hr>
                                    <div class="row" style="margin-top:15px;">
                                        <div class="offset-2"></div>
                                        <div class="col-md-2 text-center py-4">
                                            <span class="fa fa-line-chart fa-3x" style="color:black;"></span>
                                            <p>Opportunity</p>
                                        </div>
                                        <div class="col-md-2 text-center py-4">
                                            <span class="fa fa-sitemap fa-3x" style="color:black;"></span>
                                            <p>Orgnization</p>
                                        </div>
                                        <div class="col-md-2 text-center py-4">
                                            <span class="fa fa-users fa-3x" style="color:black;"></span>
                                            <p>People</p>
                                        </div>
                                        <div class="col-md-2 text-center py-4">
                                            <span class="fa fa-briefcase fa-3x" style="color:black;"></span>
                                            <p>Work</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row" style="margin-top:15px;">
                                        <div class="offset-2"></div>
                                        <?php
                                        include './phpConnection.php';
                                        $getEvpQry1 = "SELECT * FROM all_evps WHERE evp_type='OPPORTUNITY' AND is_active='0'";
                                        $exGetEvp1Qrys = mysqli_query($conn, $getEvpQry1);
                                        ?> 
                                        <div class="col-md-2 text-center">
                                            <label class="select_mood">Select EVP</label>
                                            <select multiple class="form-control" id="isSelectedEVP-1" onchange="evpIsSelected()">
                                                <?php foreach ($exGetEvp1Qrys as $exGetEvp1Qry): ?>
                                                    <option value="<?= $exGetEvp1Qry['id'] ?>"><?= $exGetEvp1Qry['evp_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php
                                        include './phpConnection.php';
                                        $getEvpQry2 = "SELECT * FROM all_evps WHERE evp_type='ORGNIZATION' AND is_active='0'";
                                        $exGetEvp2Qrys = mysqli_query($conn, $getEvpQry2);
                                        ?> 
                                        <div class="col-md-2 text-center">
                                            <label class="select_mood">Select EVP</label>
                                            <select multiple class="form-control" id="isSelectedEVP-2" onchange="evpIsSelected()">
                                                <?php foreach ($exGetEvp2Qrys as $exGetEvp2Qry): ?>
                                                    <option value="<?= $exGetEvp2Qry['id'] ?>"><?= $exGetEvp2Qry['evp_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php
                                        include './phpConnection.php';
                                        $getEvpQry3 = "SELECT * FROM all_evps WHERE evp_type='PEOPLE' AND is_active='0'";
                                        $exGetEvp3Qrys = mysqli_query($conn, $getEvpQry3);
                                        ?> 
                                        <div class="col-md-2 text-center">
                                            <label class="select_mood">Select EVP</label>
                                            <select multiple class="form-control" id="isSelectedEVP-3" onchange="evpIsSelected()">
                                                <?php foreach ($exGetEvp3Qrys as $exGetEvp3Qry): ?>
                                                    <option value="<?= $exGetEvp3Qry['id'] ?>"><?= $exGetEvp3Qry['evp_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php
                                        include './phpConnection.php';
                                        $getEvpQry4 = "SELECT * FROM all_evps WHERE evp_type='WORK' AND is_active='0'";
                                        $exGetEvp4Qrys = mysqli_query($conn, $getEvpQry3);
                                        ?> 
                                        <div class="col-md-2 text-center">
                                            <label class="select_mood">Select EVP</label>
                                            <select multiple class="form-control" id="isSelectedEVP-4" onchange="evpIsSelected()">
                                                <?php foreach ($exGetEvp4Qrys as $exGetEvp4Qry): ?>
                                                    <option value="<?= $exGetEvp4Qry['id'] ?>"><?= $exGetEvp4Qry['evp_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="">
                                        <div class="row justify-content-center" style="margin-top:15px;">
                                            <div class="col-lg-6">
                                                <div class="owl-carousel weev owl-theme ss_theme pt-5 text-center" id="special_2">
                                                    <div class="item py-3" style="border:2px solid black;height:200px;">
                                                        vbdbdfbdb
                                                    </div>
                                                    <div class="item py-3" style="border:2px solid black;height:200px;">
                                                        bdfbdb
                                                    </div>
                                                    <div class="item py-3" style="border:2px solid black;height:200px;">
                                                        dbdbnr
                                                    </div>
                                                    <div class="item py-3" style="border:2px solid black;height:200px;">
                                                        dfbdbdf
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="f4-buttons">
                                        <button type="button" id="isNextEVPButtonIdDisabled" disabled class="btn btn-next">Next</button>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <h4>Enter Comments:</h4>
                                    <div class="form-group">
                                        <label class="sr-only" for="">Comment</label>
                                        <textarea name="evp_comment" id="evp_comment" placeholder="Please Enter Comment..." class="form-control" rows="10"></textarea>
                                    </div>
                                    <div class="f4-buttons">
                                        <button type="button" class="btn btn-previous">Previous</button>
                                        <button type="button" class="btn btn-next" onclick="isEvpSubmit()">Next</button>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group text-center" style="margin-top:10px;">
                                        <span><img src="uploads/completed.png" style="width:25%" ></span>
                                    </div>
                                    <!--                                    <div class="f4-buttons">
                                       <button type="button" class="btn btn-previous">Previous</button>
                                       <button type="submit" class="btn btn-submit">Submit</button>
                                       </div>-->
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<!--  HERE THE CODE FOR PROVIDE FEEDBACK -->
<?php
// GET USER SQUARD
include './phpConnection.php';
$currentUserID = $_SESSION['currentUserId'];
$getUserSquard = mysqli_query($conn, "CALL getUserSquard('$currentUserID')");
$getData = mysqli_fetch_assoc($getUserSquard);
$squardName = '';
$squardId = '';
if ($getUserSquard->num_rows > 0):
    $squardName = $getData['squard_name'];
    $squardId = $getData['id'];
else:
    $squardName = 'Squard#';
    $squardId = 0;
endif;

include './phpConnection.php';
$getSquardMembers = mysqli_query($conn, "CALL getSquardMembers('$squardId')");
?>
<div class="modal fade" id="provideFeedbackModals" tabindex="-1" role="dialog" aria-labelledby="provideFeedbackModals">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bffe;">
                <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Provide Feedback</h4>
                <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="max-height:720px;overflow:auto;">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12  form-box">
                            <h3>Provide Feedback</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <span id="selectedSquardMemberImage"><img src="uploads/default-avatar1.png" alt="user_auth" class="img-thumbnail ss_profile_img" style="width:90px;height:90px;"/></span>
                            <p id="selectedSquardMemberName">No Name</p>
                            <input type="hidden" id="selectedSquardsMemberId">
                            <select class="form-control" id="selectedSquardMemberData" onchange="getSquardUserId()">
                                <option value="">Please select member first.</option>
                                <?php foreach ($getSquardMembers as $getSquardMember): ?>
                                    <option value="<?= $getSquardMember['id']; ?>"><?= $getSquardMember['user_fullname']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p style="color:red;" id="verifyMemberSelection" ></p>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <textarea name="mood_comment" id="feedbackTitle" placeholder="Please Enter Short title to your feedback." class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php
                    include './phpConnection.php';
                    $getQuestions1 = mysqli_query($conn, "CALL getFeedbackQuestions('CONTRIBUTION_OR_BEHAVIOUR_IMPACTED')");
                    ?>                        
                    <div class="row">
                        <div class="col-md-3">                               
                        </div>
                        <div class="col-md-6">
                            <label>Contribution or Behaviour impacted</label>
                            <select multiple class="form-control" id="contribution_behaviour">
                                <?php foreach ($getQuestions1 as $getQuestion): ?>
                                    <option value="<?= $getQuestion['id']; ?>"><?= $getQuestion['feed_options']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div data-score="1" style="margin-top:60px;" onclick="getAverageRate()" id="contribution_behaviour_star"></div>
                            <input type="hidden" value="1" id="contribution_behaviour_star_val"/>
                        </div>
                    </div>
                    <hr>
                    <?php
                    include './phpConnection.php';
                    $getQuestions2 = mysqli_query($conn, "CALL getFeedbackQuestions('CONTRIBUTION_IN_THE_ACHIEVEMENT')");
                    ?>  
                    <div class="row">
                        <div class="col-md-3">                               
                        </div>
                        <div class="col-md-6">
                            <label>Contribution on the achievement</label>
                            <select multiple class="form-control" id="contribution_achievement">
                                <?php foreach ($getQuestions2 as $getQuestion): ?>
                                    <option value="<?= $getQuestion['id']; ?>"><?= $getQuestion['feed_options']; ?></option>
                                <?php endforeach; ?>         
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div data-score="1" style="margin-top:60px;" onclick="getAverageRate()" id="contribution_achievement_star"></div>
                            <input type="hidden" value="1" id="contribution_achievement_star_val"/>
                        </div>
                    </div>
                    <hr>
                    <?php
                    include './phpConnection.php';
                    $getQuestions3 = mysqli_query($conn, "CALL getFeedbackQuestions('LEVEL_OF_INITIATIVE_AND_EFFORT')");
                    ?>  
                    <div class="row">
                        <div class="col-md-3">                               
                        </div>
                        <div class="col-md-6">
                            <label>Level of initiative and effort</label>
                            <select multiple class="form-control" id="level_of_initiative_and_effort">
                                <?php foreach ($getQuestions3 as $getQuestion): ?>
                                    <option value="<?= $getQuestion['id']; ?>"><?= $getQuestion['feed_options']; ?></option>
                                <?php endforeach; ?>  
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div data-score="1" style="margin-top:60px;" onclick="getAverageRate()" id="level_of_initiative_and_effort_star"></div>
                            <input type="hidden" value="1" id="level_of_initiative_and_effort_star_val"/>
                        </div>
                    </div>
                    <hr>
                    <?php
                    include './phpConnection.php';
                    $getQuestions4 = mysqli_query($conn, "CALL getFeedbackQuestions('DURATION_OF_CONTRIBUTION')");
                    ?>  
                    <div class="row">
                        <div class="col-md-3">                               
                        </div>
                        <div class="col-md-6">
                            <label>Duration of contribution</label>
                            <select multiple class="form-control" id="duration_of_contribution">
                                <?php foreach ($getQuestions4 as $getQuestion): ?>
                                    <option value="<?= $getQuestion['id']; ?>"><?= $getQuestion['feed_options']; ?></option>
                                <?php endforeach; ?> 
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div data-score="1" style="margin-top:60px;" onclick="getAverageRate()" id="duration_of_contribution_star"></div>
                            <input type="hidden" value="1" id="duration_of_contribution_star_val"/>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">                               
                        </div>
                        <div class="col-md-6">
                            <label>Comments</label>
                            <textarea name="mood_comment" id="feedBackComment" placeholder="Please Enter Short title to your feedback." class="form-control" rows="4"></textarea>
                        </div>
                        <div class="col-md-3">                                     
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">                               
                        </div>
                        <div class="col-md-6">
                            <p id="all_field_validation" style="color:red;"></p>
                            <p id="all_field_validation_succdess" style="color:green;"></p>
                            <button type="button" class="btn btn-default" id="isFeedBackSubmit" onclick="submitFeedBackForm()">Submit</button>
                        </div>
                        <div class="col-md-3">
                            <div data-score="5" style="margin-top:60px;" id="over_all_star"></div>
                            <input type="hidden" value="1" id="over_all_star_val"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>
<script>
    function validateUserEmail() {
        var email = $('#user_email').val();
        $.ajax({url: "ajax/checkEmail.php", type: "POST", data: "email=" + email,
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
<script>
    function  moodIsSelected() {
        var mood1IsSelected = $('#isSelectedMood-1').val();
        var mood2IsSelected = $('#isSelectedMood-2').val();
        var mood3IsSelected = $('#isSelectedMood-3').val();
        var mood4IsSelected = $('#isSelectedMood-4').val();
        var mood5IsSelected = $('#isSelectedMood-5').val();
        //    if (mood1IsSelected != null && mood2IsSelected != null && mood3IsSelected != null && mood4IsSelected != null && mood5IsSelected != null) {
        //    $('#isNextButtonIdDisabled').prop('disabled', false);
        //    } else {
        //    $('#isNextButtonIdDisabled').prop('disabled', true);
        //    }
        if (mood1IsSelected != null || mood2IsSelected != null || mood3IsSelected != null || mood4IsSelected != null || mood5IsSelected != null) {
            $('#isNextButtonIdDisabled').prop('disabled', false);
        } else {
            $('#isNextButtonIdDisabled').prop('disabled', true);
        }
    }

    function isMoodSubmit() {
        var mood1IsSelected = $('#isSelectedMood-1').val();
        var mood2IsSelected = $('#isSelectedMood-2').val();
        var mood3IsSelected = $('#isSelectedMood-3').val();
        var mood4IsSelected = $('#isSelectedMood-4').val();
        var mood5IsSelected = $('#isSelectedMood-5').val();
        var mood_comment = $('#mood_comment').val();
        var getCurrentUserId = '<?= $_SESSION['currentUserId']; ?>';
        $.ajax({url: "ajax/addNewMood.php", type: "POST", data: "mood1IsSelected=" + mood1IsSelected + "&mood2IsSelected=" + mood2IsSelected + "&mood3IsSelected=" + mood3IsSelected + "&mood4IsSelected=" + mood4IsSelected + "&mood5IsSelected=" + mood5IsSelected + "&mood_comment=" + mood_comment + "&getCurrentUserId=" + getCurrentUserId, success: function (data) {
                setTimeout(function () {
                    $('#moodSelectionModal').addClass('disabled');
                    $('#moodSelectionModal').modal('hide');
                }, 1000);
            }
        });
    }
    function isEvpSubmit() {
        var evp1IsSelected = $('#isSelectedEVP-1').val();
        var evp2IsSelected = $('#isSelectedEVP-2').val();
        var evp3IsSelected = $('#isSelectedEVP-3').val();
        var evp4IsSelected = $('#isSelectedEVP-4').val();
        var evp_comment = $('#evp_comment').val();
        var getCurrentUserId = '<?= $_SESSION['currentUserId']; ?>';
        $.ajax({url: "ajax/addNewEvp.php", type: "POST", data: "evp1IsSelected=" + evp1IsSelected + "&evp2IsSelected=" + evp2IsSelected + "&evp3IsSelected=" + evp3IsSelected + "&evp4IsSelected=" + evp4IsSelected + "&evp_comment=" + evp_comment + "&getCurrentUserId=" + getCurrentUserId, success: function (data) {
                setTimeout(function () {
                    $('#evpSelectionsModals').addClass('disabled');
                    $('#evpSelectionsModals').modal('hide');
                }, 1000);
            }
        });
    }

    function  evpIsSelected() {
        var evp1IsSelected = $('#isSelectedEVP-1').val();
        var evp2IsSelected = $('#isSelectedEVP-2').val();
        var evp3IsSelected = $('#isSelectedEVP-3').val();
        var evp4IsSelected = $('#isSelectedEVP-4').val();
        if (evp1IsSelected != null && evp2IsSelected != null && evp3IsSelected != null && evp4IsSelected != null) {
            $('#isNextEVPButtonIdDisabled').prop('disabled', false);
        } else {
            $('#isNextEVPButtonIdDisabled').prop('disabled', true);
        }
    }
</script>
<script>     function hide1(x) {
        x.classList.toggle("change");
        $(".ss_toggle_new").fadeToggle();
    }


    // HERE START SQUARD MEMBER FEEDBACK
    function getSquardUserId() {
        var getUserId = $('#selectedSquardMemberData').val();
        if (getUserId == '') {
            $('#verifyMemberSelection').text('Please select feedback member.');
        } else {
            $('#verifyMemberSelection').text('');
            $.ajax({
                url: "ajax/getSquardMemberData.php",
                type: "POST",
                data: "squardMemberId=" + getUserId, success: function (data) {
                    var setUserData = JSON.parse(data);
                    $('#selectedSquardMemberImage').html('<img src="' + setUserData.profile_image + '" alt="user_auth" class="img-thumbnail ss_profile_img" style="width:90px;height:90px;"/>');
                    $('#selectedSquardMemberName').text(setUserData.user_fullname);
                    $('#selectedSquardsMemberId').val(setUserData.Id);
                    console.log(setUserData);
                }
            });
        }
    }

    function submitFeedBackForm() {
        var getSelectedSquardsMemberId = $('#selectedSquardsMemberId').val();
        if (getSelectedSquardsMemberId != '') {
            var selectedSquardMemberData = $('#selectedSquardMemberData').val();
            if (selectedSquardMemberData != '') {
                var contribution_behaviour = $('#contribution_behaviour').val();
                var level_of_initiative_and_effort = $('#level_of_initiative_and_effort').val();
                var duration_of_contribution = $('#duration_of_contribution').val();
                var contribution_achievement = $('#contribution_achievement').val();
                if (contribution_behaviour == null || level_of_initiative_and_effort == null || duration_of_contribution == null || contribution_achievement == null) {
                    $('#all_field_validation').text('Please fill all field data.');
                } else {
                    $('#all_field_validation').text('');
                    var contribution_behaviour_star_val = parseInt($('#contribution_behaviour_star_val').val());
                    var contribution_achievement_star_val = parseInt($('#contribution_achievement_star_val').val());
                    var level_of_initiative_and_effort_star_val = parseInt($('#level_of_initiative_and_effort_star_val').val());
                    var duration_of_contribution_star_val = parseInt($('#duration_of_contribution_star_val').val());
                    var feedbackTitle = $('#feedbackTitle').val();
                    var feedBackComment = $('#feedBackComment').val();
                    var currentUserId = <?= $_SESSION['currentUserId']; ?>;
                    $.ajax({
                        url: "ajax/addFeedbackData.php",
                        type: "POST",
                        data: "contribution_behaviour=" + contribution_behaviour + "&contribution_behaviour_star_val=" + contribution_behaviour_star_val + "&feedBackComment=" + feedBackComment + "&feedbackTitle=" + feedbackTitle + "&contribution_achievement_star_val=" + contribution_achievement_star_val + "&level_of_initiative_and_effort_star_val=" + level_of_initiative_and_effort_star_val + "&duration_of_contribution_star_val=" + duration_of_contribution_star_val + "&level_of_initiative_and_effort=" + level_of_initiative_and_effort + "&duration_of_contribution=" + duration_of_contribution + "&contribution_achievement=" + contribution_achievement + "&getSelectedSquardsMemberId=" + getSelectedSquardsMemberId + "&currentUserId=" + currentUserId,
                        success: function (data) { //                            alert('success');                             $('#all_field_validation_succdess').text('Your feedback submited successfully.');
                            $('#isFeedBackSubmit').attr('disabled', true);
                            setTimeout(function () {
                                $('#provideFeedbackModals').modal('hide');
                            }, 1000);
                            //                                var setCardColor = $('#selectedSquardMemberId').val();
                            //                                $('#' + setCardColor).css("background-color", color.toHexString());
                        }
                    });
                }

            } else {
                $('#verifyMemberSelection').text('Please select feedback member.');
            }
        } else {
            $('#verifyMemberSelection').text('Please select feedback member.');
        }
    }

    $.fn.raty.defaults.path = 'assets/star_ratings/lib/images';
    $('#contribution_behaviour_star').raty({
        click: function (score, evt) {             //                alert(score);
            $('#contribution_behaviour_star_val').val(score);
        },
        number: 4});
    $('#contribution_achievement_star').raty({
        click: function (score, evt) {             //                alert(score);
            $('#contribution_achievement_star_val').val(score);
        },
        number: 4});
    $('#level_of_initiative_and_effort_star').raty({
        click: function (score, evt) {             //                alert(score);
            $('#level_of_initiative_and_effort_star_val').val(score);
        },
        number: 4});
    $('#duration_of_contribution_star').raty({
        click: function (score, evt) {             //                alert(score);
            $('#duration_of_contribution_star_val').val(score); //                
        },
        number: 4});
    function getAverageRate() {
        var Val14 = parseInt($('#contribution_behaviour_star_val').val());
        var Val24 = parseInt($('#contribution_achievement_star_val').val());
        var Val35 = parseInt($('#level_of_initiative_and_effort_star_val').val());
        var Val46 = parseInt($('#duration_of_contribution_star_val').val());
        var UpdatedValue4 = Val14 + Val24 + Val35 + Val46;
        //            alert(UpdatedValue4);
        $('#over_all_star').raty({
            number: parseFloat(UpdatedValue4) / 4,
            readOnly: true
        });
    }

</script>
<script>
//    var currentUserSquardId = <?= $squardId ?>;
//    $("#preferredHex").spectrum({preferredFormat: "hex",
//        showInput: true,
//        showPalette: true,
//        palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]],
//        change: function (color) {             //                console.log(color.toHexString());
//            var selectedColor = color.toHexString();
//            $.ajax({
//                url: "ajax/selectCard.php",
//                type: "POST",
//                data: "currentUserSquardId=" + currentUserSquardId + "&selectedColor=" + selectedColor + "&colorConst=" + 'SAVECOLOR',
//                success: function (data) {
//                    var setCardColor = $('#selectedSquardMemberId').val();
//                    $('#' + setCardColor).css("background-color", color.toHexString());
//                }
//            });
//        }
//    });
//    

    function getcolorHaxx(color) {
        var currentUserSquardId = <?= $squardId ?>;
        var selectedColor = color;

//        alert(selectedColor);

        $.ajax({
            url: "ajax/selectCard.php",
            type: "POST",
            data: "currentUserSquardId=" + currentUserSquardId + "&selectedColor=" + selectedColor + "&colorConst=" + 'SAVECOLOR',
            success: function (data) {
                var setCardColor = $('#selectedSquardMemberId').val();
                $('#' + setCardColor).css("background-color", color);
            }
        });

    }

    function getSelectedSquardValue(squardId, userId, memberCardId) {
        $('#selectedSquardMemberId').val(memberCardId);
        //            $('#' + memberCardId).css("border", '2px solid black');
        if (squardId != "" && userId != "") {
            $.ajax({
                url: "ajax/selectCard.php",
                type: "POST",
                data: "squardId=" + squardId + "&userId=" + userId, success: function (data) {
                    console.log(data);
                }
            });
        }
    }

    function getSquardMemberDetails(userId) {         //            $('#' + memberCardId).css("border", '2px solid black');

        if (userId != "") {
            $.ajax({
                url: "ajax/getSquardMemberDetails.php",
                type: "POST",
                data: "userId=" + userId, success: function (data) {
                    var UserData = JSON.parse(data);
                    $('#sq-member-image').html('<img alt="example image"  src="' + UserData.profile_image + '" style="max-width:100px;max-height:100px;">');
                    $('#sq-member-name').text(UserData.user_fullname);
                    $('#sq-member-title').text(UserData.title);
                    $('#sq-member-years').text(UserData.years_old);
                    $('#sq-member-desig').text(UserData.business_name);
                    $('#sq-member-income').text(UserData.yearly_income);
                    $('#sq-member-desig-name').text(UserData.person_designation);
                    $('#sq-member-desig-description').text(UserData.person_designation_details);
                    $('#sq-member-chars-name').text(UserData.key_characteristic);
                    $('#sq-member-chars-details').text(UserData.key_characteristic_details);
                    $('#sq-member-goals-name').text(UserData.goals);
                    $('#sq-member-goals-description').text(UserData.goals_details);
                    $('#squardMemberProfile').modal('show');
                    console.log(UserData);
                }
            });
        }
    }


    // ALL MODEL OPENING CODE 
    function informationModel() {
        BootstrapDialog.show({
            message: 'I send ajax request!',
            buttons: [{
                    icon: 'glyphicon glyphicon-send', label: 'Send ajax request',
                    cssClass: 'btn-primary',
                    autospin: true,
                    action: function (dialogRef) {
                        dialogRef.enableButtons(false);
                        dialogRef.setClosable(false);
                        dialogRef.getModalBody().html('Dialog closes in 5 seconds.');
                        setTimeout(function () {
                            dialogRef.close();
                        }, 5000);
                    }
                }, {label: 'Close',
                    action: function (dialogRef) {
                        dialogRef.close();
                    }
                }]
        });
    }

    //  HERE THE ALL SCRIPT FOR BUTTONS
    $('#mood').tooltip('show');
    $('#evp').tooltip('show');
    $('#bds').tooltip('show');
    $('#feedback').tooltip('show');
</script> 
<script>
    function scroll_to_class(element_class, removed_height) {
        var scroll_to = $(element_class).offset().top - removed_height;
        if ($(window).scrollTop() != scroll_to) {
            $('html, body').stop().animate({
                scrollTop: scroll_to
            }, 0);
        }
    }

    function bar_progress(progress_line_object, direction) {
        var number_of_steps = progress_line_object.data('number-of-steps');
        var now_value = progress_line_object.data('now-value');
        var new_value = 0;
        if (direction == 'right') {
            new_value = now_value + (100 / number_of_steps);
        } else if (direction == 'left') {
            new_value = now_value - (100 / number_of_steps);
        }
        progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
    }
    jQuery(document).ready(function () {
        /*
         Fullscreen background
         */
        $.backstretch("assets/img/backgrounds/1.jpg");
        $('#top-navbar-1').on('shown.bs.collapse', function () {
            $.backstretch("resize");
        });
        $('#top-navbar-1').on('hidden.bs.collapse', function () {
            $.backstretch("resize");
        }); /*
         Form
         */
        $('.f1 fieldset:first').fadeIn('slow');
        $('.f1 input[type="text"], .f1 input[type="password"]').on('focus', function () {
            $(this).removeClass('input-error');
        });
        // next step
        $('.f1 .btn-next').on('click', function () {
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            // navigation steps / progress steps
            var current_active_step = $(this).parents('.f1').find('.f1-step.active');
            var progress_line = $(this).parents('.f1').find('.f1-progress-line');
            // fields validation
            parent_fieldset.find('input[type="text"], input[type="password"]').each(function () {
                if ($(this).val() == "") {
                    $(this).addClass('input-error');
                    next_step = false;
                } else {
                    $(this).removeClass('input-error');
                }
            });
            // fields validation
            if (next_step) {
                parent_fieldset.fadeOut(400, function () {
                    // change icons                     current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                    // progress bar
                    bar_progress(progress_line, 'right');
                    // show next step
                    $(this).next().fadeIn();
                    // scroll window to beginning of the form
                    scroll_to_class($('.f1'), 20);
                });
            }
        });
        // previous step
        $('.f1 .btn-previous').on('click', function () {
            // navigation steps / progress steps             var current_active_step = $(this).parents('.f1').find('.f1-step.active');
            var progress_line = $(this).parents('.f1').find('.f1-progress-line');
            $(this).parents('fieldset').fadeOut(400, function () {
                // change icons
                current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
                // progress bar
                bar_progress(progress_line, 'left');
                // show previous step
                $(this).prev().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class($('.f1'), 20);
            });
        });
        // submit
        $('.f1').on('submit', function (e) {
            // fields validation
            $(this).find('input[type="text"], input[type="password"]').each(function () {
                if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
            // fields validation
        });
    });
    function bar_progress1(progress_line_object, direction) {
        var number_of_steps = progress_line_object.data('number-of-steps');
        var now_value = progress_line_object.data('now-value');
        var new_value = 0;
        if (direction == 'right') {
            new_value = now_value + (100 / number_of_steps);
        } else if (direction == 'left') {
            new_value = now_value - (100 / number_of_steps);
        }
        progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
    }
    jQuery(document).ready(function () {
        /*
         Fullscreen background
         */
        $.backstretch("assets/img/backgrounds/1.jpg");
        $('#top-navbar-2').on('shown.bs.collapse', function () {
            $.backstretch("resize");
        });
        $('#top-navbar-2').on('hidden.bs.collapse', function () {
            $.backstretch("resize");
        }); /*
         Form
         */
        $('.f2 fieldset:first').fadeIn('slow');
        $('.f2 input[type="text"], .f2 input[type="password"]').on('focus', function () {
            $(this).removeClass('input-error');
        });
        // next step
        $('.f2 .btn-next').on('click', function () {
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            // navigation steps / progress steps
            var current_active_step = $(this).parents('.f2').find('.f2-step.active');
            var progress_line = $(this).parents('.f2').find('.f2-progress-line');
            // fields validation
            parent_fieldset.find('input[type="text"], input[type="password"]').each(function () {
                if ($(this).val() == "") {
                    $(this).addClass('input-error');
                    next_step = false;
                } else {
                    $(this).removeClass('input-error');
                }
            });
            // fields validation
            if (next_step) {
                parent_fieldset.fadeOut(400, function () {
                    // change icons                     current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                    // progress bar
                    bar_progress1(progress_line, 'right');
                    // show next step
                    $(this).next().fadeIn();
                    // scroll window to beginning of the form
                    scroll_to_class($('.f2'), 20);
                });
            }
        });
        // previous step
        $('.f2 .btn-previous').on('click', function () {
            // navigation steps / progress steps             var current_active_step = $(this).parents('.f2').find('.f2-step.active');
            var progress_line = $(this).parents('.f2').find('.f2-progress-line');
            $(this).parents('fieldset').fadeOut(400, function () {
                // change icons
                current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
                // progress bar
                bar_progress1(progress_line, 'left');
                // show previous step
                $(this).prev().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class($('.f2'), 20);
            });
        });
        // submit
        $('.f2').on('submit', function (e) {
            // fields validation
            $(this).find('input[type="text"], input[type="password"]').each(function () {
                if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
            // fields validation
        });
    });
    function bar_progress3(progress_line_object, direction) {
        var number_of_steps = progress_line_object.data('number-of-steps');
        var now_value = progress_line_object.data('now-value');
        var new_value = 0;
        if (direction == 'right') {
            new_value = now_value + (100 / number_of_steps);
        } else if (direction == 'left') {
            new_value = now_value - (100 / number_of_steps);
        }
        progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
    }
    jQuery(document).ready(function () {
        /*
         Fullscreen background
         */
        $.backstretch("assets/img/backgrounds/1.jpg");
        $('#top-navbar-4').on('shown.bs.collapse', function () {
            $.backstretch("resize");
        });
        $('#top-navbar-4').on('hidden.bs.collapse', function () {
            $.backstretch("resize");
        }); /*
         Form
         */
        $('.f4 fieldset:first').fadeIn('slow');
        $('.f4 input[type="text"], .f4 input[type="password"]').on('focus', function () {
            $(this).removeClass('input-error');
        });
        // next step
        $('.f4 .btn-next').on('click', function () {
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            // navigation steps / progress steps
            var current_active_step = $(this).parents('.f4').find('.f4-step.active');
            var progress_line = $(this).parents('.f4').find('.f4-progress-line');
            // fields validation
            parent_fieldset.find('input[type="text"], input[type="password"]').each(function () {
                if ($(this).val() == "") {
                    $(this).addClass('input-error');
                    next_step = false;
                } else {
                    $(this).removeClass('input-error');
                }
            });
            // fields validation
            if (next_step) {
                parent_fieldset.fadeOut(400, function () {
                    // change icons                     current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                    // progress bar
                    bar_progress3(progress_line, 'right');
                    // show next step
                    $(this).next().fadeIn();
                    // scroll window to beginning of the form
                    scroll_to_class($('.f4'), 20);
                });
            }
        });
        // previous step
        $('.f4 .btn-previous').on('click', function () {
            // navigation steps / progress steps             var current_active_step = $(this).parents('.f4').find('.f4-step.active');
            var progress_line = $(this).parents('.f4').find('.f4-progress-line');
            $(this).parents('fieldset').fadeOut(400, function () {
                // change icons
                current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
                // progress bar
                bar_progress3(progress_line, 'left');
                // show previous step
                $(this).prev().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class($('.f4'), 20);
            });
        });
        // submit
        $('.f4').on('submit', function (e) {
            // fields validation
            $(this).find('input[type="text"], input[type="password"]').each(function () {
                if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
            // fields validation
        });
    });
</script>
<script type="text/javascript">
    $('#special_1').owlCarousel({
        loop: false, margin: 50
        , dots: false
        , loop: false
        , autoplay: 8000
        , autoplayTimeout: 2000
        , nav: true, navText: ["<i class='fa fa-caret-left icon_size'></i>", "<i class='fa fa-caret-right icon_size'></i>"]
        , responsive: {0: {items: 1}
            , 600: {items: 1}, 1000: {items: 1}
            , 1200: {items: 1}
        }
    });
    $('#special_2').owlCarousel({
        loop: false, margin: 50
        , dots: false
        , loop: false
        , autoplay: 8000
        , autoplayTimeout: 2000
        , nav: true, navText: ["<i class='fa fa-caret-left icon_size'></i>", "<i class='fa fa-caret-right icon_size'></i>"]
        , responsive: {0: {items: 1}
            , 600: {items: 1}, 1000: {items: 1}
            , 1200: {items: 1}
        }
    });
    $('#special_3').owlCarousel({
        loop: false, margin: 50
        , dots: false
        , loop: false
        , autoplay: 8000
        , autoplayTimeout: 2000
        , nav: true, navText: ["<i class='fa fa-caret-left icon_size'></i>", "<i class='fa fa-caret-right icon_size'></i>"]
        , responsive: {0: {items: 1}
            , 600: {items: 1}, 1000: {items: 1}
            , 1200: {items: 1}
        }
    });
</script>
<script>     $(function () {
        $("#datepicker").datepicker();
    });
</script>
<!-- chart 1 -->
<script>
    var lineChartData = {labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'], datasets: [{label: 'My First dataset',
                borderColor: window.chartColors.red,
                backgroundColor: window.chartColors.red,
                fill: false,
                data: [randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
                yAxisID: 'y-axis-1',
            }, {label: 'My Second dataset',
                borderColor: window.chartColors.blue,
                backgroundColor: window.chartColors.blue,
                fill: false, data: [randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ],
                yAxisID: 'y-axis-2'
            }]
    };
    window.onload = function () {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = Chart.Line(ctx, {data: lineChartData,
            options: {responsive: true,
                hoverMode: 'index',
                stacked: false, title: {display: true,
                    text: 'Chart.js Line Chart - Multi Axis'
                }, scales: {yAxes: [{
                            type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            display: true,
                            position: 'left',
                            id: 'y-axis-1',
                        }, {type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            display: true,
                            position: 'right',
                            id: 'y-axis-2',
                            // grid line settings
                            gridLines: {drawOnChartArea: false, // only want the grid lines for one axis to show up
                            },
                        }],
                }
            }
        });
    };
    document.getElementById('randomizeData').addEventListener('click', function () {
        lineChartData.datasets.forEach(function (dataset) {
            dataset.data = dataset.data.map(function () {
                return randomScalingFactor();
            });
        });
        window.myLine.update();
    });
</script>
<!-- <script type="text/javascript">
   var timeout = setInterval(reloadChat, 5000);    
       function reloadChat () {
            $('#chart_2').load('Chart_2.php');
       }
   
   </script> -->
</script>
<script type="text/javascript">
    Highcharts.chart('container_123', {chart: {plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {text: 'Browser<br>shares<br>2017',
            align: 'center',
            verticalAlign: 'middle',
            y: 40
        },
        tooltip: {pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {pie: {dataLabels: {enabled: true,
                    distance: -50, style: {fontWeight: 'bold',
                        color: 'white'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }}, series: [{
                type: 'pie',
                name: 'Browser share',
                innerSize: '50%',
                data: [['Chrome', 58.9],
                    ['Firefox', 13.29],
                    ['Internet Explorer', 13],
                    ['Edge', 3.78], ['Safari', 3.42],
                    {
                        name: 'Other',
                        y: 7.61,
                        dataLabels: {enabled: false
                        }
                    }]
            }]
    });



</script>
                                        <script>
//quote array
var quotes = ["Blank", "\"Dude, suckin' at something is the first step at being sorta good at something.\"<br>-  Jake <small><em>(Adventure Time)</em></small>", "\"Either I will find a way, or I will make one.\"<br> - Philip Sidney", "\"Our greatest weakness lies in giving up. The most certain way to succeed is always to try just one more time.\"<br>- Thomas A. Edison", "\"You are never too old to set another goal or to dream a new dream.\"<br>- C.S Lewis", "\"If you can dream it, you can do it.\"<br>- Walt Disney", "\"Never give up, for that is just the place and time that the tide will turn.\"<br>- Harriet Beecher Stowe", "\"I know where I'm going and I know the truth, and I don't have to be what you want me to be. I'm free to be what I want.\"<br>- Muhammad Ali", "\"If you always put limit on everything you do, physical or anything else. It will spread into your work and into your life. There are no limits. There are only plateaus, and you must not stay there, you must go beyond them.\"<br>- Bruce Lee",];

function newQuote() {
    var randomNumber = Math.floor(Math.random() * 8) + 1;
    document.getElementById('quoteDisplay').innerHTML = quotes[randomNumber];
}

</script>
</html>