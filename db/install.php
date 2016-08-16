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
 * wscvf enrol plugin installation script
 *
 * @package    enrol_wscvf
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
//Include EXS - Início

//	global $CFG;
//	$con = mysqli_connect($CFG->dbhost,$CFG->dbuser,$CFG->dbpass,$CFG->dbname);
//	$sql1 = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='".$CFG->dbname."' AND TABLE_NAME = 'mdl_user_enrolments' AND COLUMN_NAME = 'JsonComplementarData'";
//	$result1 = mysqli_query($con,$sql1);	
	
//	if (mysqli_num_rows($result1)==0){ 
//		$sql2 = "ALTER TABLE `mdl_user_enrolments` ADD `JsonComplementarData` TEXT NOT NULL";
//		mysqli_query($con,$sql2);	
//	}
// A experiência de inserir uma coluna de mdl_user_enrolments não foi exitosa por provocou erro em outras rotinas de inscrição. 
// Assim foi inevitável a criação de uma nova tabela para armazenamento do detalhamento de inscrições.
//Include EXS - Final


defined('MOODLE_INTERNAL') || die();


function xmldb_local_mdlautor_install() {
   
}

