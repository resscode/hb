<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <?php foreach ($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <?php foreach ($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
        <style type='text/css'>
            body
            {
                font-family: Arial;
                font-size: 14px;
            }
            a {
                color: blue;
                text-decoration: none;
                font-size: 14px;
            }
            a:hover
            {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="brand" href="/hb/outtransactions/add">HB</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <?php if(!empty($auth)){ ?>
                                <li><a href="/hb/pockets">Pockets</a></li>
                                <li><a href="/hb/intransactions">In Transactions</a></li>
                                <li><a href="/hb/outtransactions">Out transactions</a></li>
                                <li><a href="/hb/migratetransactions">Migrate transactions</a></li>
                                <li><a href="/hb/incategories">In Categories</a></li>
                                <li><a href="/hb/outcategories">Out Categories</a></li>
                                <li class="dropdown">
                                    <a href="/auth/my_profile" class="dropdown-toggle" data-toggle="dropdown">User <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                      <li><a href="/auth/my_profile">Profile</a></li>
                                      <li class="divider"></li>
                                      <li class="nav-header">Don't touch</li>
                                      <li><a href="/auth/logout">Logout</a></li>
                                    </ul>
                                </li>
                            <?php }else{ ?>
                                <li><a href="/auth/login">Login</a></li> 
                            <?php }?>
                            
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div style='height:70px;'></div>  
        <div class="container">
            <h1><?php echo isset($title) ? $title : "" ; ?></h1>
            <?php echo $output; ?>
        </div>
    </body>
</html>