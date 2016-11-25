<?php
$full_list = [];
for ($j = 1; $j < 18; $j++) {
    $url = "https://extratorrent.cc/profile/condors/torrents/?page=" . $j . "&pp=100";
    echo $url . "\n";
    $data = grab($url);
    $full_list = json_decode(file_get_contents("./output.json"));
    preg_match_all('/<a href="\/download\/(.*?)\/.*?\.torrent" title="Download (.*?) torrent"><img src="\/\/images4et.com\/images\/icon_download3.gif" alt="Download" \/><\/a><a href="magnet:\?xt=urn:btih:(.*?)&amp;/', $data, $matches);
    for ($i = 0; $i < count($matches[1]); $i++) {
        $full_list[] = (object)[
            "id" => $matches[1][$i],
            "title" => $matches[2][$i],
            "hash" => $matches[3][$i]
        ];
    }
    file_put_contents("./output.json", json_encode($full_list, JSON_PRETTY_PRINT));
}

function grab($url)
{
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        [
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_RETURNTRANSFER => 1
        ]
    );
    return curl_exec($ch);
}
