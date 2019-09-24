<!DOCTYPE html>
<html lang="<?php echo Theme::lang() ?>">

<head>
    <?php include(THEME_DIR_PHP.'head.php'); ?>
</head>

<body>
    <?php Theme::plugins('siteBodyBegin') ?>

    <?php include(THEME_DIR_PHP.'navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-9">
                <?php
                    if($WHERE_AM_I == 'page') {
                        include(THEME_DIR_PHP.'page.php');
                    } else {
                        include(THEME_DIR_PHP.'home.php');
                    }
                ?>
            </div>
            <div class="col-3">
                <?php include(THEME_DIR_PHP.'sidebar.php'); ?>
            </div>
        </div>
    </div>


    <?php include(THEME_DIR_PHP.'footer.php'); ?>

    <?php
        echo Theme::js('js/jquery-3.4.1.min.js');
        echo Theme::js('js/bootstrap.min.js');
    ?>

    <?php Theme::plugins('siteBodyEnd') ?>
</body>

</html>