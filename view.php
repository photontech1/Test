<?php
/**
 *view Detail Details administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once(ABSPATH . 'wp-admin/admin.php');
require_once(ABSPATH . 'wp-includes/user.php');
require_once(ABSPATH . 'wp-includes/load.php');
if ( ! current_user_can( 'manage_options' ) )
	wp_die( __( 'You do not have sufficient permissions to manage options for this site.' ) );
$title = __( 'view' );
error_reporting(0);
$plugin='Csv';
global $wpdb;
	 $table_name = $wpdb->prefix."wp_tv_scedule";

?>
<?php
$eid = $_GET["eid"];
if($eid != "")
{
	$Details1 = $wpdb->get_results("Select * from wp_tv_scedule where Id='".$eid."'");
	foreach($Details1 as $row1)
	{	

?>
<style>
.heading{
     font-weight: bold;
     display:table-row;
     background-color:#FF9500;;
     text-align: center;
     line-height: 25px;
     font-size: 14px;
     font-family:georgia;
     color:#fff !important;
    
}
.heading h3{   color:#fff !important; }
</style>
<form>
<table align="center">

  <th align="center" class="heading" colspan="2"><h3>Detail View Of &nbsp;&nbsp;&nbsp;<?php echo $row1->Title; ?> &nbsp;&nbsp; TV SCHEDULE</h3></th>
  
<tr>
<td>Date</td>
<td><input type="text"  value="<?php echo $row1->Date; ?>" /></td>
</tr>

<tr>
<td>Time</td>
<td><input type="text"  value="<?php echo $row1->Time; ?>" /></td>
</tr>
<tr>
<td>Programme</td>
<td><input type="text"  value="<?php echo $row1->Programme; ?>" /></td>
</tr>
<tr>
<td>Title</td>
<td><input type="text"  value="<?php echo $row1->Title; ?>" /></td>
</tr>
<tr>
<td>Synopsis
</td>
<td><textarea cols="20" rows="10"/><?php echo $row1->Synopsis; ?></textarea></td>
</tr>

<tr>
<td>Certificate</td>
<td><input type="text"  value="<?php echo $row1->Certificate; ?>" /></td>
</tr>

<tr>
<td>Genre</td>
<td><input type="text"  value="<?php echo $row1->Genre; ?>" /></td>
</tr>

<tr>
<td>SubGenre</td>
<td><input type="text"  value="<?php echo $row1->SubGenre
; ?>" /></td>
</tr>
</table>
</form>
<?php 
}}
?>
