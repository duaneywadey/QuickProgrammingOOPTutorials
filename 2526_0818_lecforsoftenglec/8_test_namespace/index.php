<?php 

require_once 'classes/Baseball.php';
require_once 'classes/Basketball.php';
require_once 'classes/Hockey.php';

use App\Basketball;
use App\Baseball;
use App\Hockey;

$basketballObj = new Basketball();
$baseballObj = new Baseball();
$hockeyObj = new Hockey();

echo $baseballObj->baseballStarted();
?>