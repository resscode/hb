<html lang="en"><head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo $defaultcss; ?>bootstrap.css" rel="stylesheet">        
        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
            }
        </style>
        <link href="<?php echo $defaultcss; ?>bootstrap-responsive.css" rel="stylesheet">
        <?php
        // TODO move to outside helper
        if (isset($styles)) {
            if (is_array($styles)) {
                foreach ($styles as $style) {
                    echo '<link href="' . $defaultcss . $style . '" rel="stylesheet">';
                }
            } else {
                echo '<link href="' . $defaultcss . $styles . '" rel="stylesheet">';
            }
        }
        ?>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->

    </head>

    <body>