  <?php //获取所有广告位

define('ENVIRONMENT','development');

if (!defined('E_DEPRECATED')) {
    define('E_DEPRECATED',8192);
}
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ini_set('display_errors', '1');

$base_uri = DIRECTORY_SEPARATOR=='/' ? dirname($_SERVER["SCRIPT_NAME"]) : str_replace('\\', '/', dirname($_SERVER["SCRIPT_NAME"]));
define("BASE_URI", $base_uri =='/' ? '' : $base_uri);
unset($base_uri);
define('CURRENT_APP_PATH', realpath(dirname(__FILE__)).'/');

$system_path = CURRENT_APP_PATH."system/";
$application_folder = CURRENT_APP_PATH.'app-charts/';
$view_folder = CURRENT_APP_PATH.'views/';

define('APPPATH', $application_folder);

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// Path to the system folder
define('BASEPATH', str_replace('\\', '/', $system_path));

// Path to the front controller (this file)
define('FCPATH', dirname(__FILE__).'/');

// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

define('VIEWPATH', APPPATH.'views/');

require_once BASEPATH.'core/CodeIgniter.php';