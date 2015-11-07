<?php

// check if set to use CM template files, or the original ones
$theme_setting = theme_get_setting('template_page_use_cm');

if(!empty($theme_setting) && is_int($theme_setting) && $theme_setting == 1)
{
    include_once 'page.cm.tpl.php';
}
else
{
    include_once 'page.not-cm.tpl.php';
}