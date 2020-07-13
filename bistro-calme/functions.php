<?php
  /**
   * <title>タグを出力する
   */
  add_theme_support('title-tag');

  add_filter('document_title_separator', 'my_document_title_separator');
  function my_document_title_separator($separator) {
    $separator = '|';
    return $separator;
  }

  add_filter('document_title_parts', 'my_document_title_parts');
  function my_document_title_parts($title) {
    if(is_home()) {
      unset($title['tagline']); //タグライン削除
      $title['title'] = 'BISTRO CALMEは、カジュアルなワインバーよりなビストロです。'; // テキスト変更
    }
    return $title;
  }

  /**
   * アイキャッチ画像を使用可能にする
   */
  add_theme_support('post-thumbnails');

  /**
   * カスタムメニュー機能を使用可能にする
   */
  add_theme_support('menus');

  /**
   * コメント欄の項目設定
   */
  add_filter('comment_form_default_fields','my_comment_form_default_fields');
  function my_comment_form_default_fields($args) {
    $args['args'] = ''; //[名前]
    $args['email'] = ''; //[メールアドレス]
    $args['url'] = ''; //[サイト]削除
    return $args;
  }

  /**
   * 投稿数設定
   */
  add_action('pre_get_posts', 'my_pre_get_posts');
  function my_pre_get_posts($query){
    // 管理画面、メインクエリ以外には設定しない
    if(is_admin() || !$query->is_main_query()) {
      return;
    }

    // トップページの場合
    if($query->is_home()) {
      $query->set('posts_per_page',3);
      return;
    }

    if($query->is_home()) {
      $query->set('category_name','news');
      return;
    }

    // カテゴリーページ
    if($query->is_category()) {
      $query->set('nopaging',true);
      return;
    }

    /**
     * contact auto pタグ削除
     */
    add_action('wp','my_wpautop');
    function my_wpautop() {
      if(is_page('contact')) {
        remove_filter('the_content','wpautop');
      }
    }
  };
?>
