<?php if (empty($content)): ?>
<div class="content">
    <p><?php $language->p('Записей не найдено') ?></p>
</div>
<?php endif ?>

<?php foreach ($content as $page): ?>

<div class="post-card">

    <?php Theme::plugins('pageBegin'); ?>

    <div class="post-card-body">
        <a class="" href="<?php echo $page->permalink(); ?>">
            <h2 class=""><?php echo $page->title(); ?></h2>
        </a>

        <?php if ($page->coverImage()): ?>
        <img class="card-img lazy" data-src="<?php echo $page->coverImage(); ?>" />
        <?php endif ?>

        <h5 class="">
            <?php echo $page->date(); ?> &#9679;
            <?php echo $L->get('Примерное время чтения') . ': ' . $page->readingTime(); ?>
        </h5>

        <?php if ($page->tags()): ?>
        <div class="tags">
            <h5>Метки:</h5>
            <?php 
            $returnsArray = true;

            $items = $page->tags($returnsArray);

            foreach ($items as $tagKey=>$tagName) {
                $tag = new Tag($tagKey);

                echo '<a class="tag" href="'.$tag->permalink().'">'.$tag->name().'</a>';
            }

        ?>
        </div>
        <?php endif ?>

        <?php echo $page->contentBreak(); ?>

        <?php if ($page->readMore()): ?>
        <a class="read-more" href="<?php echo $page->permalink(); ?>">
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

        <?php if (Paginator::currentPage() !=1 ): ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo Theme::siteUrl() ?>">Главная</a>
        </li>
        <?php endif ?>

        <?php if (Paginator::showNext()): ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo Paginator::nextPageUrl() ?>"><?php echo $L->get('Туда'); ?>
                &#9658;</a>
        </li>
        <?php endif ?>

    </ul>
</nav>
<?php endif ?>