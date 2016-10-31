<?php
require('../connect.php');
$full_list = json_decode(file_get_contents("./output.json"));
$sql_file = "./sql_import.sql";

foreach ($full_list as $item) {
    file_put_contents(
        $sql_file,
        "INSERT INTO torrents (et_id, torrent_hash, title) VALUES( '" . $mysqli->escape_string($item->id) . "', '" . $mysqli->escape_string($item->hash) . "', '" . $mysqli->escape_string(str_replace('.', ' ', $item->title)) . "');\n",
        FILE_APPEND
    );
}