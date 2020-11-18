<?php
/*
Plugin Name:BRSC_VOLUNTEERS
Description: A simple plugin that allows you to perform Create (INSERT), Read (SELECT), Update and Delete volunteers in a table.
Version: 1.0.1
Author: June Kirkman
*/
/* THe table is set up when the plugin is activated */
register_activation_hook( __FILE__, 'Create_BRSC_Table');
function Create_BRSC_Table() {
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'volunteers_brsc';
  $sql = "CREATE TABLE `$table_name` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `event_id` int(10),
  `event_date` varchar(100) DEFAULT NULL,
  `event` varchar(100) DEFAULT NULL,
  `what_for` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `Telephone` varchar(20) DEFAULT NULL,
 
  PRIMARY KEY(id)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  ";
/*If database table not found create it*/
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }
	
}
add_action('admin_menu', 'addBRSCVolunteerPageContent');
function addBRSCVolunteerPageContent() {
  add_menu_page('VOLUNTEERS', 'VOLUNTEERS', 'manage_options' ,__FILE__, 'BRSCAdminPage', 'dashicons-wordpress');
}

function BRSCAdminPage() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'volunteers_brsc';
	// if this is a new entry   
  if (isset($_POST['newsubmit'])) {
    $name = $_POST['newname'];
    $email = $_POST['newemail'];
	$tele = $_POST['newtele'];  
    $wpdb->query("INSERT INTO $table_name(name,email,telephone) VALUES('$name','$email','$tele')");
    //echo "<script>location.replace('admin.php?page=brsc-volunteering%2Fbrsc-volunteering.php');</script>";
    //If this is an update  
  }
  if (isset($_POST['uptsubmit'])) {
    $id = $_POST['uptid'];
    $name = $_POST['uptname'];
    $email = $_POST['uptemail'];
	$tele = $_POST['upttele'];  
    $wpdb->query("UPDATE $table_name SET name='$name',email='$email',telephone='$tele' WHERE id='$id'");
    //echo "<script>location.replace('admin.php?page=brsc-volunteering%2Fbrsc-volunteering.php');</script>";
  }
  if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $wpdb->query("DELETE FROM $table_name WHERE id='$del_id'");
    //echo "<script>location.replace('page=brsc-volunteering%2Fbrsc-volunteering.php');</script>";
  }
  ?>
  <div class="wrap">
    <h2>VOLUNTEER Operations</h2>
    <table class="wp-list-table widefat striped">
      <thead>
        <tr>
          <th width="25%">User ID</th>
          <th width="25%">Name</th>
          <th width="25%">Email Address</th>
		   <th width="25%">Telephone</th>
          <th width="25%">Actions</th>
        </tr>
      </thead>
      <tbody>
        <form action="" method="post">
          <tr>
           <td><input type="text" value=" " disabled></td>
            <td><input type="text" id="newname" name="newname"></td>
            <td><input type="text" id="newemail" name="newemail"></td>
			<td><input type="text" id="newtele" name="newemail"></td>
            <td><button id="newsubmit" name="newsubmit" type="submit">INSERT</button></td>
          </tr>
        </form>
        <?php
          $result = $wpdb->get_results("SELECT * FROM $table_name");
		  $fileb=fopen("BRSC_ROLES_NUM.csv","w"); 
	      
          foreach ($result as $print) {
           $volunteer_string=$print->id.','.$print->name.','.$print->email.','.$print->Telephone.'\n';
			  echo "
              <tr>
                <td width='25%'>$print->id</td>
                <td width='25%'>$print->name</td>
                <td width='25%'>$print->email</td>
				<td width='25%'>$print->Telephone</td>
                <td width='25%'><a href='https://brsc.site/wp-admin/admin.php?page=brsc-volunteers%2Fbrsc-volunteeringvj1.php&upt=$print->id'><button type='button'>UPDATE</button></a> <a href='https://brsc.site/wp-admin/admin.php?page=brsc-volunteers%2Fbrsc-volunteeringjv1.php&del=$print->id'><button type='button'>DELETE</button></a></td>
              </tr>
            ";
		fwrite($fileb,$volunteer_string);  
          }
		fclose($fileb);
        ?>
      </tbody>
    </table>
    <br>
    <br>
    <?php
      if (isset($_GET['upt'])) {
        $upt_id = $_GET['upt'];
        $result = $wpdb->get_results("SELECT * FROM $table_name WHERE id='$upt_id'");
        foreach($result as $print) {
          $name = $print->name;
          $email = $print->email;
		  $tele   =$print->Telephone;
        }
        echo "
        <table class='wp-list-table widefat striped'>
          <thead>
            <tr>
              <th width='25%'>User ID</th>
              <th width='25%'>Name</th>
              <th width='25%'>Email Address</th>
			  <th width='25%'>Telephone</th>
              <th width='25%'>Actions</th>
            </tr>
          </thead>
          <tbody>
            <form action='' method='post'>
              <tr>
                <td width='25%'>$print->id <input type='hidden' id='uptid' name='uptid' value='$print->id'></td>
                <td width='25%'><input type='text' id='uptname' name='uptname' value='$print->name'></td>
                <td width='25%'><input type='text' id='uptemail' name='uptemail' value='$print->email'></td>
				<td width='25%'><input type='text' id='uptemail' name='upttele' value='$print->telephone'></td>
                <td width='25%'><button id='uptsubmit' name='uptsubmit' type='submit'>UPDATE</button> <a href='https://brsc.site/wp-admin/admin.php?page=brsc-volunteers%2Fbrsc-volunteeringjv1.php'><button type='button'>CANCEL</button></a></td>
              </tr>
            </form>
          </tbody>
        </table>";
      }
    ?>
  </div>
<?php 

	function import() {
		$file = wp_import_handle_upload();

		if ( isset( $file['error'] ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', 'really-simple-csv-importer' ) . '</strong><br />';
			echo esc_html( $file['error'] ) . '</p>';
			return false;
		} else if ( ! file_exists( $file['file'] ) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', 'really-simple-csv-importer' ) . '</strong><br />';
			printf( __( 'The export file could not be found at <code>%s</code>. It is likely that this was caused by a permissions problem.', 'really-simple-csv-importer' ), esc_html( $file['file'] ) );
			echo '</p>';
			return false;
		}
		
		$this->id = (int) $file['id'];
		$this->file = get_attached_file($this->id);
		$result = $this->process_posts();
		if ( is_wp_error( $result ) )
			return $result;
	}

?>
 <?php
}

function greetv2() {
		echo '<p>'.__( 'To start choose a CSV (.csv) file to upload, then click Upload file and import.', 'really-simple-csv-importer' ).'</p>';
		echo '<p>'.__( 'Requirements:', 'really-simple-csv-importer' ).'</p>';
		echo ' '.__('(OpenDocument Spreadsheet file format for LibreOffice. Please export as csv before import)', 'really-simple-csv-importer' );
		echo '</p>';
		wp_import_upload_form( add_query_arg('step', 1) );
	}
?>