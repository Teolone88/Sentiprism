/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function showCurrentMonthTopRatedSquardMember(managerSquardId) {
    var managerCurrentSquardId = managerSquardId;
    if (managerCurrentSquardId) {
        $('#all-Top-Rated-User').empty();
        $.ajax({
            url: "ajax/getCurrentMonthTopRatedUser.php",
            type: "POST",
            data: "managerCurrentSquardId=" + managerCurrentSquardId,
            success: function (data) {
                var userData = JSON.parse(data);
                console.log(userData);
                var i;
                for (i = 0; i < userData.length; i++) {
                    $('#all-Top-Rated-User').append('<div class="col-md-3" style="margin-top:10px;"> <div class="card testimonial-card"><div class="card-up info-color"></div> <!--Avatar--> <div class="avatar mx-auto white" style="margin-top:15px;"> <img src="' + userData[i]['profile_image'] + '" style="height:170px;width:170px;" class="rounded-circle img-fluid"> </div> <div class="card-body"><hr><h4 class="font-weight-bold mb-4 text-center">' + userData[i]['user_name'] + '</h4> <hr> <h4 class="font-weight-bold mb-4 text-center"> ' + userData[i]['overall_rating'] + ' </h4> </div> </div> </div>');
                }
            }
        });
    }
}

