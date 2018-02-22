<?php

namespace pxgamer\CondorsTorrents\Modules\Torrents;

use pxgamer\CondorsTorrents\Config;

class Helper
{
    public static function magnetLink($hash, $title = '')
    {
        $trackers = '';

        foreach (Config\App::DEFAULT_TRACKERS as $tracker) {
            $trackers .= '&tr=' . $tracker;
        }

        return '<a href="magnet:?xt=urn:btih:' . $hash . '&dn=' . $title . $trackers . '">
                    <span class="fa fa-fw fa-magnet fa-rotate-180 text-danger"></span>
                </a>';
    }
}
