<?php

require_once('./backend/meetingscheduler.php');

   // if(isset($_POST['client_name'])){
        $client_name = $_POST['name'];
        $email = $_POST['email'];
        $staff_name = $_POST['staff_name'];
        $meeting_topics = $_POST['meeting_topics'];
        $meeting_time = $_POST['meeting_time'];
        // $payment_package = $_POST['payment'];
        // $amount_paid = $_POST['okc'];
        // $transaction_ref = $_POST['transaction_ref'];

        // testingxcv
        if ($client_name == null || $client_name == "") {
          $client_nameErr = "Your Full Name is required";
        } else {
          $staff_name = test_input($staff_name);
          }

        if ($email == null || $email == "") {
            $emailErr = "Email is required";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email invalid";
        }

        if ($staff_name == null || $staff_name == "") {
          $staff_nameErr = "Staff Name is required";
        } else {
          $staff_name = test_input($staff_name);
          }
      
        if ($meeting_topics == null || $meeting_topics == "") {
            $meeting_topicsErr = "meeting topic is required";
        } else {
            $meeting_topics = test_input($meeting_topics);
          }
      
        if ($meeting_time == null || $meeting_time == "") {
            $meeting_timeErr = "meeting time is required";
        } else {
            $meeting_time = test_input($meeting_time);
        }
        if (empty($staff_nameErr) && empty($meeting_topicsErr) && empty($meeting_timeErr)) 
        {
            $sql = "INSERT INTO bookings (client_name, email, staff_name, meeting_topics, meeting_time)
            VALUES ( '$client_name', '$email', '$staff_name', '$meeting_topics', '$meeting_time')";
        
        if (mysqli_query($connection, $sql)) {
          
            $from = "victor.ezike@arkounting.com.ng";
            $to = $email;
            $subject = "Meeting Booked";
            $message = "Dear $client_name, \n\n Thank you for Booking a meeting with us. \n \n If you have any questions, you can call us on: 08123456789 \n \n ";
            mail( $to, $subject, $message);
        }else {
          http_response_code(400);
          echo "Error: " . $sql . "<br>" . mysqli_error($connection);        
            } 
        }  

        else {
          $arr = array( 'client_name' => $client_nameErr, 'email' => $emailErr, 'staff_name' => $staff_nameErr, 'meeting_topics' => $meeting_topicsErr, 'meeting_time' => $meeting_timeErr, "status" => 400);
          http_response_code(400);
          echo json_encode( $arr );
        }
          
   //   };

?>
