<?php
/**
 * Implements template_preprocess_page
 *
 * Add convenience variables and template suggestions
 */
function grameen_foundation_preprocess_page(&$variables) {
    // Add page--node_type.tpl.php suggestions
    if (!empty($variables['node'])) {
        $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->type;
    }

    $variables['logo_img'] = '';
    if (!empty($variables['logo'])) {
        $variables['logo_img'] = theme('image', array(
            'path'  => $variables['logo'],
            'alt'   => strip_tags($variables['site_name']) . ' ' . t('logo'),
            'title' => strip_tags($variables['site_name']) . ' ' . t('Home'),
            'attributes' => array(
                'class' => array('logo'),
            ),
        ));
    }

    $variables['linked_logo']  = '';
    if (!empty($variables['logo_img'])) {
        $variables['linked_logo'] = l($variables['logo_img'], '<front>', array(
            'attributes' => array(
                'rel'   => 'home',
                'title' => strip_tags($variables['site_name']) . ' ' . t('Home'),
            ),
            'html' => TRUE,
        ));
    }

    $variables['linked_site_name'] = '';
    if (!empty($variables['site_name'])) {
        $variables['linked_site_name'] = l($variables['site_name'], '<front>', array(
            'attributes' => array(
                'rel'   => 'home',
                'title' => strip_tags($variables['site_name']) . ' ' . t('Home'),
            ),
        ));
    }

    // Top bar.
    if ($variables['top_bar'] = theme_get_setting('zurb_foundation_top_bar_enable')) {
        $top_bar_classes = array();

        if (theme_get_setting('zurb_foundation_top_bar_grid')) {
            $top_bar_classes[] = 'contain-to-grid';
        }

        if (theme_get_setting('zurb_foundation_top_bar_sticky')) {
            $top_bar_classes[] = 'sticky';
        }

        if ($variables['top_bar'] == 2) {
            $top_bar_classes[] = 'show-for-small';
        }

        $variables['top_bar_classes'] = implode(' ', $top_bar_classes);
        $variables['top_bar_menu_text'] = check_plain(theme_get_setting('zurb_foundation_top_bar_menu_text'));

        $top_bar_options = array();

        if (!theme_get_setting('zurb_foundation_top_bar_custom_back_text')) {
            $top_bar_options[] = 'custom_back_text:false';
        }

        if ($back_text = check_plain(theme_get_setting('zurb_foundation_top_bar_back_text'))) {
            if ($back_text !== 'Back') {
                $top_bar_options[] = "back_text:{$back_text}";
            }
        }

        if (!theme_get_setting('zurb_foundation_top_bar_is_hover')) {
            $top_bar_options[] = 'is_hover:false';
        }

        if (!theme_get_setting('zurb_foundation_top_bar_scrolltop')) {
            $top_bar_options[] = 'scrolltop:false';
        }

        $variables['top_bar_options'] = ' data-options="' . implode('; ', $top_bar_options) . '"';
    }

    // Alternative header.
    // This is what will show up if the top bar is disabled or enabled only for
    // mobile.
    if ($variables['alt_header'] = ($variables['top_bar'] != 1)) {
        // Hide alt header on mobile if using top bar in mobile.
        $variables['alt_header_classes'] = $variables['top_bar'] == 2 ? ' hide-for-small' : '';
    }

    // Menus for alternative header.
    $variables['alt_main_menu'] = '';

    if (!empty($variables['main_menu'])) {
        $variables['alt_main_menu'] = theme('links__system_main_menu', array(
            'links' => $variables['main_menu'],
            'attributes' => array(
                'id' => 'main-menu-links',
                'class' => array('links', 'inline-list', 'clearfix'),
            ),
            'heading' => array(
                'text' => t('Main menu'),
                'level' => 'h2',
                'class' => array('element-invisible'),
            ),
        ));
    }

    $variables['alt_secondary_menu'] = '';

    if (!empty($variables['secondary_menu'])) {
        $variables['alt_secondary_menu'] = theme('links__system_secondary_menu', array(
            'links' => $variables['secondary_menu'],
            'attributes' => array(
                'id' => 'secondary-menu-links',
                'class' => array('links', 'clearfix'),
            ),
            'heading' => array(
                'text' => t('Secondary menu'),
                'level' => 'h2',
                'class' => array('element-invisible'),
            ),
        ));
    }

    // Top bar menus.
    $variables['top_bar_main_menu'] = '';
    if (!empty($variables['main_menu'])) {
        $variables['top_bar_main_menu'] = theme('links__topbar_main_menu', array(
            'links' => $variables['main_menu'],
            'attributes' => array(
                'id' => 'main-menu',
                'class' => array('main-nav'),
            ),
            'heading' => array(
                'text' => t('Main menu'),
                'level' => 'h2',
                'class' => array('element-invisible'),
            ),
        ));
    }

    $variables['top_bar_secondary_menu'] = '';
    if (!empty($variables['secondary_menu'])) {
        $variables['top_bar_secondary_menu'] = theme('links__topbar_secondary_menu', array(
            'links' => $variables['secondary_menu'],
            'attributes' => array(
                'id'    => 'secondary-menu',
                'class' => array('secondary', 'link-list'),
            ),
            'heading' => array(
                'text' => t('Secondary menu'),
                'level' => 'h2',
                'class' => array('element-invisible'),
            ),
        ));
    }

    // Messages in modal.
    $variables['zurb_foundation_messages_modal'] = theme_get_setting('zurb_foundation_messages_modal');

    // Convenience variables
    if (!empty($variables['page']['sidebar_first'])){
        $left = $variables['page']['sidebar_first'];
    }

    if (!empty($variables['page']['sidebar_second'])) {
        $right = $variables['page']['sidebar_second'];
    }

    // Dynamic sidebars
    if (!empty($left) && !empty($right)) {
        $variables['main_grid'] = 'large-6 large-push-3';
        $variables['sidebar_first_grid'] = 'large-3 large-pull-6';
        $variables['sidebar_sec_grid'] = 'large-3';
    } elseif (empty($left) && !empty($right)) {
        $variables['main_grid'] = 'medium-8';
        $variables['sidebar_first_grid'] = '';
        $variables['sidebar_sec_grid'] = 'medium-4';
    } elseif (!empty($left) && empty($right)) {
        $variables['main_grid'] = 'large-9 large-push-3';
        $variables['sidebar_first_grid'] = 'large-3 large-pull-9';
        $variables['sidebar_sec_grid'] = '';
    } else {
        $variables['main_grid'] = 'large-12';
        $variables['sidebar_first_grid'] = '';
        $variables['sidebar_sec_grid'] = '';
    }

    // Ensure modal reveal behavior if modal messages are enabled.
    if(theme_get_setting('zurb_foundation_messages_modal')) {
        drupal_add_js(drupal_get_path('theme', 'zurb_foundation') . '/js/behavior/reveal.js');
    }
}



