<?php
  // make the donate block last for phones
  $sidebar_second_copy = $page['sidebar_second'];
  $donate_block = array_shift($sidebar_second_copy); 
  array_push($sidebar_second_copy, $donate_block);
  $mobile_sidebar_second = render($sidebar_second_copy);
  $page_header = render($page['header']);
?>
<!--.page -->
<div role="document" class="page"> 

  <header role="banner" class="l-header row" id="header">
    <?php if ($linked_site_name || $linked_logo): ?>
      <div class="small-7 medium-4 columns logo">
        <?php if ($linked_logo): ?>
          <?php print $linked_logo; ?>
        <?php endif; ?>
        <div class="show-for-799-down hide-for-799-up"><?php print $page_header;?></div>
      </div>
      <div class="small-5 medium-8 columns top-right">
        <div class="hide-for-799-down"><?php print $page_header;?></div>
        <div class="">
          <a href="/give-a-gift" title="Donate" id="donate_mobile" class="button">Donate</a>
        </div>
      </div>
    <?php endif; ?>
  </header>

  <div class="row show-for-small-only">
    <div class="small-12 columns small-search hide">
      <?=$page_header?>
    </div>
  </div>

<!--   <div class="row hide-for-medium-up">
    <div class="small-12 columns">
      <a href="/give-a-gift" title="Donate" id="donate_mobile" class="button">Donate</a>
    </div>
  </div> -->

  <?php if ($top_bar): ?>
    <!--.top-bar -->
    <?php if ($top_bar_classes): ?>
    <div class="<?php print $top_bar_classes; ?>">
    <?php endif; ?>
      <nav class="top-bar" data-topbar <?php print $top_bar_options; ?>>
        <ul class="title-area">
          <li class="name"><h1><?php print $linked_site_name; ?></h1></li>
          <li class="toggle-topbar menu-icon"><a href="#"><span><?php print $top_bar_menu_text; ?></span></a></li>
        </ul>
        <section class="top-bar-section">
          <?php if ($top_bar_main_menu) :?>
            <?php print $top_bar_main_menu; ?>
          <?php endif; ?>
          <?php if ($top_bar_secondary_menu) :?>
            <?php //print $top_bar_secondary_menu; ?>
          <?php endif; ?>
        </section>
      </nav>
    <?php if ($top_bar_classes): ?>
    </div>
    <?php endif; ?>
    <!--/.top-bar -->
  <?php endif; ?>

  <?php if ($site_slogan): ?>
    <div class="row">
      <div class="small-12 columns panel radius">
        <?php print $site_slogan; ?>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($messages && !$zurb_foundation_messages_modal): ?>
    <!--/.l-messages -->
    <section class="l-messages row">
      <div class="large-12 columns">
        <?php if ($messages): print $messages; endif; ?>
      </div>
    </section>
    <!--/.l-messages -->
  <?php endif; ?>

  <?php if (!empty($page['help'])): ?>
    <!--/.l-help -->
    <section class="l-help row">
      <div class="large-12 columns">
        <?php print render($page['help']); ?>
      </div>
    </section>
    <!--/.l-help -->
  <?php endif; ?>

  <?php if ($is_front): ?>
    <?php require_once 'home-2.tpl.php'; ?>
  <?php else: ?>
    <div class="row top-stripe">
      <div id="main" class="<?php print $main_grid; ?> columns">
        <?php if (!empty($page['highlighted'])): ?>
          <div class="highlight panel callout">
            <?php print render($page['highlighted']); ?>
          </div>
        <?php endif; ?>
        <a id="main-content"></a>
        <?php if ($title && !$is_front): ?>
          <?php print render($title_prefix); ?>
          <h1 id="page-title" class="title"><?php print $title; ?></h1>
          <?php print render($title_suffix); ?>
        <?php endif; ?>

        <?php if ($breadcrumb): print $breadcrumb; endif; ?>

        <?php if (!empty($tabs)): ?>
          <?php print render($tabs); ?>
          <?php if (!empty($tabs2)): print render($tabs2); endif; ?>
        <?php endif; ?>
        <?php if ($action_links): ?>
          <ul class="action-links">
            <?php print render($action_links); ?>
          </ul>
        <?php endif; ?>
        <?php print render($page['content']); ?>
      </div>
      <?php if (!empty($page['sidebar_first'])): ?>
        <div id="sidebar-first" class="<?php print $sidebar_first_grid; ?> columns sidebar">
          <?php print render($page['sidebar_first']); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($page['sidebar_second'])): ?>
        <div id="sidebar-second" class="<?php print $sidebar_sec_grid; ?> columns sidebar" style="padding-right: 0;">
          <?php print render($page['sidebar_second']); ?>
        </div>
      <?php endif; ?>
    </div>

    <?php 
      if (!empty($page['sidebar_second'])): ?>
        <div class="row" style="display: none;">
          <!-- tablets -->
          <div id="sidebar-second" class="twelve columns sidebar show-for-tablet padding-right">
            <?php print render($page['sidebar_second']); ?>
          </div>
          <!-- phones -->
          <div id="sidebar-second" class="twelve columns sidebar show-for-phone">
            <?php print $mobile_sidebar_second; ?>
          </div>
        </div>
    <?php endif; ?>
  <?php endif; // home page check ?>

  <div class="bottom-bar panel top-stripe" id="last">
    <?php if (!empty($page['footer_first']) || !empty($page['footer_middle']) || !empty($page['footer_last'])): ?>
    <footer class="row show-for-phone">
      <?php if (!empty($page['footer_first'])): ?>
        <div id="footer-first" class="four columns">
          <?php print render($page['footer_first']); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($page['footer_middle'])): ?>
        <div id="footer-middle" class="four columns">
          <?php print render($page['footer_middle']); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($page['footer_last'])): ?>
        <div id="footer-last" class="four columns">
          <?php print render($page['footer_last']); ?>
        </div>
      <?php endif; ?>
    </footer>
    <?php endif; ?> 

    <div class="row hide-for-small-only" id="footer_sitemap">
      <div class="small-2 columns" id="col_1"></div>
      <div class="small-2 columns" id="col_2"></div>
      <div class="small-2 columns" id="col_3"></div>
      <div class="small-2 columns" id="col_4"></div>
      <div class="small-2 columns" id="col_5"></div>
      <div class="small-2 columns" id="col_6"></div>
    </div>

    <div class="row show-for-phone">
      <div class="small-12 columns">
        <ul class="menu">
          <li class="first odd"><a href="/sitemap">site map</a></li>
          <li class="even"><a href="/privacy-policy">privacy policy</a></li>
          <li class="odd"><a href="/contact">contact us</a></li>
          <li class="even"><a href="/about/careers">careers</a></li>
          <li class="odd"><a href="/news-events/press-room">press room</a></li>
          <li class="last even"><a href="/blog">blog</a></li>
        </ul>
        <p class="copy-phone">&copy; <?=date('Y')?> Grameen Foundation</p>
        <div class="right">
          <a href="http://www.charitynavigator.org/index.cfm?bay=search.summary&orgid=7723" target="_blank"><img src="/sites/all/themes/grameen-foundation/images/charity-nav-logo-3.png" alt="Charity Navigator"></a>
          <a href="http://charityreports.bbb.org/public/seal.aspx?ID=34020122007" title="BBB Rating" target="_blank"><img src="/sites/all/themes/grameen-foundation/images/bbb-footer-logo.png" alt="BBB Rating"></a>
        </div>
        <p class="site_by">site design and development by <a target="_blank" href="http://www.fireflypartners.com/">Firefly Partners</a></p>
      </div>
    </div>

    <div class="row show-for-tablet show-for-desk">
      <div class="small-4 columns">
        <?php if (!empty($page['footer_first'])): ?>
          <div id="footer-first" class="">
            <?php print render($page['footer_first']); ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="small-4 columns" id="footer-bottom-middle">
        <p><a href="/sitemap">site map</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="/privacy-policy">privacy policy</a></p>
        <p class="copy-phone">&copy; <?=date('Y')?> Grameen Foundation</p>
      </div>
      <div class="small-4 columns" id="footer-bottom-right">
        <p><a href="http://www.charitynavigator.org/index.cfm?bay=search.summary&orgid=7723" target="_blank"><img src="/sites/all/themes/grameen-foundation/images/charity-nav-logo-3.png" alt="Charity Navigator"></a>
        <a href="http://charityreports.bbb.org/public/seal.aspx?ID=34020122007" title="BBB Rating" target="_blank"><img src="/sites/all/themes/grameen-foundation/images/bbb-footer-logo.png" alt="BBB Rating"></a></p>
        <p class="site_by">site design and development<br>by <a target="_blank" href="http://www.fireflypartners.com/">Firefly Partners</a></p>
      </div>
    </div>
  </div>

  <?php if ($messages && $zurb_foundation_messages_modal): print $messages; endif; ?>
</div>
<!--/.page -->



