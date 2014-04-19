<?php

$freebusy_req = new Google_FreeBusyRequest();
$freebusy_req->setTimeMin(date(DateTime::ATOM, strtotime($date_from)));
$freebusy_req->setTimeMax(date(DateTime::ATOM, strtotime($date_to)));
$freebusy_req->setTimeZone('America/Chicago');
$item = new Google_FreeBusyRequestItem();
$item->setId('{calendarId}');
$freebusy_req->setItems(array($item));
$query = $service->freebusy->query($freebusy_req);
$mycalendars= array("my_calendar_id1@developer.gserviceaccount.com","my_calendar_id2@group.calendar.google.com","my_calendar_id3@group.calendar.google.com");
$freebusy->setItems = $mycalendars;
$createdReq = $service->freebusy->query($freebusy);

echo $createdReq->getKind(); // works
echo $createdReq->getTimeMin(); // works
echo $createdReq->getTimeMax(); // works
$s = $createdReq->getCalendars($diekalender);  
Print_r($s, true); // doesn't show anything

?>