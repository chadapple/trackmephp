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

if($_GET['name'] == ''  || $_GET['lat'] == '' || $_GET['long'] == '' || $_GET['alt'] == '') 
{  
  die('Insufficient data');
}
else
{
  $sql = sprintf('SELECT id FROM route WHERE name=\'%s\' ', $_GET['name']);
  $result = mysql_query( $sql, $conn );
  $row = mysql_fetch_assoc($result);
  if(empty($row))
  {
    $sql = sprintf('INSERT INTO route VALUES (NULL, \'%s\')', $_GET['name']);
    $result = mysql_query( $sql, $conn );
    $sql = sprintf('SELECT id FROM route WHERE name=\'%s\' ', $_GET['name']);
    $result = mysql_query( $sql, $conn );
    $row = mysql_fetch_assoc($result);
  }
  $sql = sprintf('INSERT INTO points VALUES (NULL, %d, %f, %f, %f, NOW())', $row['id'], $_GET['lat'], $_GET['long'], $_GET['alt']);
  $result = mysql_query( $sql, $conn );
  if(!empty($result))
  {
    print 'Success';
  }
}

mysql_close($conn);
?>

