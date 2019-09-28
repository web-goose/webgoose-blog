<!DOCTYPE html>
<html lang="<?php echo Theme::lang() ?>">

<head>
    <?php include(THEME_DIR_PHP.'head.php'); ?>
</head>

<body>
    <div class="wrapper">
        <?php Theme::plugins('siteBodyBegin') ?>

        <?php include(THEME_DIR_PHP.'navbar.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9">
                    <?php
                    if($WHERE_AM_I == 'page') {
                        include(THEME_DIR_PHP.'page.php');
                    } else {
                        include(THEME_DIR_PHP.'home.php');
                    }
                ?>
                </div>
                <div class="col-12 col-md-3">
                    <?php include(THEME_DIR_PHP.'sidebar.php'); ?>
                </div>
            </div>
        </div>

        <?php include(THEME_DIR_PHP.'footer.php'); ?>

        <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.0.0/dist/lazyload.min.js"></script>

        <?php
            echo Theme::js('js/jquery-3.4.1.min.js');
            echo Theme::js('js/bootstrap.min.js');
            echo Theme::js('js/site.js');
        ?>

        <?php Theme::plugins('siteBodyEnd') ?>
    </div>
</body>

</html>