/**
 * Add body classes if certain regions have content.
 */
function grameen_foundation_preprocess_html(&$variables) {

    // check if set to use CM template files, or the original ones
    $theme_setting = theme_get_setting('template_page_use_cm');

    if(!empty($theme_setting) && is_int($theme_setting) && $theme_setting == 1)
    {
        // add class to body
        $variables['classes_array'][] = 'cm';
    }

        // add meta desc to the front page ONLY with this conditional
    if (drupal_is_front_page()) {
        $meta_desc_render = array(
            '#type' => 'html_tag',
            '#tag'  => 'meta',
            '#attributes' => array(
                'name' => 'description',
                'content' => 'Grameen Foundation helps the world’s poorest people reach their full potential, connecting their determination and skills with the resources they need.'
            )
        );
        drupal_add_html_head($meta_desc_render, 'meta_desc_render');
    }

    // now add the google verification, this will add it to every page - <meta name="google-site-verification" content="CngEB6C_OLBDreXBJm4pp7wvezJ24le1E-R87bwNGOY" />
    $meta_google_render = array(
        '#type' => 'html_tag',
        '#tag'  => 'meta',
        '#attributes' => array(
            'name' => 'google-site-verification',
            'content' => 'CngEB6C_OLBDreXBJm4pp7wvezJ24le1E-R87bwNGOY'
        )
    );
    drupal_add_html_head($meta_google_render, 'meta_google_render');

    // here we want to see if we have any meta keys/desc to add
    // 1st we check if we have a valid node
    $node_check = node_load(arg(1));
    if ($node_check) {
        if (!empty($node_check->field_meta_description)) {
            $meta_desc = $node_check->field_meta_description['und'][0]['safe_value'];
            $meta_desc_render = array(
                '#type' => 'html_tag',
                '#tag'  => 'meta',
                '#attributes' => array(
                    'name' => 'description',
                    'content' => $meta_desc
                )
            );
            drupal_add_html_head($meta_desc_render, 'meta_desc_render');
        }
        if (!empty($node_check->field_meta_keywords)) {
            $meta_keys = $node_check->field_meta_keywords['und'][0]['safe_value'];
            $meta_keys_render = array(
                '#type' => 'html_tag',
                '#tag'  => 'meta',
                '#attributes' => array(
                    'name' => 'keywords',
                    'content' => $meta_keys
                )
            );
            drupal_add_html_head($meta_keys_render, 'meta_keys_render');
        }
    }
    // end meta stuff

    drupal_add_css(path_to_theme() . '/css/ie.css', array('weight' => CSS_THEME, 'browsers' => array('!IE' => FALSE), 'preprocess' => FALSE));
    drupal_add_css('//cloud.webtype.com/css/69f5bfc5-a208-4d04-b2e6-93dddbe70d0f.css', 'external');

    // map
    if (@strpos($node_check->title, 'Map') !== FALSE) {
        drupal_add_css('sites/all/themes/grameen-foundation/css/jquery-jvectormap-1.1.1.css');
        //drupal_add_js('sites/all/themes/grameen-foundation/js/jquery.js');
        drupal_add_js('sites/all/themes/grameen-foundation/js/min/jquery-jvectormap-1.1.1.min.js');
        drupal_add_js('sites/all/themes/grameen-foundation/js/jquery-jvectormap-world-mill-en.js');
    }
    // custom js, added here and not in .info for map loading order
    // drupal_add_js('sites/all/themes/grameen-foundation/js/scripts.js', $options = array('cache' => FALSE));
    // drupal_add_js('sites/all/themes/grameen-foundation/js/map.js');
    // font loading stuff
    //drupal_add_js('//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js', 'external');
    //drupal_add_js('https://www.2dialog.com/grameen/sf/prototype/js/scriptaculous.js', 'external');
    //drupal_add_js("WebFont.load({ google: { families: ['Ubuntu:300,400,500', 'Roboto:400,500,700'] } });", array('type' => 'inline', 'scope' => 'footer'));
}

