<?php
session_destroy();//plus fort qu'un simple unset($_SESSION["user"]);

header('Location: index.php');
