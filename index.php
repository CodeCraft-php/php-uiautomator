<?php
require "src/UiAutomator.php";
require "src/UiElement/UiElement.php";
require __DIR__."/vendor/autoload.php";

use CodeCraft\PhpUiAutomator\UiAutomator;
use Xvq\PhpAdb\AdbClient;


$adbClient = new AdbClient();
$device = $adbClient->device();
// $uiautomator = new UiAutomator($device);
// $uiautomator->setRedump(false);
// $uiautomator->findByResourceId("com.transsion.hilauncher.upgrade:id/search_box_input")->setText("");