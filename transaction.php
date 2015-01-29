<?php
/**
 *Trasaction Detail Details administration panel.
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
$title = __( 'transaction' );
error_reporting(0);
$plugin='App_form';
global $wpdb;
	$table_name = $wpdb->prefix."application_form";

?>

<form method="post">
<table>
  <th colspan="6"><h3>Transaction</h3></th>
  </tr>
    <td>First Name</td>
    <td>Last Name</td>
     <td align="center" colspan="2">Action</td>
    </tr>
   
  <?php
	
	$Details1 = $wpdb->get_results("Select * from $table_name");
	foreach($Details1 as $row1)
	{		
?>
	<tr>
    <td><?php echo $row1->Print_First_Name; ?></td>
    <td><?php echo $row1->Print_Last_Name; ?></td>
    <td><a href="<?php bloginfo('siteurl');?>/wp-admin/admin.php?page=transaction&did=<?php echo $row->id; ?>" onclick="return confirm('Are you sure?')">Delete</a></td>

<td><a href="<?php bloginfo('siteurl');?>/wp-admin/admin.php?page=view&eid=<?php echo $row1->id; ?>">view</a></td>
    <?php
	}?>
    </tr>
 </table>
 </form>
<?php
if($_GET["did"] != "")
{
	$delqry = "Delete from $table_name where id ='".$_GET["did"]."'";
	$res = $wpdb->query($delqry);
	if($res == 1)
	{
		?>
        <?php echo 'Your TV SCEDULE Delete Successfully.....';?>
        <script language="javascript">
		
		//alert("Your TV SCEDULE Delete Successfully.....");
		window.location = "<?php bloginfo('siteurl');?>/wp-admin/admin.php?page=transaction";
		</script>
        <?php
	}
}
?>
