<?php
require_once('../inc/pages.class.php');
$page = new pages();


if (isset($_GET['page']) && !empty($_GET['page']))
{
    $page->loadByURLKey(filter_var($_GET['page'], FILTER_SANITIZE_STRING));
    $pageData = $page->data;
}
else
{
    $page->loadByURLKey('home');
    $pageData = $page->data;
}

$menuSTMT = $page->getList();

include_once('../tpl/page_view.tpl.php');

?>
