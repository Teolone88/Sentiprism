<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod == 'POST'):
    $userId = @$_POST['userId'];
    if (!empty($userId)):
        include './phpConnection.php';
        $setSquard = mysqli_query($conn, "CALL getUserById('$userId')");
        $getUserDetails = mysqli_fetch_assoc($setSquard);
        if (!empty($getUserDetails)):

            $imageUrl = '';
            if (empty($getUserDetails['profile_image'])):
                $imagePath = '/../uploads/';
                $imageBastPath = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
                $imageUrl = $imageBastPath . $imagePath . 'default-avatar.png';
            else:
                $imagePath = '/../uploads/users/';
                $imageBastPath = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
                $imageUrl = $imageBastPath . $imagePath . $getUserDetails['profile_image'];
            endif;

            $userData = [];
            $userData['Id'] = ((int) $getUserDetails['id']) ? (int) $getUserDetails['id'] : '';
            $userData['user_fullname'] = ($getUserDetails['user_fullname']) ? $getUserDetails['user_fullname'] : '';
            $userData['email'] = ($getUserDetails['email']) ? $getUserDetails['email'] : '';
            $userData['social_user_id'] = ($getUserDetails['social_user_id']) ? $getUserDetails['social_user_id'] : '0';
            $userData['phone'] = ($getUserDetails['phone']) ? $getUserDetails['phone'] : '';
            $userData['title'] = ($getUserDetails['title']) ? $getUserDetails['title'] : '';
            $userData['person_designation'] = ($getUserDetails['person_designation']) ? $getUserDetails['person_designation'] : '';
            $userData['person_designation_details'] = ($getUserDetails['person_designation_details']) ? $getUserDetails['person_designation_details'] : '';
            $userData['key_characteristic'] = ($getUserDetails['key_characteristic']) ? $getUserDetails['key_characteristic'] : '';
            $userData['key_characteristic_details'] = ($getUserDetails['key_characteristic_details']) ? $getUserDetails['key_characteristic_details'] : '';
            $userData['goals'] = ($getUserDetails['goals']) ? $getUserDetails['goals'] : '';
            $userData['goals_details'] = ($getUserDetails['goals_details']) ? $getUserDetails['goals_details'] : '';
            $userData['birth_date'] = ($getUserDetails['birth_date']) ? $getUserDetails['birth_date'] : '';
            $userData['birth_years'] = (calculateAge($getUserDetails['birth_date'])) ? calculateAge($getUserDetails['birth_date']) : '';
            $userData['years_old'] = ($getUserDetails['years_old']) ? $getUserDetails['years_old'] : '';
            $userData['business_name'] = ($getUserDetails['business_name']) ? $getUserDetails['business_name'] : '';
            $userData['yearly_income'] = ($getUserDetails['yearly_income']) ? $getUserDetails['yearly_income'] : '';
            $userData['tech_preferances'] = ($getUserDetails['tech_preferances']) ? $getUserDetails['tech_preferances'] : '';
            $userData['profile_image'] = $imageUrl;
            $userData['average_ratings'] = ($getUserDetails['average_ratings']) ? $getUserDetails['average_ratings'] : '';
            if (!empty($userData)):
                echo json_encode((object) $userData);
            else:
                echo json_encode((object) []);
            endif;
        endif;
    endif;
endif;

function calculateAge($dob) {
    return floor((time() - strtotime($dob)) / 31556926);
}
