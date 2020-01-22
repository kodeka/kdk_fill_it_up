<?php
/**
 * @version    1.x
 * @package    Fill It Up (Plugin)
 * @author     Kodeka - https://kodeka.io
 * @copyright  Copyright (c) 2018 - 2020 Kodeka OÜ. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

$task = isset($_GET['task']) ? $_GET['task'] : '';

require FILLITUP_DIR.'admin/controller.php';
$controller = new FillItUpController();
$controller->execute($task);
