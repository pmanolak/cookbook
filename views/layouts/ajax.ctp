<?php /* SVN FILE: $Id: ajax.ctp 600 2008-08-07 17:55:23Z AD7six $ */
$session->flash('auth');
$session->flash();
echo $content_for_layout;
//echo $miJavascript->link();
?>