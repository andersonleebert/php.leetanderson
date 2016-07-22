<?php

if ( !isset($_GET['r']) )
{
    $_GET['r'] = "pages";
}


switch ($_GET['r']) {
    case 'pages':
        $adminTemplatePath = "../tpl/page_list.tpl.php";
        $adminControllerPath = "../php/page_list.php";
        break;

    case 'page_edit':
        $adminTemplatePath = "../tpl/page_edit.tpl.php";
        $adminControllerPath = "../php/page_edit.php";
        break;

    case 'news':
        $adminTemplatePath = "../tpl/news_list.tpl.php";
        $adminControllerPath = "../php/news_list.php";
        break;

    case 'news_edit':
        $adminTemplatePath = "../tpl/news_edit.tpl.php";
        $adminControllerPath = "../php/news_edit.php";
        break;

    case 'users':
        $adminTemplatePath = "../tpl/user_list.tpl.php";
        $adminControllerPath = "../php/user_list.php";
        break;

    case 'user_edit':
        $adminTemplatePath = "../tpl/user_edit.tpl.php";
        $adminControllerPath = "../php/user_edit.php";
        break;

    case 'logout':
        $adminTemplatePath = "../tpl/user_logout.tpl.php";
        $adminControllerPath = "../php/user_logout.php";
        break;

    case 'saved':
        $adminTemplatePath = "../tpl/saved.tpl.php";
        $adminControllerPath = "../php/saved.php";
        break;
    
    default:
        $adminTemplatePath = "../tpl/user_login.tpl.php";
        $adminControllerPath = "../php/user_login.php";
        break;
}

require_once($adminControllerPath);
require_once("../tpl/admin.tpl.php");
?>