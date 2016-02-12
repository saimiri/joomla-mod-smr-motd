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
defined( '_JEXEC' ) or die;

$hLevel = (int)$params->get( 'heading_level', 4 );
$class = trim( $params->get( 'moduleclass_sfx' ) );
$type = $params->get( 'type' );

if ( $type == 'none' ) {
	$class = 'smr-motd--none ' . $class;
} else {
	$class = 'alert alert-' . $type . ' smr-motd smr-motd--' . $type . ' ' . $class;
}

echo '<div class="' . $class . '">';
if ( $params->get( 'show_message_heading', 1 ) ) {
	echo '<h' . $hLevel . ' class="smr-motd__heading smr-motd__heading--' . $type . '">' .
		htmlspecialchars( $module->title ) . '</h' . $hLevel . '>';
}
	echo '<div class="smr-motd__body smr-motd__body--' . $type . '">';
		echo $params->get( 'message' );
	echo '</div>';
echo '</div>';
