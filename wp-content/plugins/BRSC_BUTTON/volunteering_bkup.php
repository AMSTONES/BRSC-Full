<?php

echo("<!DOCTYPE html><html><head><TITLE>VOLUNTEERING</TITLE></head><body>");
echo("<p>OK  HERE</p>");
echo("</table></BODY></HTML>");
?>
<?php
function Get_BRSC_data() {
//**********************************************************************
//
// get data about how many positions are filled and how many are left to fill
//
//**********************************************************************
$fileb=fopen("BRSC_ROLES_NUM.csv","r") or die("Unable to Open File");
$roles_file[0]=fgets($fileb); //Get first file line with the roles
$a=explode(",",$roles_file[0]); //get the role nme from the first line
//----------------------------------------------------------------------
//Check which role is being selected 
//If role has been entered check which col_num
//----------------------------------------------------------------------
for ($j=2; $j<=8; $j++) {
 $what_role[$j]=$a[$j];
     if (Strcmp($what_role[$j],@$_GET["what_for"])==0) { 
 			$update_col=$j; //this is the required role column position in the string
														}
 						}//end for $j
//----------------------------------------------------------------------------
//Now get the rest of the file data and note the location of the required event (update_row) using its ID
//If it is the required ID also collect the role information (num_role[$j]) using columnn from role match above
//----------------------------------------------------------------------------
 $k=0;
 while (!feof($fileb)){
		$roles_file[$k]=fgets($fileb);
		$a=explode(",",$roles_file[$k]);
		
		if (floor($a[0])==floor(@$_GET["id"])) { //check this id for which roles are filled
			$update_row=$k;  // this is the row that will need to be updated
				for ($j=2; $j<=8; $j++) {
					$num_role[$j]=floor($a[$j]); //get the numbers required for this role
										}
												}
		$k=$k+1; // update the row count
 						 }//end while 
$roles_line_num=$k-1;  //note the line number for the event ID
fclose($fileb);

//***********************************************
//CHECK IF THE FORM HAS BEEN SUNMITTED
//*****************************************************
if (strlen(@$_GET["email_string"])>5) {  //if email and role sections are completed 
 		if (strlen(@$_GET["what_for"])!=11) {
 //Update the roles file first
		$fileb=fopen("BRSC_ROLES_NUM.csv","w");
//Adjust the line where the role has been taken
		$update_row=@$_GET["update_row"];
 
		$a=explode(",",$roles_file[$update_row]);
		$a[$update_col]=$a[$update_col]-1;
		$roles_file[$update_row]=$a[0];
			for ($i=1; $i<=Count($a)-1; $i++) {
				$roles_file[$update_row]=$roles_file[$update_row].",".$a[$i];
											 }//end for loop 
//Now write the new file
			for ($k=0; $k<=$roles_line_num; $k++) {
			fwrite($fileb,$roles_file[$k]);
											    }//end for loop
		fclose($fileb); 
//**********************************************************************
//Now add the volunteering to the  ROTA
//**********************************************************************
		$filea=fopen("BRSC_SAFETY_ROTA_VOLUNTEERS.csv","w");
		fwrite($filea,@$_GET["id"].",".request.querystring("date_string").",".request.querystring("what_event").",".request.querystring("what_for").",".request.querystring("name_string").",".request.querystring("email_string").",".request.querystring("tel_string"));
		fclose($filea);
//**************************************************************
//SEND THE EMAILS 
 //**********************************************************
//Set up email for volunteer

// create the message and connection objects 
//		$objMyMessage = Server.CreateObject("CDO.Message"); 
//		$objMyConfiguration = Server.CreateObject ("CDO.Configuration");  
//*******************************************************************
// configuration start
//********************************************************************
// the target smtp server, you can use IP or SERVERNAME.DOMAINNAME
//		objMyConfiguration.$Fields["http://schemas.microsoft.com/cdo/configuration/smtpserver"] = "websmtp.livemail.co.uk"; 
// the SMTP server port being utilised, normally 25 
//		objMyConfiguration.$Fields["http://schemas.microsoft.com/cdo/configuration/smtpserverport"] = 25; 
// the CDO port being utlised 
//		objMyConfiguration.$Fields["http://schemas.microsoft.com/cdo/configuration/sendusing"] = 2; 
// connection timeout
//		objMyConfiguration.$Fields["http://schemas.microsoft.com/cdo/configuration/smtpconnectiontimeout"] = 60; 
// update the connection
//		objMyConfiguration.$Fields.$Update; 
// set the message configuration to the connection info defined above 
//		$objMyMessage.$Configuration = objMyConfiguration; 
 
// message start
//*****************************************************************
//dim  $strSubject, $strBody;
//		$strSubject = "BRSC VOLUNTEER for ".@$_GET["what_event"]." on ".request.querystring("date_string");
//		$strBody = "<h1>".@$_GET["name_string"]." has volunteered for ".request.querystring("what_for")."</H2><br><h2>".request.querystring("email_string")." Contact number = ".request.querystring("tel_string")."</h2>";
// 
//		$objMyMessage.$To = "training@brsc.org.uk";
//		$objMyMessage.$From = "training@brsc.org.uk";
//		$objMyMessage.$Subject = $strSubject;
//		// your options are HTMLBody and TextBody.
//		$objMyMessage.$HTMLBody = $strBody; 
//		$objMyMessage.$Send; 
//		$strBody = "<h1>  Thank you for volunteering for ".@$_GET["what_for"]." on ".request.querystring("date_string")."</H2><br><h2>".request.querystring("email_string")." Contact number = ".request.querystring("tel_string")."</h2>";
//		$objMyMessage.$HTMLBody = $strBody;  
//		$objMyMessage.$To = @$_GET["email_string"];
 //		$objMyMessage.$Send; 
//***********************************************************************
// message end
//////////////////////////////////////////////////////////////////
// do a clean-up
//		$objMyMessage = Nothing; 
//		$objMyConfiguration = Nothing; 
 
//		 }  }//end 2x for verifying that email and role sections are completed 

//*****************************************
//Now update the saftey rota
//********************************************		
$filea=fopen("BRSC_SAFETY_ROTA_VOLUNTEERS.csv","r");
$i=floor(1);
$j=floor(1);
 
 ?>

 
<tr align="center" valign="middle"> 
<?
$heading=fgets($filea);
$a=explode(",",$heading);
for ($i=1; $i<count($a); $i++) {
if (strlen($a[$i])>1) {$string=$a[$i];}
								}
?>
 <table border="1" width="90%" align="center"> 
<td colspan="9"><H2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Volunteering&nbsp;for&nbsp;<?echo @$_GET["what_event"]?>&nbsp;on&nbsp;<?echo @$_GET["date_string"]?> </H2></td></tr>
<tr><td colspan="9">
<?
if (strlen(@$_GET["email_string"])>5) {
 if (strlen(@$_GET["what_for"])!=11) {?>
 <br>
        <h2> Thank you for volunteering - your response has been added to the 
          Rota and the organiser has been emailed.</h2>
 <? echo " ";}
 			} 
 
if (strlen(@$_GET["email_string"])<6 || strlen(request.querystring("what_for"))==11) { 
 ?>
		<form name='form_email' method='get' action='volunteer.php'><br>
          &nbsp;&nbsp;&nbsp;&nbsp;Enter your name :- 
          <input type='text' name='name_string' value='<?echo @$_GET["name_string"]?>'> (will be displayed) <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;Enter your email address :- 
        <input type='email' name='email_string' value='<?echo @$_GET["email_string"]?>'>
          Telephone :- <input type='text' name='tel_string' value='<?echo @$_GET["tel_string"]?>'><br>
          &nbsp;&nbsp;&nbsp;&nbsp;(these will not be displayed just emailed to scows) <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;Select the Duty you wish to volunteer for :- 
        <select id="what_for" name="what_for" value='<?echo @$_GET["what_for"]?>'>
	
    <?for ($j=2; $j<=8; $j++) {
	if ($num_role[$j]>0) {
		echo "<option value='".$what_role[$j]."'>".$what_role[$j]."</option>";
    					}
	if ($num_role[$j]==0 && $j<7) {
		echo "<option value='Select Role'>".$what_role[$j]."(filled)</option>";
									}
							} //end for ?>
  </select>
  
  <input type='hidden' name='date_string' value='<?echo @$_GET["date_string"]?>'><br>
  <input type='hidden' name='what_event' value='<?echo @$_GET["what_event"]?>'><br>
  <input type='hidden' name='id' value='<?echo @$_GET["id"]?>'>
  <input type='hidden' name='update_row' value='<?=$update_row?>'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='Save volunteering details to file' value='Save volunteering details to the ROTA'></form>
				<? } //end if?>
<form name='form_diary' method='get' action='/diary'><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='Return to the diary' value='Return to the diary'><br><br></form></td>

</tr>

<?
$line=fgets($filea);
echo "<tr>";
$a=explode(",",$line);
$j=floor(1);
 
for ($i=1; $i<=Count($a)-1; $i++) {
	$j=$j+1;
	if ($j>2 && $j<7 ) {  ?>
    <td align='center'  style='valign:middle'>
	<? echo($a[$i]);?>
	</td> <?
						}
	if ($j>6) {
	$k=5;
	if ($k==5) { ?>
	 <td align='center'  style='valign:middle'>
	 <? echo($a[$i]);?>
	 </td> <?
				}
				}
						}// end for ($i=1; $i<=Count($a)-1; $i++)
 
$line_num=floor(0);
while(!feof($filea)) {
	$all_lines[$line_num]=fgets($filea);
	$line_num=$line_num+1;
					} 
 	fclose($filea);//close the file
	
	
for ($k=1; $k<=50; $k++) {
	$i=floor(0);
   while ($i<$line_num) {
		$j=floor(1);
 
		$a=explode(",",$all_lines[$i]);
		if (floor($a[0])==$k) {
			echo "<tr>";
			for ($l=1; $l<=Count($a)-1; $l++) {
			$j=$j+1;
			if ($j>2 && $j<8 ) {
    			echo "<td align='center'  style='valign:middle'>".$a[$l]."</td>";
								}
			if ($j>6) {
			if (strlen(@$_GET["email_string"])==5) {
   				 echo "<td align='center'  style='valign:middle'>".$a[$l]."</td>";
													}
						}
											}
				echo "</tr>";
						}// end if loop
		$i=$i+1;
			} //end while loop
					} //end for $k loop
}				 ?>

