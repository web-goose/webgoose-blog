<div class="post-card">

    <?php Theme::plugins('pageBegin'); ?>

    <?php if ($page->coverImage()): ?>
    <img class="post-card-img" src="<?php echo $page->coverImage(); ?>" />
    <?php endif ?>

    <div class="card-body">
        <a class="" href="<?php echo $page->permalink(); ?>">
            <h1><?php echo $page->title(); ?></h1>
        </a>

        <?php if (!$page->isStatic() && !$url->notFound()): ?>
        <h5 class="">
            <?php echo $page->date(); ?>
        </h5>
        <h6>
            <?php echo $L->get('Примерное время чтения') . ': ' . $page->readingTime(); ?>
        </h6>
        <?php endif ?>

        <?php echo $page->content(); ?>

    </div>

    <?php Theme::plugins('pageEnd'); ?>

</div>