/**
 * Override or insert variables into the page template.
 */
function grameen_foundation_process_page(&$variables) {

    $variables['hide_site_name'] = true;
    // Always print the site name and slogan, but if they are toggled off, we'll
    // just hide them visually.
    //$variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
    $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
    if ($variables['hide_site_name']) {
        // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
        $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
    }
    if ($variables['hide_site_slogan']) {
        // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
        $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
    }
    // Since the title and the shortcut link are both block level elements,
    // positioning them next to each other is much simpler with a wrapper div.
    if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
        // Add a wrapper div using the title_prefix and title_suffix render elements.
        $variables['title_prefix']['shortcut_wrapper'] = array(
            '#markup' => '<div class="shortcut-wrapper clearfix">',
            '#weight' => 100,
        );
        $variables['title_suffix']['shortcut_wrapper'] = array(
            '#markup' => '</div>',
            '#weight' => -99,
        );
        // Make sure the shortcut link is the first item in title_suffix.
        $variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
    }
}

// /**
//  * Implements hook_preprocess_maintenance_page().
//  */
// function grameen_foundation_preprocess_maintenance_page(&$variables) {
//   // By default, site_name is set to Drupal if no db connection is available
//   // or during site installation. Setting site_name to an empty string makes
//   // the site and update pages look cleaner.
//   // @see template_preprocess_maintenance_page
//   if (!$variables['db_is_active']) {
//     $variables['site_name'] = '';
//   }
//   drupal_add_css(drupal_get_path('theme', 'grameen_foundation') . '/css/maintenance-page.css');
// }

