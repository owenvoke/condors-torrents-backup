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
$added = $failed = 0;
$new = [];
foreach ($data->channel->item as $d) {
    $d->et_id = (int)$mysqli->escape_string(explode('/', $d->link)[4]);

    $stmtSelect = $mysqli->prepare("SELECT COUNT(*) FROM torrents WHERE et_id = ?");
    $stmtSelect->bind_param("i", $d->et_id);
    $stmtSelect->execute();
    $stmtSelect->bind_result($exists);
    $stmtSelect->fetch();
    $stmtSelect->close();
    $d->title = $mysqli->escape_string(str_replace('.', ' ', $d->title));
    if ($exists < 1) {
        $stmtInsert = $mysqli->prepare("INSERT INTO torrents (et_id, torrent_hash, title) VALUES (?, ?, ?)");
        $stmtInsert->bind_param("iss", $d->et_id, $d->info_hash, $d->title);
        if ($stmtInsert->execute()) {
            $added = $added + 1;
            $new[] = str_replace('.', ' ', $d->title);
        }
        else {
            echo $stmtInsert->error;
            $failed = $failed + 1;
        }
        $stmtInsert->close();
    }
}
echo json_encode(
    (object)[
        "added" => $added,
        "new" => $new,
        "failed" => $failed
    ],
    JSON_PRETTY_PRINT
);
