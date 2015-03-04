<?php
/**
 * A Joomla! module for displaying a "message of the day".
 * 
 * Copyright 2015 Saimiri Design.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * @package			Joomla.Module
 * @subpackage	Smr.Motd
 * @copyright		Copyright (c) 2015 Saimiri Design (http://www.github.com/saimiri)
 * @author			Juha Auvinen <juha@saimiri.fi>
 * @license			http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @link				http://www.github.com/saimiri/joomla-html-module
 * @since				File available since Release 0.1
 */

// No direct access
defined( '_JEXEC' ) or die;

// These help us see if we are in the root folder of the administration section,
// ie. either the login page or the control panel.
$cPanel = JURI::base();
$currentUrl = str_replace( 'index.php', '', JURI::current() );

if ( $module->position === 'login' || $params->get( 'show_in_position', 1 ) == 1 ) {
	// Show message in the actual module position.
	// Allow override. Use cases are probably pretty limited, but what the heck.
	require JModuleHelper::getLayoutPath( 'mod_smr_motd', $params->get( 'layout', 'default' ) );
} else if ( $currentUrl === $cPanel && !JFactory::getUser()->guest ) {
	// By default show the message in the message position on the control panel
	$app = JFactory::getApplication();
	$app->enqueueMessage( $params->get( 'message' ), $params->get( 'type' ) );
}
