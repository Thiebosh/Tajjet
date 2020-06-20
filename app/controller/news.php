<?php
require_once(__DIR__."/../model/manager/ArticleManager.php");
require_once("vendor/Encoding/Encoding.php");

$articleList = (new ArticleManager)->readAll();