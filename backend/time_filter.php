<?php
       
       require_once('meetingscheduler.php');

    $staff_selection =  $_POST['staff_name'];

    $time_filter = "SELECT staff_to_time.* , meeting_time.* FROM staff_to_time INNER JOIN meeting_time ON staff_to_time.time_id = meeting_time.id WHERE staff_to_time.time_id = '" . $staff_selection ."'";

    $time_result =  mysqli_query( $connection, $time_filter);
    $return_arr =  array();

    if( mysqli_num_rows($time_result) > 0 ){
        
        //output data
        while( $rows = mysqli_fetch_assoc($time_result) ){
            $return_arr[] = array( "id"=>$rows['id'], "meeting_time"=>$rows['meeting_time']);
        };
            $new_array[] = array("data"=>$return_arr);
            echo json_encode($return_arr) ;       
    }else{
        echo "data not found.";
    }

?>