<?php
require_once('../inc/pages.class.php');
require_once('../inc/newsArticle.class.php');
$page = new pages();
$news = new newsArticle(10);

$isHomePage = False;

if (isset($_GET['page']) && !empty($_GET['page']))
{
	$urlKey = filter_var($_GET['page'], FILTER_SANITIZE_STRING);
	if ($urlKey == 'home')
	{
    	$isHomePage = True;
	}
}
else
{
    $urlKey = "home";
    $isHomePage = True;
}

if (!$page->loadByURLKey($urlKey))
{
    // failed to get a page
    $urlKey = "home";
    $page->loadByURLKey($urlKey);
    $isHomePage = True;
}


$pageData = $page->data;
$pageData['title'] = $pageData['pages_title'];
$pageData['meta'] = $pageData['pages_meta'];
$pageData['h1'] = $pageData['pages_h1'];
$pageData['subheader'] = $pageData['pages_subheader'];
$pageData['content'] = $pageData['pages_content'];

$menuSTMT = $page->getList();
$newsParams = array('page' => 1 );
$newsSTMT = $news->getReportData($newsParams);

include_once('../tpl/page_view.tpl.php');

?>
