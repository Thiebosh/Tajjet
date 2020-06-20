<?php
require_once(__DIR__."/../model/manager/ArticleManager.php");

$articleList = (new ArticleManager)->readAll();

var_dump($articleList);