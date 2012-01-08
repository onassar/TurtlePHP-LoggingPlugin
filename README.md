TurtlePHP Logging Plugin
===

TurtlePHP Logging Plugin which allows for the modification of PHP's
default error logging.

This plugin does not modify how to issue an error log directive; rather
it allows for the following customization:
 - error log path (defaults to <.>)
 - error reporting sensitivity (defaults to <E_ALL | E_STRICT>)
 - error log filesize limitation (defaults to 0)
 - whether or not errors should be logged (defaults to <true>)
 - whether or not errors should be displayed (defaults to <false>)


### Example Initialization and Startup
    /**
     * Logging
     */
    require_once APP . '/plugins/Logging.class.php';
    \Plugin\Logging::init();
    \Plugin\Logging::start();

