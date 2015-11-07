<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */

$node = node_load($view->result[0]->nid);
$image = field_get_items('node', $node, 'field_block_image');
$body = field_get_items('node', $node, 'body');

?>
<div class="row block-wrapper">
    <div class="large-5 columns image large-text-left medium-text-center small-text-center">
        <?php print render(field_view_value('node', $node, 'field_block_image', $image[0])); ?>
    </div>
    <div class="large-7 columns body">
        <?php print render(
            field_view_value(
                'node',
                $node,
                'body',
                $body[0],
                array(
                    'label' => 'hidden'
                )
            )
        ); ?>
    </div>
</div>
<div class="clearfix"></div>
