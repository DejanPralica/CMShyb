<?php 

$db_settings = array (

'driver' => 'mysql',
'host' => 'localhost',
'username' => 'root',
'password' => '',
'database'  => 'testna',
'charset'  => 'utf8',

);

$dbObject = new PDO($db_settings['driver'].':host='.$db_settings['host']. ';dbname='.$db_settings['database'].';charset='.$db_settings['charset'], $db_settings['username'], $db_settings['password']);

/*
$stmt = $db->query('SELECT * FROM users');
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['user_name'].' '.$row['user_email']; //etc...
}

*/


?>