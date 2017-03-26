<?php
session_start();

require_once('sessionControl.php');
userLogout();
header('Location: index.php?src=logout');