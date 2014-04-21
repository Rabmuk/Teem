<?php
/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
include_once "templates/base.php";
session_start();

set_include_path("../src/" . PATH_SEPARATOR . get_include_path());
require_once 'Google/Client.php';
require_once 'Google/Service/Calendar.php';

/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/
 $client_id = '725388779886-qj9g8a3flqtlib212svpt0siskhmqirg.apps.googleusercontent.com';
 $client_secret = 'CP66xoPSvItVo_sak3SrPz0N';
 $redirect_uri = 'http://www.rabserver.com/teem/public/API/examples/user-example.php';

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/

$client = new Google_Client();
$client->setApplicationName("Web Science Application");
$client->setClientId('725388779886-qj9g8a3flqtlib212svpt0siskhmqirg.apps.googleusercontent.com');
$client->setClientSecret('CP66xoPSvItVo_sak3SrPz0N');
$client->setRedirectUri('http://www.rabserver.com/teem/public/API/examples/user-example.php');
$service = new Google_Service_Calendar($client);

#$service = new Google_Service_Books($client);


/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
/*$service = new Google_Service_Urlshortener($client);*/
/*$service = new Google_CalendarService($client);*/

/* later on we will need to read these dates in from user input in some manner */

/************************************************
  If we're logging out we just need to clear our
  local access token in this case
 ************************************************/
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
 ************************************************/
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

/************************************************
  If we're signed in and have a request to shorten
  a URL, then we create a new URL object, set the
  unshortened URL, and call the 'insert' method on
  the 'url' resource. Note that we re-store the
  access_token bundle, just in case anything
  changed during the request - the main thing that
  might happen here is the access token itself is
  refreshed if the application has offline access.
 ************************************************/
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