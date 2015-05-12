<?php
$dbhost = 'localhost:3036';
$dbuser = 'trackme';
$dbpass = 'Saturn~95';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db('trackme');

if($_GET['name'] == '')
{  
  $sql = 'SELECT * FROM route';
}
else
{
  $sql = sprintf('SELECT p.latitude,p.longitude,p.speed,p.time
    FROM points p, route r
    WHERE p.routeid=r.id AND r.name=\'%s\'
    ORDER BY p.id', $_GET['name']);
}

$result = mysql_query( $sql, $conn );
if(! $result)
{
  die('Could not get data: ' . mysql_error());
}
$rows = array();
while($r = mysql_fetch_assoc($result)) {
  $rows[] = $r;
}
print json_encode($rows);
mysql_close($conn);
?>

