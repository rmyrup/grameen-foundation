<?php if ($top_bar): ?>

    <!--.top-bar -->
    <?php if ($top_bar_classes): ?>
        <div class="top-bar-wrap cm-override <?php print $top_bar_classes; ?>">
    <?php endif; ?>

        <nav class="top-bar cm-override" data-topbar <?php print $top_bar_options; ?>>
            <ul class="title-area">
                <li class="name"><h1><?php print $linked_site_name; ?></h1></li>
                <li class="toggle-topbar menu-icon">
                    <a href="#"><span><?php print $top_bar_menu_text; ?> <i class="fa fa-bars"></i></span></a>
                    <a href="http://action.grameenfoundation.org/" class="button-donate" target="_blank">
                        <span>Donate Now</span>
                    </a>
                </li>
            </ul>
            <section class="top-bar-section cm-override">
                <?php if ($top_bar_main_menu) :?>
                    <?php print $top_bar_main_menu; ?>
                <?php endif; ?>
                <?php if ($top_bar_secondary_menu) :?>
                    <?php //print $top_bar_secondary_menu; ?>
                <?php endif; ?>
            </section>
        </nav>

    <?php if ($top_bar_classes): ?>
            <div class="clearfix"></div>
        </div>
    <?php endif; ?>
    <!--/.top-bar -->

<?php endif; ?>

