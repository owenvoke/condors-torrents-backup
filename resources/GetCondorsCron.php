<?php
include('../connect.php');
$rss_feed = 'https://extratorrent.cc/rss.xml?type=user&user=condors';
header("Content-Type: application/json, text/json, text/plain");

$xml_data = file_get_contents($rss_feed);
$data = json_encode(simplexml_load_string(
        $xml_data,
        null,
        LIBXML_NOCDATA
    )
);
$data = json_decode($data);
$stmtSelect = $mysqli->prepare("SELECT COUNT(*) FROM torrents WHERE et_id = ?");
$stmtInsert = $mysqli->prepare("INSERT INTO torrents (et_id, torrent_hash, title) VALUES (?, ?, ?)");
$added = 0;
foreach ($data->channel->item as $d) {
    $d->et_id = explode('/', $d->link)[4];

    $stmtSelect->bind_param("i", $d->et_id);
    $stmtSelect->execute();
    $stmtSelect->bind_result($exists);
    $stmtSelect->fetch();
    if ($exists === 0) {
        $stmtInsert->bind_param("iss", $d->$d->title, $d->info_hash);
        $stmtInsert->execute();
        $added = $added + 1;
    }
}
echo json_encode(
    (object)[
        "added" => $added
    ],
    JSON_PRETTY_PRINT);