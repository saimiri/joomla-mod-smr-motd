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
 * @package     Joomla.Module
 * @subpackage  Smr.Motd
 * @copyright   Copyright (c) 2015 Saimiri Design (http://www.github.com/saimiri)
 * @author      Juha Auvinen <juha@saimiri.fi>
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @link        http://www.github.com/saimiri/joomla-html-module
 * @since       File available since Release 0.1
 */

// No direct access
defined( '_JEXEC' ) or die( 'Like a man' );

// These help us see if we are in the root folder of the administration section,
// ie. either the login page or the control panel.
$cPanel     = JURI::base();
$currentUrl = str_replace( 'index.php', '', JURI::current() );
$user       = JFactory::getUser();
$canAccess  = true;

if ( empty( $module->position ) ) {
	$module->position = 'cpanel';
}

// Root sees everything and messages on login page are visible to everyone
if ( !$user->authorise( 'core.admin' ) && $module->position !== 'login' ) {
	$userMatch = false;
	if ( $params->get( 'filter_by_user' ) !== 'no' ) {
		// If we are including, $include == true, if excluding $include == false
		$include = $params->get( 'filter_by_user' ) === 'include';
		// If we are including users, default $visible... == false, if excluding
		// default $visible... == true
		$canAccess = !$include;
		if ( in_array( $user->id, $params->get( 'users', [] ) ) === true ) {
			$canAccess = $include;
			$userMatch = true;
		}
	}

	// User filters are more specific so if they match we ignore the group filters
	if ( !$userMatch && $params->get( 'filter_by_group' ) !== 'no' ) {
		$include = $params->get( 'filter_by_group' ) === 'include';
		$canAccess = !$include;
		if ( count( array_intersect( $user->groups, $params->get( 'groups', [] ) ) ) > 0 ) {
			$canAccess = $include;
		}
	}
}

if ( $canAccess ) {
	if ( $module->position === 'login' || $params->get( 'show_as_system_message', 0 ) == 0 ) {
		// ^-Show message in the actual module position.
		// Allow override. Use cases are probably pretty limited, but what the heck.
		require JModuleHelper::getLayoutPath( 'mod_smr_motd', $params->get( 'layout', 'default' ) );
	} else if ( $currentUrl === $cPanel && !JFactory::getUser()->guest ) {
		// ^-Show the message in the message position on the control panel
		// The Joomla! message types don't precisely correlate with bootstrap
		$typeMap = array(
			'info'    => 'notice',
			'warning' => 'warning',
			'error'   => 'error',
			'success' => 'message',
			'none'    => 'none'
		);
		$type = $params->get( 'type', 'info' );
		if ( isset( $typeMap[$type] ) ) {
			$messageType = $typeMap[$type];
		} else {
			$messageType = 'notice';
		}
		$app = JFactory::getApplication();
		$app->enqueueMessage( $params->get( 'message' ), $messageType );
	}
}