<?php
$_BODY = file_get_contents('php://input');
$_BODY = json_decode($_BODY, TRUE);
