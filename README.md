TurtlePHP Logging Plugin
===

[TurtlePHP](https://github.com/onassar/TurtlePHP) Logging Plugin which allows
for the modification of PHP&nbsp;s default error logging.  
This plugin does not modify how to issue an error log directive; rather it
allows for the following customization:

 - error log path (defaults to `.`)
 - error reporting sensitivity (defaults to `E_ALL | E_STRICT`)
 - error log filesize limitation (defaults to 0)
 - whether or not errors should be logged (defaults to `true`)
 - whether or not errors should be displayed (defaults to `false`)

The above options can be set through their respective methods (eg. `setPath`,
`hideErrors`, etc.), and are useful to control error output between different
development environments or roles.

Feel free to make use of the TurtlePHP
[Roles](https://github.com/onassar/TurtlePHP-RolesPlugin) and
[Config](https://github.com/onassar/TurtlePHP-ConfigPlugin) plugins are a more
robust error logging flow.

### Sample plugin loading:
``` php
require_once APP . '/plugins/TurtlePHP-BasePlugin/Base.class.php';
require_once APP . '/plugins/TurtlePHP-LoggingPlugin/Logging.class.php';
$path = APP . '/config/plugins/logging.inc.php';
TurtlePHP\Plugin\Logging::setLoggingPath($path);
TurtlePHP\Plugin\Logging::init();
```

### Example Initialization and Startup
``` php
require_once APP . '/plugins/Logging.class.php';
\TurtlePHP\Plugin\Logging::init();
\TurtlePHP\Plugin\Logging::start();

```
