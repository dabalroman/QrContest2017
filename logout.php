<?php
session_start();

require_once('sessioncontrol.php');
userLogout();
header('Location: index.php?src=logout');