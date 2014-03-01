<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="/service/">HB</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php
                    if (isset($topmenu) && is_array($topmenu)) {
                        foreach ($topmenu as $menuItem) {
                            echo '<li ' . ($menuItem['active']===true ? 'class="active"' : '' ) . '">
                            <a href="' . $menuItem['url'] . '">' . $menuItem['title'] . '</a>
                                </li>';
                        }
                    } else {
                        ?>
                        <li><a href="/service/svn">SVN</a></li>
                        <li><a href="/service/testform">Testform</a></li>
                        <li><a href="/service/changeperm">Permissions</a></li>
                        <li><a href="/service/logs">Logs</a></li>
                        <li><a href="/service/dumps">Dumps</a></li>
                        <li><a href="/service/switches">Switches</a></li>
                        <li><a href="/service/functionaltests">Functional Tests</a></li>
                    <?php } ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
