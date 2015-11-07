<?php

$menu_tree = menu_build_tree(
    'main-menu',
    array(
        'min_depth' => 1,
        'max_depth' => 2
    )
);

$to_output = array();

if(!empty($menu_tree))
{
    foreach($menu_tree as $item)
    {
        if(strtolower($item['link']['link_title']) == 'home')
            continue;

        $children = array();

        if(!empty($item['below']))
        {
            foreach($item['below'] as $item_below)
            {
                $children[] = array(
                    'link_to' => url($item_below['link']['link_path']),
                    'link_text' => $item_below['link']['link_title']
                );
            }
        }

        $to_output[] = array(
            'link_to' => url($item['link']['link_path']),
            'link_text' => $item['link']['link_title'],
            'children' => $children
        );
    }
}

function _render_footer_menu_partial($menu, $i)
{
    if(empty($menu[$i]))
        return;

    $menu_partial = $menu[$i];
    
    echo '<a class="footer-nav-header" href="' . $menu_partial['link_to'] . '"><strong>' . $menu_partial['link_text'] . '</strong></a>';

    echo '<ul>';

    foreach($menu_partial['children'] as $item)
    {
        echo '<li>';
            echo '<a href="' . $item['link_to'] . '">' . $item['link_text'] . '</a>';
        echo '</li>';
    }

    echo '</ul>';
}

?>
<footer>
    <div class="footer-nav">
        <div class="row hide-for-small-only">
            <div class="small-2 columns" id="col_1">
                <?php _render_footer_menu_partial($to_output, 0); ?>
            </div>
            <div class="small-2 columns" id="col_2">
                <?php _render_footer_menu_partial($to_output, 1); ?>
                <?php _render_footer_menu_partial($to_output, 2); ?>
            </div>
            <div class="small-2 columns" id="col_3">
                <?php _render_footer_menu_partial($to_output, 3); ?>
                <?php _render_footer_menu_partial($to_output, 4); ?>
            </div>
            <div class="small-2 columns" id="col_4">
                <?php _render_footer_menu_partial($to_output, 5); ?>
                <?php _render_footer_menu_partial($to_output, 6); ?>
            </div>
            <div class="small-2 columns" id="col_5">
                <?php _render_footer_menu_partial($to_output, 7); ?>
            </div>
            <div class="small-2 columns" id="col_6">
                <?php print render($page['cm_footer_nav']); ?>
            </div>
        </div>

        <div class="hide-for-medium-up">
            <div class="row">
                <div class="small-12 columns">
                    <ul class="menu">
                        <li class="odd"><a href="/contact">contact us</a></li>
                        <li class="even"><a href="/about/careers">careers</a></li>
                        <li class="odd"><a href="/news-events/press-room">press room</a></li>
                        <li class="last even"><a href="/blog">blog</a></li>
                    </ul>
                </div>
                <div class="small-12 columns region-cm-footer-nav">
                    <?php print render($page['cm_footer_nav']); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bugs">
        <div class="row">
            <div class="small-12 medium-6 large-6 columns">
                <p>&copy; <?php echo date('Y'); ?> Grameen Foundation</p>
                <p><a class="link grameen-blue" href="/sitemap">site map</a> | <a class="link grameen-blue" href="/privacy-policy">privacy policy</a></p>
            </div>
            <div class="small-12 medium-6 large-6 columns small-only-text-left medium-text-right">
                <p>Seattle Website Design by Clocktower Media</p>
            </div>
        </div>
    </div>
</footer>