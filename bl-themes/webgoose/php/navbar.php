<header>
    <div class="container">
        <div class="row">
            <a class="brand" href="<?php echo Theme::siteUrl() ?>">
                <?php echo $site->title() ?>
            </a>
            <ul class="nav-items">
                <?php foreach ($staticContent as $staticPage): ?>
                <li class="nav-item">
                    <a class="nav-link"
                        href="<?php echo $staticPage->permalink() ?>"><?php echo $staticPage->title() ?></a>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</header>