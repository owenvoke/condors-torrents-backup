{include file='include/header.tpl'}
<div class="container text-center">
    <div class="page-header">
        <h1 class="condors-blue">Condors Torrents Backup</h1>
    </div>
    <div class="form-group">
        <form action="/search" method="get">
            <input placeholder="I want to watch..." autocomplete="off" name="q"
                   type="text" class="hover-bottom big-search">
        </form>
    </div>
    <div class="years form-group condors-blue">
        <ul>
            {foreach $data->years as $year}
                <li><a href="/search?q={$year}">{$year}</a></li>
            {/foreach}
        </ul>
    </div>
</div>
{include file='include/footer.tpl'}