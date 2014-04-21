<?php
error_reporting(E_ALL);
set_include_path("../src/" . PATH_SEPARATOR . get_include_path());
require_once 'Google/Client.php';
require_once 'Google/Service/Calendar.php';
session_start();

if ((isset($_SESSION)) && (!empty($_SESSION))) {
   echo "There are cookies<br>";
   echo "<pre>";
   print_r($_SESSION);
   echo "</pre>";
}

 $client_id = '725388779886-qj9g8a3flqtlib212svpt0siskhmqirg.apps.googleusercontent.com';
 $client_secret = 'CP66xoPSvItVo_sak3SrPz0N';
 $redirect_uri = 'http://www.rabserver.com/teem/public/API/examples/userexample3.php';


/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("POST https://www.googleapis.com/calendar/v3/freeBusy");
$service = new Google_Service_Calendar($client);

if (isset($_GET['logout'])) {
  echo "<br><br><font size=+2>Logging out</font>";
  unset($_SESSION['token']);
}

if (isset($_GET['code'])) {
  echo "<br>I got a code from Google = ".$_GET['code']; // You won't see this if redirected later
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
  echo "<br>I got the token = ".$_SESSION['token']; // <-- not needed to get here unless location uncommented
}

if (isset($_SESSION['token'])) {
  echo "<br>Getting access";
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()){

  $date_from = '2014-02-21T02:30:00Z';
  $date_to = '2014-02-21T17:00:00Z';


  $freebusy_req = new Google_Service_Calendar_FreeBusyRequest();
  $freebusy_req->setTimeMin(date(DateTime::ATOM, strtotime($date_from)));
  $freebusy_req->setTimeMax(date(DateTime::ATOM, strtotime($date_to)));
  $freebusy_req->setTimeZone('America/Albany');
  $item = new Google_Service_Calendar_FreeBusyRequestItem();
  $item->setId('{calendarId}');
  $freebusy_req->setItems(array($item));
  $query = $service->freebusy->query($freebusy_req);

  echo $createdReq->getKind(); // works
  echo $createdReq->getTimeMin(); // works
  echo $createdReq->getTimeMax(); // works
  $s = $createdReq->getCalendars($diekalender);  
  Print_r($s, true); // doesn't show anything


  echo "<hr><br><font size=+1>Already connected</font> (No need to login)";

} else {

  $authUrl = $client->createAuthUrl();
  print "<hr><br><font size=+2><a href='$authUrl'>Connect Me!</a></font>";

}

$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
echo "<br><br><font size=+2><a href=$url?logout>Logout</a></font>";

?>