<?php
// make the donate block last for phones
$sidebar_second_copy = $page['sidebar_second'];
$donate_block = array_shift($sidebar_second_copy);
array_push($sidebar_second_copy, $donate_block);
$mobile_sidebar_second = render($sidebar_second_copy);
$page_header = render($page['header']);
?>

<div role="document" class="page">

    <?php

    include_once 'partials/header.php';
    include_once 'partials/nav.php';

    if($site_slogan)
        include_once 'partials/slogan.php';

    if($messages && !$zurb_foundation_messages_modal)
        include_once 'partials/messages.php';

    if(!empty($page['help']))
        include_once 'partials/help.php';

    if($is_front)
    {
        include_once 'partials/cm-home.php';
    }
    else
    {
        include_once 'partials/cm-page.php';
    }

    include_once 'partials/footer.php';

    if($messages && $zurb_foundation_messages_modal)
        print $messages;

    ?>

</div>
