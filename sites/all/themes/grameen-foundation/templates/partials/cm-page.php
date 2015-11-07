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
