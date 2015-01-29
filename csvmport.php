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
?>
<?php

$message = null;
//echo $_SERVER['DOCUMENT_ROOT']; 
$allowed_extensions = array('csv');
$path_array  = wp_upload_dir();
  // echo $upload_path = str_replace('\\', '/', $path_array['url']).'/';
	$upload_path = '/var/www/vhosts/bonanzabonanza.co.uk/httpdocs/wp-content/uploads/csv';
	
if (!empty($_FILES['file'])) {

	if ($_FILES['file']['error'] == 0) {
			
		// check extension
		$file = explode(".", $_FILES['file']['name']);
		$extension = array_pop($file);
		
		if (in_array($extension, $allowed_extensions)) {
		 
	
			if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_path.'/'.$_FILES['file']['name'])) {
			
			
		
				if (($handle = fopen($upload_path.'/'.$_FILES['file']['name'], "r")) !== false) {
					
					$keys = array();
					$out = array();
					
					$insert = array();
					
					$line = 1;
					
					while (($row = fgetcsv($handle, 0, ',', '"')) !== FALSE) {
				       	
				       	foreach($row as $key => $value) {
				       		if ($line === 1) {
				       			$keys[$key] = $value;
				       		} else {
				       			$out[$line][$key] = $value;
				       			
				       		}
				       	}
				        
				        $line++;
				      
				    }
				    
				    fclose($handle);    
				    
				    if (!empty($keys) && !empty($out)) {
				    	
				    	$db = new PDO('mysql:host=localhost;dbname=bonanza_bonanza', 'wordpress_ba', 'A_N7khf1B8');
				   		$db->exec("SET CHARACTER SET utf8");
				    
				    	foreach($out as $key => $value) {
				    	
				    		$sql  = "INSERT INTO `wp_tv_scedule` (`";
				    		$sql .= implode("`, `", $keys);
				    		$sql .= "`) VALUES (";
				    		$sql .= implode(", ", array_fill(0, count($keys), "?"));
				    		$sql .= ")";
				    		$statement = $db->prepare($sql);
				    		$statement->execute($value);
				    		
				   		}
				   		
				   		$message = '<span class="green">File has been uploaded successfully</span>';
				   		
				   	}	
				    
				}
				
			}
			
		} else {
			$message = '<span class="red">Only .csv file format is allowed</span>';
		}
		
	} else {
		$message = '<span class="red">There was a problem with your file</span>';
	}
	
}

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Upload CSV to MySQL</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="/css/core.css" rel="stylesheet" type="text/css" />
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>

<section id="wrapper">	
	
	<form action="" method="post" enctype="multipart/form-data">
	
		<table cellpadding="0" cellspacing="0" border="0" class="table">
			<tr>
				<th><label for="file">Select file</label> <?php echo $message; ?></th>
			</tr>
			<tr>
				<td><input type="file" name="file" id="file" size="30" /></td>
			</tr>
			<tr>
				<td><input type="submit" id="btn" class="fl_l" value="Submit" /></td>
			</tr>
		</table>
		
	</form>
	
</section>

</body>
</html>


