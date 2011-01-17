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

// default configurations
$config['applicationPath'] = 'application';
$config['applicationModule'] = 'ApplicationModule';

// overwrite with local changes
if (include_file_exists('config.typesafe.local.php')) {
    require('config.typesafe.local.php');
}
if (file_exists('../../../src/main/php/config.typesafe.local.php')) {  // maven mode
    require('../../../src/main/php/config.typesafe.local.php');
}

// load the application config
if (include_file_exists('config.application.php')) {
    require('config.application.php');
}
if (file_exists('../../../src/main/php/config.application.php')) {  // maven mode
    require('../../../src/main/php/config.application.php');
}
if (include_file_exists('config.application.local.php')) {
    require('config.application.local.php');
}
if (file_exists('../../../src/main/php/config.application.local.php')) {  // maven mode
    require('../../../src/main/php/config.application.local.php');
}

// load the application module
require($config['applicationPath'].'/'.$config['applicationModule'].'.php');
$applicationModule = new $config['applicationModule']();

if (!($applicationModule instanceof Module)) {
    throw new Exception('Configured ApplicationModule is not a Module');
}

$config['applicationModule'] = $applicationModule;

