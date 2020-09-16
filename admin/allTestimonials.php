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
                $findTestimonialsQry = "CALL getAllTestimonialsForAdmin()";
                $exTestimonialsQrys = mysqli_query($conn, $findTestimonialsQry);
                ?>

                <!-- Basic Examples -->
                <div class="row clearfix">
                    <?php foreach ($exTestimonialsQrys as $exTestimonialsQry): ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <?= $exTestimonialsQry['testimonial_name']; ?>
                                    </h2>
                                    <ul class="header-dropdown m-r--5">
                                        <li class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">more_vert</i>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="editTestimonials.php?testiId=<?= base64_encode($exTestimonialsQry['id']); ?>">Edit</a></li>
                                                <!--<li><a href="javascript:void(0);">Something else here</a></li>-->
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body" style="padding-bottom:0px;">
                                    <div class="row">
                                        <?php $imageUrl = testimonialsProfileImageURL($exTestimonialsQry['testimonial_image']); ?>
                                        <div class="col-md-4 text-center">
                                            <img src="<?= $imageUrl ?>" class="img-thumbnail img-responsive" style="max-width:100%;max-height:100%;">
                                            <p style="margin:5px;">
                                                <?php if ($exTestimonialsQry['is_active'] == 1): ?>
                                                    <button type="button" class="btn btn-success waves-effect">ACTIVE</button>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-danger waves-effect">DEACTIVE</button>
                                                <?php endif; ?>
                                            </p>
                                        </div>                                
                                        <div class="col-md-8" style="overflow:auto;max-height:130px;">
                                            <?= $exTestimonialsQry['testimonial_description']; ?>
                                        </div>                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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