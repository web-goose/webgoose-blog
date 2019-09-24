<?php if (empty($content)): ?>
<div class="">
    <?php $language->p('Записей не найдено') ?>
</div>
<?php endif ?>

<?php foreach ($content as $page): ?>

<div class="post-card">

    <?php Theme::plugins('pageBegin'); ?>

    <?php if ($page->coverImage()): ?>
    <img class="" src="<?php echo $page->coverImage(); ?>" />
    <?php endif ?>

    <div class="post-card-body">
        <a class="" href="<?php echo $page->permalink(); ?>">
            <h2 class=""><?php echo $page->title(); ?></h2>
        </a>

        <h5 class="">
            <?php echo $page->date(); ?>
        </h5>
        <h6>
            <?php echo $L->get('Примерное время чтения') . ': ' . $page->readingTime(); ?>
        </h6>

        <?php echo $page->contentBreak(); ?>

        <?php if ($page->readMore()): ?>
        <a href="<?php echo $page->permalink(); ?>">
            <?php echo $L->get('Читать дальше'); ?>
        </a>
        <?php endif ?>

        <?php Theme::plugins('pageEnd'); ?>

    </div>
</div>
<?php endforeach ?>

<?php if (Paginator::numberOfPages()>1): ?>
<nav class="paginator">
    <ul class="pagination">

        <?php if (Paginator::showPrev()): ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo Paginator::previousPageUrl() ?>" tabindex="-1">&#9664;
                <?php echo $L->get('Сюда'); ?></a>
        </li>
        <?php endif ?>

        <li class="page-item <?php if (Paginator::currentPage()==1) echo 'disabled' ?>">
            <a class="page-link" href="<?php echo Theme::siteUrl() ?>">Главная</a>
        </li>

        <?php if (Paginator::showNext()): ?>
        <li class=" page-item">
            <a class="page-link" href="<?php echo Paginator::nextPageUrl() ?>"><?php echo $L->get('Туда'); ?>
                &#9658;</a>
        </li>
        <?php endif ?>

    </ul>
</nav>
<?php endif ?>