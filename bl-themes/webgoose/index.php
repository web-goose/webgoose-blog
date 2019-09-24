<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <?php echo Theme::metaTags('description') ?>
    <?php echo Theme::metaTags('title') ?>
    <!-- CSS -->
    <?php echo Theme::cssBootstrap() ?>
    <?php echo Theme::css('css/style.css') ?>
    <!-- Load plugins with the hook siteHead -->
    <?php Theme::plugins('siteHead') ?>
</head>

<body>
    <!-- Load plugins with the hook siteBodyBegin -->
    <?php Theme::plugins('siteBodyBegin') ?>

    <h1><?php echo $site->title() ?></h1>
    <h2><?php echo $site->slogan() ?></h2>

    <?php if ($WHERE_AM_I=='page'): ?>
    <p>The user is watching a particular page</p>
    <?php elseif ($WHERE_AM_I=='home'): ?>
    <?php foreach ($content as $page): ?>
    <h3><?php echo $page->title(); ?></h3>
    <?php endforeach ?>
    <?php endif ?>


    <?php echo Theme::jquery() ?>
    <?php echo Theme::jsBootstrap() ?>
    <!-- Load plugins with the hook siteBodyBegin -->
    <?php Theme::plugins('siteBodyEnd') ?>
</body>

</html>