<?php
/**
 * Created by PhpStorm.
 * Date: 16-10-2014
 * Time: 03:41
 */

/*
 * maak connectie met de database
 *
 * @param $server - de server waar sql op draait
 * @param $user - de gebruiker
 * @param $pass - het wachtwoord
 * @param $db - het database
 */
function connect($server = "localhost", $user = "root", $pass = "", $db = "Eatit") {
    $connection = mysqli_connect($server, $user, $pass, $db);

    if (mysqli_connect_errno()) {
        die("Kon geen connectie maken met de database!");
    }
    return $connection;
}

/*
 * Test of een query rijen bevat
 *
 * @param $result - het resultaat van een query
 * @return true als er resultaat is
 */
function checkForResult($result){
    return mysqli_num_rows($result) == 0 ? false : true;
}

/*
 * Verkrijg een array uit het resultaat van een query
 *
 * @param $result - het resultaat van een query
 * @return array met alle rijen verkregen uit het resultaat
 */
function getResultArray($result) {
    $rows = Array( );

    while ($row = mysqli_fetch_assoc($result)) {
        array_push( $rows, $row );
    }

    return $rows;
}

?>