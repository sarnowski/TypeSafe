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

require_once('TypeSafe/utilities/helpers.php');
require_once('TypeSafe/ServletModule.php');
require_once('TypeSafe/config/ArrayConfigurationModule.php');
require_once('TypeSafe/logging/RequestLoggerModule.php');
require_once('TypeSafe/session/PhpSessionModule.php');
require_once('TypeSafe/validation/ValidationModule.php');
require_once('TypeSafe/components/ComponentsModule.php');
require_once('TypeSafe/form/FormModule.php');

class TypeSafeModule extends ServletModule {

    function configuration() {
        global $config;
        if (!defined('BASEURL')) define('BASEURL', $config['baseurl']);
	    $this->install(new ArrayConfigurationModule($config));
        $this->install(new RequestLoggerModule());
        session_start();
        $this->install(new PhpSessionModule());

        $this->install(new ComponentsModule());
        $this->install(new FormModule());
        $this->install(new ValidationModule());
    }

}
