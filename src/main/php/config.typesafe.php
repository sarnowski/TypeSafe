<?php
/*
 * Copyright 2010,2011 Tobias Sarnowski
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Load the application configuration file and initialize the entry point
 * module.
 *
 * @author Tobias Sarnowski
 */

// will be filled
$config = array();

// load the application config
if (file_exists('config.application.php')) {
    require('config.application.php');
}
if (file_exists('config.application.local.php')) {
    require('config.application.local.php');
}


// initialize the application entry point
if (!isset($config['entryPoint'])) {
    throw new Exception('EntryPoint not configured');
}
if (!isset($config['applicationPath'])) {
    throw new Exception('ApplicationPath not configured');
}

require($config['applicationPath'].'/'.$config['entryPoint'].'.php');
$entryPoint = new $config['entryPoint']($config);

if (!($entryPoint instanceof ApplicationEntryPoint)) {
    throw new Exception('Configured EntryPoint is not an EntryPoint');
}

$config['applicationModule'] = $entryPoint;

// overwrite with local changes
if (file_exists('config.typesafe.local.php')) {
    require('config.typesafe.local.php');
}

