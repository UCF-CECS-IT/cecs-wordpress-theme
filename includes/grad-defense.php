<?php 

function grad_defense_connection() {
    return mysqli_connect("localhost","defenseview","5Yu#TBQsmgvRkkN","graddef");
}

function grad_defense_start_date() {
    return date( "Y-m-d 00:00:00", time() );
}

function get_grad_defenses( $connection, $start ) {
    return mysqli_query($connection,"SELECT * FROM `submissions` WHERE Approved = 'Yes' AND Date >= '$start' ORDER BY Date asc");
}

function grad_defenses_build_array( $result ) {
    $submissionArray = [];

    while( $row = mysqli_fetch_assoc($result) ) {
        $defenseDate = date( "M j Y", strtotime( $row['date'] ) );

        $submissionArray[$defenseDate][] = array(
            'ID' => $row['ID'],
            'date' => $row['date'],
            'department' => $row['department'],
            'fname' => $row['fname'],
            'lname' => $row['lname'],
        ); 
    }

    return $submissionArray;
}