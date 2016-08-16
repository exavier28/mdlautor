<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Analytics
 *
 * This module provides extensive analytics on a platform of choice
 * Currently support Google Analytics and Piwik
 *
 * @package    mdlautor
 * @copyright  David Bezemer <info@davidbezemer.nl>, www.davidbezemer.nl
 * @author     David Bezemer <info@davidbezemer.nl>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if (is_siteadmin()) {
	$settings = new admin_settingpage('local_mdlautor', get_string('pluginname', 'local_mdlautor'));
	$ADMIN->add('localplugins', $settings);	

	$name = 'local_mdlautor/enabled';
	$title = get_string('enabled', 'local_mdlautor');
	$description = get_string('enabled_desc', 'local_mdlautor');
	$default = true;
	$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
	$settings->add($setting);
	
}

/// Add cvfhub administration pages to the Moodle administration menu
$ADMIN->add('root', new admin_category('local_mdlautor', get_string('pluginname', 'local_mdlautor')));

$ADMIN->add('local_mdlautor', new admin_externalpage('autorsettings',    get_string('settings', 'local_mdlautor'),  $CFG->wwwroot."/local/mdlautor/view.php",   'moodle/site:config'));

		
