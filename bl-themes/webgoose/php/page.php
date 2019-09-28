<div class="post-card">

    <?php Theme::plugins('pageBegin'); ?>

    <div class="card-body">
        <a href="<?php echo $page->permalink(); ?>">
            <h1><?php echo $page->title(); ?></h1>
        </a>

        <?php if ($page->coverImage()): ?>
        <img class="card-img lazy" data-src="<?php echo $page->coverImage(); ?>" />
        <?php endif ?>

        <?php if (!$page->isStatic() && !$url->notFound()): ?>
        <h5 class="">
            <?php echo $page->date(); ?> &#9679;
            <?php echo $L->get('Примерное время чтения') . ': ' . $page->readingTime(); ?>
        </h5>
        <?php endif ?>

        <?php if ($page->tags()): ?>
        <h5>Метки:
            <?php 
            $returnsArray = true;

            $items = $page->tags($returnsArray);

            foreach ($items as $tagKey=>$tagName) {
                $tag = new Tag($tagKey);

                echo '<a class="tag" href="'.$tag->permalink().'">'.$tag->name().'</a>';
            }

        ?>
        </h5>
        <?php endif ?>

        <?php echo $page->content(); ?>

    </div>

    <?php Theme::plugins('pageEnd'); ?>

</div>