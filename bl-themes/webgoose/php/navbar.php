<header>
    <div class="container">
        <div class="row">
            <a class="brand" href="<?php echo Theme::siteUrl() ?>">
                <?php echo $site->title() ?>
            </a>
        </div>
    </div>
</header>
<div class="nav">
    <ul class="nav-items">
        <?php foreach ($staticContent as $staticPage): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $staticPage->permalink() ?>"><?php echo $staticPage->title() ?></a>
        </li>
        <?php endforeach ?>
    </ul>
    <div class="vertical-hr"></div>
    <div class="theme-switcher">
        <label>Темная тема</label>
        <label class="switch">
            <input type="checkbox" id="themeSwitcher">
            <span class="slider round"></span>
        </label>
    </div>
</div>