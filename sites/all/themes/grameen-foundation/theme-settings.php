<?php
/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function grameen_foundation_form_system_theme_settings_alter(&$form, &$form_state) {
    // a grouping for our custom setting(s)
    $cm_template_setting = array(
        'template_use_cm' => array(
            '#type' => 'fieldset',
            '#title' => t('CM Template Settings'),
        )
    );

    // the custom setting we'll call in the page.tpl.php file
    $cm_template_setting['template_use_cm']['template_page_use_cm'] = array(
        '#type' => 'checkbox',
        '#title' => t('Use CM Page Template'),
        '#description' => t('Do you want to use the CM page template [essentially changing the site theme]?'),
        '#options' => array(
            0 => t('No'),
            1 => t('Yes'),
        ),
        '#default_value' => theme_get_setting('template_page_use_cm'),
    );

    // prepend it to the zurb general settings for easy viewing
    $form['zurb_foundation']['general'] = $cm_template_setting + $form['zurb_foundation']['general'];
}
