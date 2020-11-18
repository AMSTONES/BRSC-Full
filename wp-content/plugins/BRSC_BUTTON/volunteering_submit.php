<?php
/*Name:BRSC_BUTTONS PLUGIN FILE
** Description: A program that runs when Volunteer button is pressed.
**Version: 1.0.0
**Author: June Kirkman
**Date:   14 NOVember 2020
 */

// Prohibit direct script loading.
//defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );
//Are we going to attach to the database or csv file?????????
global $wpdb;
  $table_name = $wpdb->prefix . 'volunteers_brsc';

//Write the title at the top
echo("<!DOCTYPE html><html><head><TITLE>THANK YOU FOR VOLUNTEERING</TITLE>");
//Need to refresh the window otherwise old data is shown
header("Pragma: no-cache");
echo("</head><body>");
echo("<table border='1' width='90%' align='center'> ");
echo("<td colspan='6'><H2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Volunteering&nbsp;for&nbsp;". @$_GET["what_event"]."&nbsp;on&nbsp;". @$_GET["date_string"]." (". @$_GET["id"].") </H2></td></tr>");

// Check the volunteer roles required if the form has not been submitted 
if (strlen(@$_GET["email_string"])<6)  {
Get_BRSC_ROLES_data(@$_GET["type_string"],@$_GET["id"]);
 Show_volunteer_form($what_role, $num_role);  }
// Email has been set so update the file
else {
  $entry_str=@$_GET["id"].",".@$_GET["date_string"].",".@$_GET["what_event"].",".@$_GET["what_for"].",".@$_GET["name_string"].",".@$_GET["email_string"].",".@$_GET["tel_string"]."\n";
	Write_BRSC_ROLES_data($entry_str); }
//if($num_role[7]<=0) { 
//All roles are filled so end
//	 echo("<tr><td colspan='6'><H2><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sorry volunteering is completed for this race<br><br>");
//	 echo("&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://brsc.site/diary'>");
//	 echo("<button type='button'>Return to Diary</button></a><br><br></td></tr>"); 		
//}
echo("</table></BODY></HTML>");


function Get_BRSC_ROLES_data($type_of_role, $current_id) {
	global $what_role;  //A list of all the roles
	global $num_role;	//A list of all the roles left to fill for that type of role

//**********************************************************************
//
// get data about how many positions are filled and how many are left to fill
//
//**********************************************************************
$fileb=fopen("BRSC_ROLES.csv","r") or die("Unable to Open File");
$roles_file_line=fgets($fileb); //Get first file line with the roles
$what_role=explode(",",$roles_file_line); //get the role names from the first line
//----------------------------------------------------------------------
//Now get the rest of the file data and check the number of roles required
//----------------------------------------------------------------------------
while (!feof($fileb)){
		$roles_file_line=fgets($fileb);
		$a=explode(",",$roles_file_line);
		if (strcmp($a[0],$type_of_role)==0)  for ($j=1; $j<=7; $j++) $num_role[$j]=$a[$j];  
 						 }//end while 
fclose($fileb);
//-----------------------------------------------------------------------------------
//Now open the volunteer file and check the number of volunteers for this race id
//-------------------------------------------------------------------------------------
$filea=fopen("BRSC_VOLUNTEERS.csv","r") or die("Unable to Open File");
	
    while (!feof($filea)){
		$roles_file_line=fgets($filea);
		$a=explode(",",$roles_file_line);
		if (strcmp($a[0],$current_id)==0)  {
			echo("<tr><td colspan='6'>".$a[4]." for ".$a[3]."</td></tr>");
			for ($j=1; $j<=7; $j++) 
			if (strcmp($what_role[$j],$a[3])==0) $num_role[$j]=$num_role[$j]-1;
				
											}// end if
		}//end while 
	fclose($filea);
//Check if there are any roles required for this race
//Sum all missing roles into num_roles[7]
//$num_role[7]=0;
	for ($j=1; $j<=7; $j++) 
			$num_role[7]= $num_role[7]+$num_role[$j]; 
} //End Function

Function Show_volunteer_Form($strrole, $nroles)
{

	 ?>
		<tr><td colspan='6'>
		<form name='form_email' method='get' action='volunteering.php'><br>
          &nbsp;&nbsp;&nbsp;&nbsp;Enter your name :- 
          <input type='text' name='name_string' value='<?echo @$_GET["name_string"]?>'> (will be displayed) <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;Enter your email address :- 
        <input type='email' name='email_string' value='<?echo @$_GET["email_string"]?>'>
          Telephone :- <input type='text' name='tel_string' value='<?echo @$_GET["tel_string"]?>'><br>
          &nbsp;&nbsp;&nbsp;&nbsp;(these will not be displayed just emailed to scows) <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;Select the Duty you wish to volunteer for :- 
        <select id="what_for" name="what_for" value='<?echo @$_GET["what_for"]?>'>
	
    <?for ($j=1; $j<=7; $j++) {
	//if ($nroles[$j]>0) 
		echo "<option value='".$strrole[$j]."'>".$strrole[$j]."(".$nroles[$j].")</option>";}
   ?>
  </select>
  <input type='hidden' name='date_string' value='<?echo @$_GET["date_string"]?>'><br>
  <input type='hidden' name='what_event' value='<?echo @$_GET["what_event"]?>'><br>
  <input type='hidden' name='id' value='<?echo @$_GET["id"]?>'>
  <input type='hidden' name='update_row' value='<?=$update_row?>'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='GO' value='Add to Rota'></form><br></td></tr>
				
			<tr colspan="6"><td><br>
 			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<a href='http://brsc.site/diary'><button type='button'>Return to Diary</button></a><br><br></td></tr>
<?php		} 

Function Write_BRSC_ROLES_data($update_str)  {
//---------------------------------------------------------------------------
//Now update the file by setting up the csv string and appending it
//---------------------------------------------------------------------------
	$filec=fopen("BRSC_VOLUNTEERS.csv","a") or die("Unable to Open File");
    fwrite($filec,$update_str); //Get first file line with the roles
	fclose($filec);
//----------------------------------------------------------------------------
// Add thank you and button to return to diary
// ----------------------------------------------------------------------------
	 echo("<tr><td colspan='6'><H2><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thank you for volunteering <br><br>");
	 echo("&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://brsc.site/diary'>");
	 echo("<button type='button'>Return to Diary</button></a><br><br></td></tr>"); 
}  ?>