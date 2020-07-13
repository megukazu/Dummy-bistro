<aside class="archive">
  <h2 class="archive_title">月別アーカイブ</h2>
  <ul class="archive_list">
    <?php
      $args = array(
        'type' => 'monthly', //月別を指定
      );
      wp_get_archives( $args );
     ?>
  </ul>
</aside>
