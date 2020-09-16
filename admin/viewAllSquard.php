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
                    <h2>MEMBERS SQUARDS DETAILS</h2>
                </div>                
                <div class="block-header">
                    <?php
                    $msg = new \Plasticbrain\FlashMessages\FlashMessages();
                    $msg->display();
                    ?>                
                </div>                
                <!-- Widgets -->   
                <div class="row clearfix">                    
                    <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    SELECT MANAGER HERE
                                </h2>
                                <ul class="header-dropdown m-r--5">                               
                                </ul>
                            </div>
                            <?php
                            include './phpConnection.php';
                            $findUserQry = "SELECT a.squard_name,a.id as squardId,a.user_id,(SELECT email FROM users WHERE id=a.user_id) as managerEmail FROM squard as a WHERE is_deleted=0;";
                            $exUserQrys = mysqli_query($conn, $findUserQry);
                            ?>
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-5">                                       
                                        <select class="form-control" id="getSquardManagerId" onchange="getAllSquardMemberDetails()">
                                            <option>Please Select Member</option>
                                            <?php foreach ($exUserQrys as $exUserQry): ?>
                                                <option value="<?= $exUserQry['squardId'] ?>"><?= $exUserQry['squard_name'] ?> - ( <?= $exUserQry['managerEmail'] ?> )</option>                                               
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2 id="squardName">
                                    Squard#
                                </h2>

                                <!--                                <ul class="header-dropdown m-r--5">
                                                                    <li class="dropdown">
                                                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="material-icons">more_vert</i>
                                                                        </a>
                                                                        <ul class="dropdown-menu pull-right">
                                                                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                                                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                                                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>-->
                            </div>
                            <div class="body">
                                <div class="row" id="squardMemberListing">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
        </section>
        <script>
            function getAllSquardMemberDetails() {
                var squardManagerId = $('#getSquardManagerId').val();
                $('#squardMemberListing').empty();
                if (squardManagerId) {
                    $.ajax({
                        url: "ajax/getManagerSquardNewMembers.php",
                        type: "POST",
                        data: "getSquardManagerId=" + squardManagerId,
                        success: function (data) { //   
                            var getSquardData = JSON.parse(data);
                            var i;
                            var SquardName = '';
                            for (i = 0; i < getSquardData.length; i++) {
                                SquardName = getSquardData[0]['squard_name']
                                $('#squardMemberListing').append('<div class="col-sm-6 col-md-3"> <div class="thumbnail"> <img style="width:500px;height:300px;" src="' + getSquardData[i]['profile_image'] + '"> <div class="caption"> <h3>' + getSquardData[i]['user_fullname'] + '</h3> <p> ' + getSquardData[i]['person_designation_details'] + ' </p> <hr> <p> <h2> ' + getSquardData[i]['title'] + ' </h2> </p> </div> </div> </div>');
                            }
                            $('#squardName').text(SquardName);
                        }
                    });
                }
            }
        </script>
        <?php require './buttom.php'; ?>
    </body>
</html>