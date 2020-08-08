<?php

    // namespace
    namespace Plugin;

    /**
     * Logging
     * 
     * Logging plugin for TurtlePHP.
     * 
     * This plugin does not modify how to issue an error log directive; rather
     * it allows for the following customization:
     *  - error log path
     *  - error reporting sensitivity
     *  - error log filesize limitation
     *  - whether or not errors should be logged
     *  - whether or not errors should be displayed
     * 
     * @author  Oliver Nassar <onassar@gmail.com>
     * @abstract
     * @extends Base
     */
    abstract class Logging extends Base
    {
        /**
         * _configPath
         * 
         * @access  protected
         * @var     string (default: 'config.default.inc.php')
         * @static
         */
        protected static $_configPath = 'config.default.inc.php';

        /**
         * _initiated
         * 
         * @access  protected
         * @var     bool (default: false)
         * @static
         */
        protected static $_initiated = false;

        /**
         * _checkDependencies
         * 
         * @access  protected
         * @static
         * @return  void
         */
        protected static function _checkDependencies(): void
        {
            static::_checkConfigPluginDependency();
        }

        /**
         * _checkLogPathDirectoryWritePermissions
         * 
         * @note    This check needs to come after the parent::init call since
         *          it requires access to the plugin config data (which isn't
         *          available at the time of the static::_checkDependencies
         *          call).
         * @access  protected
         * @static
         * @return  void
         */
        protected static function _checkLogPathDirectoryWritePermissions(): void
        {
            $directoryPath = static::_getLogPathDirectory();
            static::_checkDirectoryWritePermissions($directoryPath);
        }

        /**
         * _getLogPathDirectory
         * 
         * @access  protected
         * @static
         * @return  string
         */
        protected static function _getLogPathDirectory(): string
        {
            $configData = static::_getConfigData();
            $logPath = $configData['logPath'];
            $directoryPath = pathinfo($logPath, PATHINFO_DIRNAME);
            return $directoryPath;
        }

        /**
         * _setINISettings
         * 
         * @access  protected
         * @static
         * @return  void
         */
        protected static function _setINISettings(): void
        {
            $configData = static::_getConfigData();
            ini_set('error_log', $configData['logPath']);
            ini_set('error_reporting', $configData['level']);
            ini_set('log_errors_max_len', $configData['length']);
            ini_set('log_errors', $configData['log']);
            ini_set('display_errors', $configData['display']);
        }

        /**
         * init
         * 
         * @access  public
         * @static
         * @return  bool
         */
        public static function init(): bool
        {
            if (static::$_initiated === true) {
                return false;
            }
            parent::init();
            static::_checkLogPathDirectoryWritePermissions();
            static::_setINISettings();
            return true;
        }
    }

    // Config path loading
    $info = pathinfo(__DIR__);
    $parent = ($info['dirname']) . '/' . ($info['basename']);
    $configPath = ($parent) . '/config.inc.php';
    \Plugin\Logging::setConfigPath($configPath);
