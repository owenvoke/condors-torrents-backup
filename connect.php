<?php
$mysqli = new mysqli('localhost', 'root', '', 'condors-torrents');
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
