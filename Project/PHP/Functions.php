<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'cs2s.yorkdc.net';
    $DATABASE_USER = 'william.hill1';
    $DATABASE_PASS = 'MY password';
    $DATABASE_NAME = 'williamhill1_Sensor';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	die ('Failed to connect to database!');
    }
}
function template_header($guest) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$guest</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">    	
    </nav>
EOT;
}


function template_footer() {
echo <<<EOT
<style>
         .button {
         background-color: #32CD32;
         border: none;
         color: white;
         padding: 20px 34px;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-size: 20px;
         margin: 4px 2px;
         cursor: pointer;
         }
      </style>
   </head>
    <div>    
    </div>
   
</html>
EOT;
}
?>
