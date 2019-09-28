<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php 
    echo Theme::metaTags('title');

    echo Theme::metaTags('description');

    echo Theme::favicon('img/favicon.ico'); 

    echo Theme::css('css/bootstrap-grid.min.css');

    echo Theme::css('css/styles.css');

    Theme::plugins('siteHead');
?>