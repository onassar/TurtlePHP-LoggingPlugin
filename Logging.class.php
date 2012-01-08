<?php

    // namespace
    namespace Plugin;

    /**
     * Logging
     * 
     * TurtlePHP Logging Plugin which allows for the modification of PHP's
     * default error logging.
     * 
     * This plugin does not modify how to issue an error log directive; rather
     * it allows for the following customization:
     *  - error log path (defaults to <.>)
     *  - error reporting sensitivity (defaults to <E_ALL | E_STRICT>)
     *  - error log filesize limitation (defaults to 0)
     *  - whether or not errors should be logged (defaults to <true>)
     *  - whether or not errors should be displayed (defaults to <false>)
     * 
     * @author   Oliver Nassar <onassar@gmail.com>
     * @abstract
     */
    abstract class Logging
    {
        /**
         * _display
         * 
         * @var    string (default: false)
         * @access protected
         * @static
         */
        protected static $_display = false;

        /**
         * _length
         * 
         * @var    integer (default: 0)
         * @access protected
         * @static
         */
        protected static $_length = 0;

        /**
         * _level
         * 
         * @var    integer
         * @access protected
         * @static
         */
        protected static $_level;

        /**
         * _log
         * 
         * @var    boolean (default: true)
         * @access protected
         * @static
         */
        protected static $_log = true;

        /**
         * _path
         * 
         * @var    string
         * @access protected
         * @static
         */
        protected static $_path;

        /**
         * displayErrors
         * 
         * Toggles on the display of errors to the client.
         * 
         * @access public
         * @static
         * @return void
         */
        public static function displayErrors()
        {
            self::$_display = true;
        }

        /**
         * hideErrors
         * 
         * Toggles off the display of errors to the client.
         * 
         * @access public
         * @static
         * @return void
         */
        public static function hideErrors()
        {
            self::$_display = false;
        }

        /**
         * init
         * 
         * Initializes some error logging settings for ini setting.
         * 
         * @access public
         * @static
         * @return void
         */
        public static function init()
        {
            self::$_path = APP . '/tmp/php.log';
            self::$_level = E_ALL | E_STRICT;
        }

        /**
         * setActive
         * 
         * Toggles on error logging (both to a file and to the client).
         * 
         * @access public
         * @static
         * @return void
         */
        public static function setActive()
        {
            self::$_log = true;
        }

        /**
         * setInactive
         * 
         * Toggles off error logging (both to a file and to the client).
         * 
         * @access public
         * @static
         * @return void
         */
        public static function setInactive()
        {
            self::$_log = false;
        }

        /**
         * setLength
         * 
         * Sets the number of bytes that should be collected in an error log.
         * 
         * @access public
         * @static
         * @param  boolean $length
         * @return void
         */
        public static function setLength($length)
        {
            self::$_length = $length;
        }

        /**
         * setLevel
         * 
         * Sets the level for logging (eg. which types of errors are logged).
         * 
         * @access public
         * @static
         * @param  boolean $level
         * @return void
         */
        public static function setLevel($level)
        {
            self::$_level = $level;
        }

        /**
         * setPath
         * 
         * Sets the path for error log writing.
         * 
         * @access public
         * @static
         * @param  String $path
         * @return void
         */
        public static function setPath($path)
        {
            self::$_path = $path;
        }

        /**
         * start
         * 
         * Ensures that the log path is writable, and sets the ini settings
         * accordingly.
         * 
         * @access public
         * @static
         * @return void
         */
        public static function start()
        {
            // if logs ought to be written to a file
            if (self::$_log === true) {

                // directory permissions check
                $directory = pathinfo(self::$_path, PATHINFO_DIRNAME);
                if (posix_access($directory, POSIX_W_OK) === false) {
                    throw new \Exception(
                        '*' . ($directory) . '* needs to be writable.'
                    );
                }
            }

            // ini settings
            ini_set('error_log', self::$_path);
            ini_set('error_reporting', self::$_level);
            ini_set('log_errors_max_len', self::$_length);
            ini_set('log_errors', self::$_log);
            ini_set('display_errors', self::$_display);
        }
    }

