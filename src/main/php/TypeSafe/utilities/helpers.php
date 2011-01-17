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
 * formatted debug-output of given parameter
 * @param $item
 */
function debug($item) {

    $trace = debug_backtrace();

    if (is_bool($item)) {
        $dbg = $item ? 'true' : 'false';
    } else {
        $dbg = str_replace('<', '&lt;', str_replace('>', '&gt;', print_r($item, true)));
    }

    echo '<strong>' . gettype($item) . ' in ' . $trace[0]['file'] . "\n" . ' line '.$trace[0]['line'].'</strong>';
    echo '<pre class="debug">' . "\n" . $dbg . "\n" . '</pre>';

    ob_flush();
}

function url($url, $css = false) {
    if (substr($url, 0, 1) == '/') {
        $url = BASEURL.$url;
    }
    if ($css) {
        $url = "url($url)";
    }
    return $url;
}

function redirect($url, $status = '302') {
    header("HTTP/1.0 ".$status.' Redirected');
    header('Location: '.url($url));
    die();
}

function a($url, $text, $attributes = array()) {
    $args = "";
    foreach ($attributes as $attr => $value) {
        $args .= sprintf(' %s="%s"', htmlspecialchars($attr), htmlspecialchars($value));
    }

    return '<a href="'.url($url).'"'.$args.'>'.$text.'</a>';
}
