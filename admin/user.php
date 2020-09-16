<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <?php require './core_functions.php'; ?>
    <?php checkSession(); ?>    
    <?php require './head.php'; ?>

    <body class="theme-red">
        <?php require './header.php'; ?>

        <!-- #Top Bar -->
        <section>
            <?php require './sidebar.php'; ?>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="block-header">
                    <h2>VIEW ALL TESTIMONIALS</h2>
                </div>                
                <div class="block-header">
                    <?php
                    $msg = new \Plasticbrain\FlashMessages\FlashMessages();
                    $msg->display();
                    ?>                
                </div>            
                <?php
                include './phpConnection.php';
                $findUserQry = "CALL getAllUsers()";
                $exUserQrys = mysqli_query($conn, $findUserQry);
                ?>

                <!-- Basic Examples -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    BASIC EXAMPLE
                                </h2>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="javascript:void(0);">Action</a></li>
                                            <li><a href="javascript:void(0);">Another action</a></li>
                                            <li><a href="javascript:void(0);">Something else here</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Social Id</th>
                                                <th>Phone</th>
                                                <th>Designation</th>
                                                <th>Birth Date</th>
                                                <th>Business Name</th>
                                                <th>USER</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($exUserQrys as $exUserQry): ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $exUserQry['user_fullname']; ?></td>
                                                    <td><?= $exUserQry['email']; ?></td>
                                                    <td><?= $exUserQry['social_user_id']; ?></td>
                                                    <td><?= $exUserQry['phone']; ?></td>
                                                    <td><?= $exUserQry['person_designation']; ?></td>
                                                    <td><?= $exUserQry['birth_date']; ?></td>
                                                    <td><?= $exUserQry['business_name']; ?></td>
                                                    <td><?= $exUserQry['user_type']; ?></td>
                                                    <td>
                                                        <a href="#"><span class="badge bg-red">Deactive</span></a>
                                                        <a href="#"><span class="badge bg-orange">Edit</span></a>
                                                    </td>
                                                </tr>                                           
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Basic Examples -->
            </div>
        </section>

        <?php require './buttom.php'; ?>
        <script>
            $('.js-basic-example').DataTable({
                responsive: true
            });
        </script>
    </body>
</html>