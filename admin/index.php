<?php
/**
 * @version    1.0.x
 * @package    Fill It Up
 * @author     JoomlaWorks http://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2016 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

$task = isset($_GET['task']) ? $_GET['task'] : '';

require WP_PLUGIN_DIR.'/fillitup/admin/controller.php';
$controller = new FillItUpController();
$controller->execute($task);
