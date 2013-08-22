<?php
/* Author: Gowtham */
require "${_SERVER['DOCUMENT_ROOT']}/conf.php";
if($_POST['SESSION_ID']){
    session_id($_POST['SESSION_ID']);
}
session_start();
$_SESSION['lastSessionStartTime'] = $_SESSION['sessionStartTime'];
$_SESSION['sessionStartTime'] = time();
if ($_SESSION['authenticated']) {
    if ($_SESSION['lastSessionStartTime'] < ($_SESSION['sessionStartTime'] - 3000)) {
        include '../signOut.php';
        die();
    }
} else {
    header('Content-Type: text/xml');
    header('Cache-Control: no-cache');
    header('Cache-Control: no-store', false);
    die("<root><status>signedOut</status><info>authorization needed</info></root>");
}
if($_POST['role'] and $_POST['role']!='INDIVIDUAL'){
    $_SESSION['oid']=$_POST['role'];
}
?>