// /**
//  * Override or insert variables into the maintenance page template.
//  */
// function grameen_foundation_process_maintenance_page(&$variables) {
//   // Always print the site name and slogan, but if they are toggled off, we'll
//   // just hide them visually.
//   $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
//   $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
//   if ($variables['hide_site_name']) {
//     // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
//     $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
//   }
//   if ($variables['hide_site_slogan']) {
//     // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
//     $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
//   }
// }

// /**
//  * Override or insert variables into the node template.
//  */
// function grameen_foundation_preprocess_node(&$variables) {
//   if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
//     $variables['classes_array'][] = 'node-full';
//   }
// }

// /**
//  * Override or insert variables into the block template.
//  */
// function grameen_foundation_preprocess_block(&$variables) {
//   // In the header region visually hide block titles.
//   if ($variables['block']->region == 'header') {
//     $variables['title_attributes_array']['class'][] = 'element-invisible';
//   }
// }

// /**
//  * Implements theme_menu_tree().
//  */
function grameen_foundation_menu_tree($variables) {
    return '<ul class="nav-bar">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function grameen_foundation_field__taxonomy_term_reference($variables) {
    $output = '';

    // Render the label, if it's not hidden.
    if (!$variables['label_hidden']) {
        $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
    }

    // Render the items.
    $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
    foreach ($variables['items'] as $delta => $item) {
        $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
    }
    $output .= '</ul>';

    // Render the top-level DIV.
    $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '">' . $output . '</div>';

    return $output;
}



// below is default zurb stuff



/**
 * Implements theme_links() targeting the main menu specifically
 * Outputs Foundation Nav bar http://foundation.zurb.com/docs/navigation.php
 *
 */
// function grameen_foundation_links__system_main_menu($vars) {
//  // Get all the main menu links
//  $menu_links = menu_tree_output(menu_tree_all_data('main-menu'));

//  // Initialize some variables to prevent errors
//  $output = '';
//  $sub_menu = '';

//  foreach ($menu_links as $key => $link) {
//    // Add special class needed for Foundation dropdown menu to work
//    !empty($link['#below']) ? $link['#attributes']['class'][] = 'has-flyout' : '';

//    // Render top level and make sure we have an actual link
//    if (!empty($link['#href'])) {
//      $output .= '<li' . drupal_attributes($link['#attributes']) . '>' . l($link['#title'], $link['#href']);
//      // Get sub navigation links if they exist
//      foreach ($link['#below'] as $key => $sub_link) {
//        if (!empty($sub_link['#href'])) {
//          $sub_menu .= '<li>' . l($sub_link['#title'], $sub_link['#href']) . '</li>';
//        }

//      }
//      $output .= !empty($link['#below']) ? '<a href="#" class="flyout-toggle"><span> </span></a><ul class="flyout">' . $sub_menu . '</ul>' : '';

//      // Reset dropdown to prevent duplicates
//      unset($sub_menu);
//      $sub_menu = '';

//      $output .=  '</li>';
//    }
//  }
//  return '<ul class="nav-bar">' . $output . '</ul>';
// }

/**
 * Implements template_preprocess_html().
 *
 */
