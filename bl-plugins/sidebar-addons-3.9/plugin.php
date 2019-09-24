<?php

class SidebarAddonsPlugin extends Plugin
{

    /**
     * Skip common words InnoDB filter https://mariadb.com/kb/en/library/full-text-index-stopwords/
     */
    protected $blacklistWords = ['a', 'as', 'com', 'from', 'is', 'on', 'this', 'when',
        'with', 'about', 'at', 'de', 'how', 'it', 'or', 'to', 'where', 'und', 'an', 'be',
        'en', 'i', 'la', 'that', 'was', 'who', 'the', 'are', 'by', 'for', 'in', 'of',
        'the', 'what', 'will', 'www'];

    public function init()
    {
        // Defaults
        $this->dbFields = [
            'randomPagesLabel'       => 'Random Pages',
            'recommendedPagesLabel'  => 'Recommended Pages',
            'numberOfItems'          => 5,
            'showRandomPages'        => true,
            'showRecommendedPages'   => true
        ];
    }

    // Plugin Settings Admin Area
    public function form()
    {
        global $L;

        $html = '';

        // Toggle Random Pages
        $html  .= '<div>';
        $html .= '<label>' . $L->get('show-random-pages') . '</label>';
        $html .= '<select name="showRandomPages">';
        $html .= '<option value="true" ' . ($this->getValue('showRandomPages') === true ? 'selected' : '') . '>Enabled</option>';
        $html .= '<option value="false" ' . ($this->getValue('showRandomPages') === false ? 'selected' : '') . '>Disabled</option>';
        $html .= '</select>';
        $html .= '</div>';

        // Toggle Recommended pages
        $html .= '<div>';
        $html .= '<label>' . $L->get('show-recommended-pages') . '</label>';
        $html .= '<select name="showRecommendedPages">';
        $html .= '<option value="true" ' . ($this->getValue('showRecommendedPages') === true ? 'selected' : '') . '>Enabled</option>';
        $html .= '<option value="false" ' . ($this->getValue('showRecommendedPages') === false ? 'selected' : '') . '>Disabled</option>';
        $html .= '</select>';
        $html .= '</div>';

        // Set Sidebar Labels
        $html .= '<div>';
        $html .= '<label>'.$L->get('random-pages-label').'</label>';
        $html .= '<input name="randomPagesLabel" type="text" value="'.$this->getValue('randomPagesLabel').'">';
        $html .= '</div>';

        $html .= '<div>';
        $html .= '<label>'.$L->get('recommended-pages-label').'</label>';
        $html .= '<input name="recommendedPagesLabel" type="text" value="'.$this->getValue('recommendedPagesLabel').'">';
        $html .= '</div>';

        $html .= '<div>';
        $html .= '<label>'.$L->get('number-of-items').'</label>';
        $html .= '<input class="form-control" id="jsnumberOfItems" name="numberOfItems" type="number" min="1" value="'.$this->getValue('numberOfItems').'">';
        $html .= '</div>';

        return $html;
    }

    // Method called on the sidebar of the website
    public function siteSidebar()
    {
        $html = '';

        if ($this->getValue('showRandomPages')) {
            $randomPages = $this->getRandomPages();
            $html .= $this->displayPages($this->getValue('randomPagesLabel'), $randomPages);
        }

        if ($this->getValue('showRecommendedPages')) {
            /**
             * Only display on individual pages
             */
            global $url;
            if ($url->whereAmI() === 'page') {
                $currentPage = $url->slug();
                $recommendedPages = $this->getRecommendedPages($currentPage);
                $html .= $this->displayPages($this->getValue('recommendedPagesLabel'), $recommendedPages);
            }
        }

        return $html;
    }

    /**
     * Replace -, / to spaces and remove blacklisted words
     * @param  string $text [slug]
     * @return [string]     [simplified slug]
     */
    protected function removeUnnecessaryCharacters($text)
    {
        $tmp = str_replace(['-', '/'], ' ', $text);
        $tmp = explode(' ', $tmp);
        $tmp = implode(array_diff($tmp, $this->blacklistWords), ' ');
        return $tmp;
    }

    /**
     * [getPageList Get Page List From Db]
     * @return [array]
     */
    protected function getPageList()
    {
        global $pages;

        // Page number, the first page is 1
        $pageNumber = 1;

        // Get All Pages (filter published)
        $numberOfItems = -1;
        $onlyPublished = true;

        return $pages->getList($pageNumber, $numberOfItems, $onlyPublished);
    }

    /**
     * [Finds recommended pages based on the search string (usually slug)]
     * @param  [string] $searchString [Current page slug / search query]
     * @return [type] array         [Recommended pages results]
     */
    protected function getRecommendedPages($searchString)
    {

        $query = $this->removeUnnecessaryCharacters($searchString);
        $items = $this->getPageList();
        $results = [];

        foreach ($items as $pageKey) {
            // Skip if the current page is found.
            if ($searchString === $pageKey) {
                continue;
            }

            $pg = $this->removeUnnecessaryCharacters($pageKey);

            similar_text($query, $pg, $percent);
            if ($percent > 0) {
                $results[] = [
                    'page' => $pageKey,
                    'score' => $percent
                ];
            }
        }
        /**
         * Sort the results from high to low score
         */
        usort($results, function ($a, $b) {
            return $b['score'] > $a['score'] ;
        });

        // Slice results according to plugin config
        if (count($results) > $this->getValue('numberOfItems')) {
            $results = array_slice($results, 0, $this->getValue('numberOfItems'));
        }

        if (!empty($results)) {
            $results = array_column($results, 'page');
        }

        return $results;
    }

    /**
     * [getRandomPages]
     * @return [type] array [Random pages results]
     */
    protected function getRandomPages()
    {
        $items = $this->getPageList();

        $totalPages = count($items);
        $numberOfItems = $this->getValue('numberOfItems');
        // Fix edge case where numberOfItems exceeds totalPages
        if ($numberOfItems > $totalPages) {
            $numberOfItems = $totalPages;
        }

        $results = [];

        // Get random page keys only if total pages in db >= 1
        if ($totalPages >= 1) {
            $rand_pages = array_rand($items, $numberOfItems);

            /**
             * array_rand() returns datatype int if 1 , array datatype if >= 2
             */
            if (is_array($rand_pages)) {
                foreach ($rand_pages as $pageKey) {
                    $results[] = $items[$pageKey];
                }
            } else {
                $results[] = $items[$rand_pages];
            }
        }

        return $results;
    }

    /**
     * [displayPages Display Pages on Sidebar Template]
     * @param  [string] $pluginLabel [label]
     * @param  [array] $items       [pages]
     * @return [string]            [html response]
     */
    protected function displayPages($pluginLabel, $items)
    {
        $html = '';
        if (!empty($items)) {
            $html  = '<div class="plugin plugin-sidebar-addons">';
            $html .= '<h2 class="plugin-label">'.$pluginLabel.'</h2>';
            $html .= '<div class="plugin-content">';
            $html .= '<ul>';

            foreach ($items as $result) {
                // Create the page object from the page key
                $page = buildPage($result);
                $html .= "<li><a href='{$page->permalink()}'>{$page->title()}</a></li>";
            }
            $html .= '</ul>';
            $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
    }
}
