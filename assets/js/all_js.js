
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
 
        function  moodIsSelected() {
            var mood1IsSelected = $('#isSelectedMood-1').val();
            var mood2IsSelected = $('#isSelectedMood-2').val();
            var mood3IsSelected = $('#isSelectedMood-3').val();
            var mood4IsSelected = $('#isSelectedMood-4').val();
            var mood5IsSelected = $('#isSelectedMood-5').val();

            if (mood1IsSelected != null && mood2IsSelected != null && mood3IsSelected != null && mood4IsSelected != null && mood5IsSelected != null) {
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

            $.ajax({
                url: "ajax/addNewMood.php",
                type: "POST",
                data: "mood1IsSelected=" + mood1IsSelected + "&mood2IsSelected=" + mood2IsSelected + "&mood3IsSelected=" + mood3IsSelected + "&mood4IsSelected=" + mood4IsSelected + "&mood5IsSelected=" + mood5IsSelected + "&mood_comment=" + mood_comment + "&getCurrentUserId=" + getCurrentUserId,
                success: function (data) {
                    setTimeout(function () {
                        $('#moodSelectionModal').addClass('disabled');
                        $('#moodSelectionModal').modal('hide');
                    }, 1000);

                }
            });

        }

        function hide1(x) {
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
                    data: "squardMemberId=" + getUserId,
                    success: function (data) {
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
                            success: function (data) {
                                alert('success');
                                $('#all_field_validation_succdess').text('Your feedback submited successfully.');
                                $('#isFeedBackSubmit').addClass('disabled');
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
            click: function (score, evt) {
//                alert(score);
                $('#contribution_behaviour_star_val').val(score);
            }
        });
        $('#contribution_achievement_star').raty({
            click: function (score, evt) {
//                alert(score);
                $('#contribution_achievement_star_val').val(score);
            }
        });
        $('#level_of_initiative_and_effort_star').raty({
            click: function (score, evt) {
//                alert(score);
                $('#level_of_initiative_and_effort_star_val').val(score);
            }
        });
        $('#duration_of_contribution_star').raty({
            click: function (score, evt) {
//                alert(score);
                $('#duration_of_contribution_star_val').val(score);//                
            }
        });

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

  
        var currentUserSquardId = <?= $squardId ?>;
        $("#preferredHex").spectrum({
            preferredFormat: "hex",
            showInput: true,
            showPalette: true,
            palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]],
            change: function (color) {
                //                console.log(color.toHexString());
                var selectedColor = color.toHexString();
                $.ajax({
                    url: "ajax/selectCard.php",
                    type: "POST",
                    data: "currentUserSquardId=" + currentUserSquardId + "&selectedColor=" + selectedColor + "&colorConst=" + 'SAVECOLOR',
                    success: function (data) {
                        var setCardColor = $('#selectedSquardMemberId').val();
                        $('#' + setCardColor).css("background-color", color.toHexString());
                    }
                });
            }
        });

        function getSelectedSquardValue(squardId, userId, memberCardId) {
            $('#selectedSquardMemberId').val(memberCardId);
            //            $('#' + memberCardId).css("border", '2px solid black');
            if (squardId != "" && userId != "") {
                $.ajax({
                    url: "ajax/selectCard.php",
                    type: "POST",
                    data: "squardId=" + squardId + "&userId=" + userId,
                    success: function (data) {
                        console.log(data);
                    }
                });
            }
        }

        function getSquardMemberDetails(userId) {
            //            $('#' + memberCardId).css("border", '2px solid black');

            if (userId != "") {
                $.ajax({
                    url: "ajax/getSquardMemberDetails.php",
                    type: "POST",
                    data: "userId=" + userId,
                    success: function (data) {
                        var UserData = JSON.parse(data);
                        $('#sq-member-image').html('<img alt="example image"  src="' + UserData.profile_image + '" style="max-width:100px;max-height:100px;">');
                        $('#sq-member-name').text(UserData.user_fullname);
                        $('#sq-member-title').text(UserData.title);
                        $('#sq-member-years').text(UserData.birth_years + ' Years Old');
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
                        icon: 'glyphicon glyphicon-send',
                        label: 'Send ajax request',
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
                    }, {
                        label: 'Close',
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
            });
            /*
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
                        // change icons
                        current_active_step.removeClass('active').addClass('activated').next().addClass('active');
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
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
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
            });
            /*
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
                        // change icons
                        current_active_step.removeClass('active').addClass('activated').next().addClass('active');
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
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f2').find('.f2-step.active');
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




   
        $('#special_1').owlCarousel({
            loop: false
            , margin: 50
            , dots: false
            , loop: false
            , autoplay: 8000
            , autoplayTimeout: 2000
            , nav: true
            , navText: ["<i class='fa fa-caret-left icon_size'></i>", "<i class='fa fa-caret-right icon_size'></i>"]
            , responsive: {
                0: {
                    items: 1

                }
                , 600: {
                    items: 1
                }
                , 1000: {
                    items: 1
                }
                , 1200: {
                    items: 1
                }
            }
        });
        $('#special_2').owlCarousel({
            loop: false
            , margin: 50
            , dots: false
            , loop: false
            , autoplay: 8000
            , autoplayTimeout: 2000
            , nav: true
            , navText: ["<i class='fa fa-caret-left icon_size'></i>", "<i class='fa fa-caret-right icon_size'></i>"]
            , responsive: {
                0: {
                    items: 1

                }
                , 600: {
                    items: 1
                }
                , 1000: {
                    items: 1
                }
                , 1200: {
                    items: 1
                }
            }
        });



   