//function grameen_foundation_preprocess_html(&$vars) {
//  // Add conditional CSS for IE. To use uncomment below and add IE css file
//  drupal_add_css(path_to_theme() . '/css/ie.css', array('weight' => CSS_THEME, 'browsers' => array('!IE' => FALSE), 'preprocess' => FALSE));
//
//  // Need legacy support for IE downgrade to Foundation 2 or use JS file below
//  // drupal_add_js('http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js', 'external');
//}

/**
 * Implements template_preprocess_page
 *
 */
//function grameen_foundation_preprocess_page(&$vars) {
//}

/**
 * Implements template_preprocess_node
 *
 */
//function grameen_foundation_preprocess_node(&$vars) {
//}

/**
 * Implements hook_preprocess_block()
 */
function grameen_foundation_preprocess_block(&$vars) {
    // Add wrapping div with global class to all block content sections.
    $vars['content_attributes_array']['class'][] = 'block-content';

    // Convenience variable for classes based on block ID
    $block_id = $vars['block']->module . '-' . $vars['block']->delta;

    // Add classes based on a specific block
    switch ($block_id) {
        // System Navigation block
        case 'system-navigation':
            // Custom class for entire block
            $vars['classes_array'][] = 'system-nav';
            // Custom class for block title
            $vars['title_attributes_array']['class'][] = 'system-nav-title';
            // Wrapping div with custom class for block content
            $vars['content_attributes_array']['class'] = 'system-nav-content';
            break;

        // User Login block
        case 'user-login':
            // Hide title
            $vars['title_attributes_array']['class'][] = 'element-invisible';
            break;

        // Example of adding Foundation classes
        case 'block-foo': // Target the block ID
            // Set grid column or mobile classes or anything else you want.
            $vars['classes_array'][] = 'six columns';
            break;
    }

    // Add template suggestions for blocks from specific modules.
    switch($vars['elements']['#block']->module) {
        case 'menu':
            $vars['theme_hook_suggestions'][] = 'block__nav';
            break;
    }
}


/**
 * Implements theme_form_element_label()
 * Use foundation tooltips
 */
function grameen_foundation_form_element_label($vars) {
    if (!empty($vars['element']['#title'])) {
        $vars['element']['#title'] = '<span class="secondary label">' . $vars['element']['#title'] . '</span>';
    }
    if (!empty($vars['element']['#description'])) {
        $vars['element']['#description'] = ' <span class="has-tip tip-top radius" data-width="250" title="' . $vars['element']['#description'] . '">' . t('More information?') . '</span>';
    }
    return theme_form_element_label($vars);
}

/**
 * Implements hook_preprocess_button().
 */
function grameen_foundation_preprocess_button(&$vars) {
    $vars['element']['#attributes']['class'][] = 'button';
    if (isset($vars['element']['#parents'][0]) && $vars['element']['#parents'][0] == 'submit') {
        $vars['element']['#attributes']['class'][] = 'secondary';
    }
}

/**
 * Implements hook_form_alter()
 * Example of using foundation sexy buttons
 */
function grameen_foundation_form_alter(&$form, &$form_state, $form_id) {
    if ($form_id == 'search_block_form') {
        $form['search_block_form']['#title'] = t('Search');
        $form['search_block_form']['#title_display'] = 'invisible';
        $form['search_block_form']['#attributes']['class'] = array();

        $form['actions']['submit']['#value'] = t('Search');
        $form['actions']['submit']['#attributes']['alt'] = "Search Button";

        // Add extra attributes to the text box
        $form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Search Site';}";
        $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Search Site') {this.value = '';}";
    }

    // Sexy submit buttons
    if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
        $form['actions']['submit']['#attributes'] = array('class' => array('primary', 'button', 'radius'));
    }
}

//Sexy preview buttons
function grameen_foundation_form_comment_form_alter(&$form, &$form_state)
{
    $form['actions']['preview']['#attributes']['class'][] = array('class' => array('secondary', 'button', 'radius'));
}
