<?php

    /**
     * Plugin Config Data
     * 
     */
    $display = false;
    $length = 0;
    $level = E_ALL | E_STRICT;
    $log = true;
    $logPath = './php.log';
    $pluginConfigData = compact('display', 'length', 'level', 'log', 'logPath');

    /**
     * Storage
     * 
     */
    $key = 'TurtlePHP-LoggingPlugin';
    TurtlePHP\Plugin\Config::set($key, $pluginConfigData);
