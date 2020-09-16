<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <?php require './core_functions.php'; ?>
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
                    <h2>VIEW ALL MANAGER</h2>
                </div>                
                <div class="block-header">
                    <?php
                    $msg = new \Plasticbrain\FlashMessages\FlashMessages();
                    $msg->display();
                    ?>                
                </div>  
                <?php
                include './phpConnection.php';
                $findUserQry = "SELECT * FROM USERS WHERE login_type='MANAGER' AND user_type='MANAGER'";
                $exUserQrys = mysqli_query($conn, $findUserQry);
                ?>
                <!-- Basic Examples -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    BASIC MANAGER
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
                                    <table class="table table-bordered table-striped table-hover js-basic-example">
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
                                                        <?php if ($exUserQry['is_active'] == '0'): ?>
                                                            <a href="#" class="status" id="<?= $exUserQry['id']; ?>"><span class="badge bg-red">Deactive</span></a>
                                                        <?php else: ?>
                                                            <a href="#" class="status1" id="<?= $exUserQry['id']; ?>"><span class="badge bg-green">Active</span></a>
                                                        <?php endif; ?>
                                                        <a href="editManager.php?edit=<?= $exUserQry['id']; ?>"><span class="badge bg-orange">Edit</span></a>
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
            $(document).on('click', '.status1', function (e) {

                var id = $(this).attr("id");
                e.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "It will be deactivate temporary!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, deactivet!',
                    showLoaderOnConfirm: true,

                    preConfirm: function () {
                        return new Promise(function (resolve) {

                            $.ajax({
                                url: 'ajax/status-user.php',
                                type: 'POST',
                                data: 'id=' + id,
                                dataType: 'json'
                            })
                                    .done(function (response) {
                                        swal('Dactivate!', response.message, response.status);
                                    })
                                    .fail(function () {
                                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                                    });
                        });
                    },
                    allowOutsideClick: false
                });
            });
            $(document).on('click', '.status', function (e) {
                var id = $(this).attr("id");
                e.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "It will be activate temporary!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, activate!',
                    showLoaderOnConfirm: true,

                    preConfirm: function () {
                        return new Promise(function (resolve) {

                            $.ajax({
                                url: 'ajax/status-user.php',
                                type: 'POST',
                                data: 'id=' + id,
                                dataType: 'json'
                            })
                                    .done(function (response) {
                                        swal('Activate!', response.message, response.status);
                                    })
                                    .fail(function () {
                                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                                    });
                        });
                    },
                    allowOutsideClick: false
                });
            });
        </script>
    </body>
</html>


