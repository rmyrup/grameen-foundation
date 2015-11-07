<div class="bg-grameen-sand">
    <header class="row">
        <?php if ($linked_site_name || $linked_logo): ?>
            <div class="small-7 medium-4 columns logo">
                <?php if ($linked_logo): ?>
                    <?php print $linked_logo; ?>
                <?php endif; ?>
            </div>
            <div class="small-5 medium-8 columns top-right region-header hide-for-small">
                <div class="region-header-contents">
                    <div class="region-cm-header">
                        <?php print render($page['cm_header']); ?>
                        <div class="search-form-trigger">
                            <button type="button"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="region-cm-header-search">
                        <div class="search-form-wrapper">
                            <?php print render($page['cm_header_search']); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </header>
</div>

<?php /*
<div class="row show-for-small-only">
    <div class="small-12 columns small-search hide">
        <?= $page_header ?>
    </div>
</div>
*/ ?>