<?php

    require_once('meetingscheduler.php');

    if( isset($_POST['staff_name']) ) {
    $staff_selection =  $_POST['staff_name'];
    
    $topic_filter = "SELECT staff_to_topic.*, meeting_topics.*  FROM staff_to_topic INNER JOIN meeting_topics ON staff_to_topic.topic_id = meeting_topics.id WHERE staff_to_topic.staff_id = '" . $staff_selection ."'";

    $topic_results = mysqli_query( $connection, $topic_filter);
    $return_arr =  array();

    if( mysqli_num_rows($topic_results) > 0 ){
            
        //output data
        while( $rows = mysqli_fetch_assoc($topic_results) ){
            $return_arr[] = array( "id"=>$rows['id'], "meeting_topics"=>$rows['meeting_topics']);
        };
            $new_array[] = array("data"=>$return_arr);
            echo json_encode($return_arr) ;       
    }else{
        echo "data not found.";
    }
    }
?>