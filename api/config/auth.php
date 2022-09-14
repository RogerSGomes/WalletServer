<?php
include("../modules/header.php");

$auth = file_get_contents("../auth/auth.json");
echo ($auth);
