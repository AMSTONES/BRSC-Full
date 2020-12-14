<?php

function display_subpage_nav_func(){


  $currentPage = (get_the_ID());
  $pageChildren = get_children($currentPage);

  $reindex = [];
  foreach ($pageChildren as $subpage) {
    array_push($reindex, $subpage);
  }

  $pairedItems = array_chunk($reindex, 2);
  ob_start();
  ?>
  <div class='nav-image-flex-container'>
  <?php
  display_nav_pairs($pairedItems, $location);
  ?>
</div>
  <?php
  $ob_str=ob_get_contents();
    print_r($ob_str);
    ob_end_clean();
    return $ob_str;
  }
