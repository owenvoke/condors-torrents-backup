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
            <li><a href="/search?q=2015">2015</a></li>
            <li><a href="/search?q=2014">2014</a></li>
            <li><a href="/search?q=2013">2013</a></li>
            <li><a href="/search?q=2012">2012</a></li>
            <li><a href="/search?q=2011">2011</a></li>
        </ul>
    </div>
</div>
{include file='include/footer.tpl'}