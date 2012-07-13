<?php
/**
 * 
 * Example usage example of the Google Street View Image API wrapper class
 * 
 * @author Anthony Mills <me@anthony-mills.com>
 * @copyright 2012 Anthony Mills
 * @link http://www.development-cycle.com
 * 
 */

// API key is optional unless you are making a large number of requests
$apiKey = '';

require_once('includes/streetViewImages.php');

$svImages = new streetViewImages($apiKey);

?>

<!DOCTYPE html>
<head>
	<title>
		Example Street View image API Usage
	</title>
</head>

<body>
	<img src="<?php echo $svImages->getImage('70 York St, Sydney, NSW'); ?>">
</body>
 


