<?php
// Download the File
$ics_data = "BEGIN:VCALENDAR\n";
$ics_data .= "VERSION:2.0\n";
$ics_data .= "METHOD:PUBLISH\n";
$ics_data .= "X-WR-CALNAME:BRSC_Diary_2020\n";
$ics_data .=  "BEGIN:VTIMEZONE\n";
$ics_data .=  "TZID:GMT Standard Time\n";
$ics_data .=  "END:VTIMEZONE\n";


$filea=fopen("BRSC_Calendar.csv","r");
$file_line=fgets($filea);  //get the header line
while (!feof($filea)){
		$file_line=fgets($filea);
		$a=explode(",",$file_line);
$id = $a[0];
$start_date =$a[1];
$start_time = $a[2];
$end_date = $a[3];
$end_time = $a[4];
$name = $a[5];
$location = $a[6];
$description = $a[7];

//Replace HTML tags
$search = array("/<br>/","/&amp;/","/&rarr;/","/&larr;/","/,/","/;/");
$replace = array("\\n","&","-->","<--","\\,","\\;"); 

$name = preg_replace($search, $replace, $name);
$location = preg_replace($search, $replace, $location);
$description = preg_replace($search, $replace, $description);
//Append to file
$ics_data .= "BEGIN:VEVENT\n";
$ics_data .= "CLASS:PUBLIC\n";
$ics_data .= "DTSTART:".$start_date."T".$start_time."\n";
$ics_data .= "DTEND:" . $end_date . "T" . $end_time . "\n";
$ics_data .= "DTSTAMP:" . date('Ymd') . "T" . date('His') . "\n";
$ics_data .= "LOCATION:" . $location . "\n";
$ics_data .= "DESCRIPTION:" . $description . "\n";
$ics_data .= "SUMMARY:" . $name . "\n";
$ics_data .= "UID:" . $id . "\n";
$ics_data .= "SEQUENCE:0\n";
$ics_data .= "END:VEVENT\n";
}
fclose($filea);
$ics_data .= "END:VCALENDAR\n";
$filename = "BRSC_calendar.ics";
header("Content-type:text/calendar");
header("Content-Disposition: attachment; filename=$filename");
echo $ics_data;
exit;
?>