<tr>
    <td><a class="no-underline" href="/torrent/{$torrent->id}">{$torrent->title}</a></td>
    <td class="hash-column">{$torrent->torrent_hash}</td>
    <td>{pxgamer\CondorsTorrents\Modules\Torrents\Helper::magnetLink($torrent->torrent_hash, $torrent->title)}</td>
</tr>