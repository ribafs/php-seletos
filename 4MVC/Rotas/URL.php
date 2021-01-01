<?php
/** -------------------------------------------------------------------------------------------------------------------
 * URI CLASS
 * URI management class
 *
 * @author Sandu Liviu Catalin
 * @email slc(dot)universe(at)gmail(dot)com
 * @license Public Domain
**/
abstract class _URI
{
    /** ---------------------------------------------------------------------------------------------------------------
     *  - BASE PARAMETERS
     * $_Script_Hidden - Hide the script name from the returned URI
     * $_Public_Path - Location where public resources are stored
     * $_Public_Relative - Return the relative path version of public location
     * $_Public_Skin - Is the skin directory located in the public directory
     * $_Skin_Path - Location where skins are stored
     * $_Skin_Relative - Return the relative path version of skin location
     * $_Skin_Default - Use this as the default system skin
     * $_Fallback_Base - Use this base URL if you can't extract the current URL
     * $_Fallback_Scheme - Use this scheme if you can't find it automatically
     * $_Fallback_User - Use this user name if you can't find it automatically
     * $_Fallback_Passwd - Use this password if you can't find it automatically
     * $_Fallback_Host - Use this host if you can't find it automatically
     * $_Fallback_Port - Use this port number if you can't find it automatically
     * $_Fallback_Script - Use this script name if you can't find it automatically
     * $_Separator_Scheme - Use this to separate the scheme from the rest of the url
     * $_Separator_Credentials - Use this to separate the user name from the password
     * $_Separator_Auth - Use this to separate the user name and password from host
     * $_Separator_Port - Use this to separate the port number from host
     * $_Separator_Query - Use this to separate the query data from base URL
     * $_Separator_Fragment - Use this to separate the fragment data from query data
    */
    protected static $_Script_Hidden;
    protected static $_Public_Path;
    protected static $_Public_Relative;
    protected static $_Public_Skin;
    protected static $_Skin_Path;
    protected static $_Skin_Relative;
    protected static $_Skin_Default;
    protected static $_Fallback_Base;
    protected static $_Fallback_Scheme;
    protected static $_Fallback_User;
    protected static $_Fallback_Passwd;
    protected static $_Fallback_Host;
    protected static $_Fallback_Port;
    protected static $_Fallback_Script;
    protected static $_Separator_Scheme;
    protected static $_Separator_Credentials;
    protected static $_Separator_Auth;
    protected static $_Separator_Port;
    protected static $_Separator_Query;
    protected static $_Separator_Fragment;

    /** ----------------------------------------------------------------------------------------------------------------
     * CACHED BASES
     * Precompiled common URLs for quick retrieval
    */
    protected static $Base_Host;
    protected static $Base_App;
    protected static $Base_Script;
    protected static $Base_Current;
    protected static $Base_Public;
    protected static $Base_Skin;

    /** ----------------------------------------------------------------------------------------------------------------
     * DATA CONTAINERS
     * Raw URI segments saved from extracted data
    */
    protected static $__Segments = array(
        'SCHEME' => '',
        'USER' => '',
        'PASSWD' => '',
        'HOST' => '',
        'PORT' => '',
        'PATH' => '',
        'SCRIPT' => '',
        'INFO' => '',
        'QUERY' => '',
    );

    /** ----------------------------------------------------------------------------------------------------------------
     * PARSER KEYWORDS
     * URI data asigned to specific keywords.
    */
    protected static $__Parsers;

    /** ----------------------------------------------------------------------------------------------------------------
     * CLASS INITIALIZER
     * Initialize the class
     *
     * @access public
     * @param $Params [array] - An associative array of supported parrameters
     * @return void
    */
    public static function __Init($Params=array())
    {
        // Configure the class
        self::$_Script_Hidden = (isset($Params['Script_Hidden'])) ? $Params['Script_Hidden'] : FALSE;
        self::$_Public_Path = (isset($Params['Public_Path'])) ? $Params['Public_Path'] : 'public';
        self::$_Public_Relative = (isset($Params['Public_Relative'])) ? $Params['Public_Relative'] : TRUE;
        self::$_Public_Skin = (isset($Params['Public_Skin'])) ? $Params['Public_Skin'] : TRUE;
        self::$_Skin_Path = (isset($Params['Skin_Path'])) ? $Params['Skin_Path'] : 'themes';
        self::$_Skin_Relative = (isset($Params['Skin_Relative'])) ? $Params['Skin_Relative'] : TRUE;
        self::$_Skin_Default = (isset($Params['Skin_Default'])) ? $Params['Skin_Default'] : 'default';
        self::$_Fallback_Base = (isset($Params['Fallback_Base'])) ? $Params['Fallback_Base'] : '127.0.0.1';
        self::$_Fallback_Scheme = (isset($Params['Fallback_Scheme'])) ? $Params['Fallback_Scheme'] : 'http';
        self::$_Fallback_User = (isset($Params['Fallback_User'])) ? $Params['Fallback_User'] : '';
        self::$_Fallback_Passwd = (isset($Params['Fallback_Passwd'])) ? $Params['Fallback_Passwd'] : '';
        self::$_Fallback_Host = (isset($Params['Fallback_Host'])) ? $Params['Fallback_Host'] : '127.0.0.1';
        self::$_Fallback_Port = (isset($Params['Fallback_Port'])) ? $Params['Fallback_Port'] : '';
        self::$_Fallback_Script = (isset($Params['Fallback_Script'])) ? $Params['Fallback_Script'] : 'index.php';
        self::$_Separator_Scheme = (isset($Params['Separator_Scheme'])) ? $Params['Separator_Scheme'] : '://';
        self::$_Separator_Credentials = (isset($Params['Separator_Credentials'])) ? $Params['Separator_Credentials'] : ':';
        self::$_Separator_Auth = (isset($Params['Separator_Auth'])) ? $Params['Separator_Auth'] : '@';
        self::$_Separator_Port = (isset($Params['Separator_Port'])) ? $Params['Separator_Port'] : ':';
        self::$_Separator_Query = (isset($Params['Separator_Query'])) ? $Params['Separator_Query'] : '?';
        self::$_Separator_Fragment = (isset($Params['Separator_Fragment'])) ? $Params['Separator_Fragment'] : '#';
        // Do some clean up of the configurations
        self::$_Public_Path = implode('/', explode('/', str_replace(array('/', '\\'), '/', self::$_Public_Path)));
        self::$_Skin_Path = implode('/', explode('/', str_replace(array('/', '\\'), '/', self::$_Skin_Path)));
        // Extract the URL information
        self::Extract();
        // Precompile common bases
        self::$Base_Host = self::Compile('HOST');
        self::$Base_App = self::Compile('PATH');
        self::$Base_Script = self::$Base_App.(self::$_Script_Hidden ? '' : '/'.self::$__Segments['SCRIPT']);
        self::$Base_Current = self::$Base_Script.(empty(self::$__Segments['INFO']) ? '' : '/'.self::$__Segments['INFO']);
        self::$Base_Public = self::$_Public_Relative ? self::$_Public_Path : self::$Base_App.'/'.self::$_Public_Path;
        self::$Base_Skin = self::$_Skin_Relative ? self::$_Skin_Path : self::$Base_Public.'/'.self::$_Skin_Path;
        self::$Base_Skin .= '/'.self::$_Skin_Default;
        // Setup the parsers
        self::$__Parsers['SR_Key'][] = '%HostBase%';
        self::$__Parsers['SR_Data'][] =& self::$Base_Host;
        self::$__Parsers['SR_Key'][] = '%AppBase%';
        self::$__Parsers['SR_Data'][] =& self::$Base_App;
        self::$__Parsers['SR_Key'][] = '%ScriptBase%';
        self::$__Parsers['SR_Data'][] =& self::$Base_Script;
        self::$__Parsers['SR_Key'][] = '%CurrentBase%';
        self::$__Parsers['SR_Data'][] =& self::$Base_Current;
        self::$__Parsers['SR_Key'][] = '%PublicBase%';
        self::$__Parsers['SR_Data'][] =& self::$Base_Public;
        self::$__Parsers['SR_Key'][] = '%SkinBase%';
        self::$__Parsers['SR_Data'][] =& self::$Base_Skin;
        self::$__Parsers['SR_Data'][] =& self::$__Segments['SCHEME'];
        self::$__Parsers['SR_Key'][] = '%UserSegment%';
        self::$__Parsers['SR_Data'][] =& self::$__Segments['USER'];
        self::$__Parsers['SR_Key'][] = '%PasswdSegment%';
        self::$__Parsers['SR_Data'][] =& self::$__Segments['PASSWD'];
        self::$__Parsers['SR_Key'][] = '%HostSegment%';
        self::$__Parsers['SR_Data'][] =& self::$__Segments['HOST'];
        self::$__Parsers['SR_Key'][] = '%PortSegment%';
        self::$__Parsers['SR_Data'][] =& self::$__Segments['PORT'];
        self::$__Parsers['SR_Key'][] = '%PathSegment%';
        self::$__Parsers['SR_Data'][] =& self::$__Segments['PATH'];
        self::$__Parsers['SR_Key'][] = '%ScriptSegment%';
        self::$__Parsers['SR_Data'][] =& self::$__Segments['SCRIPT'];
        self::$__Parsers['SR_Key'][] = '%InfoSegment%';
        self::$__Parsers['SR_Data'][] =& self::$__Segments['INFO'];
        self::$__Parsers['SR_Key'][] = '%QuerySegment%';
        self::$__Parsers['SR_Data'][] =& self::$__Segments['QUERY'];
        self::$__Parsers['SR_Key'][] = '%PublicPath%';
        self::$__Parsers['SR_Data'][] =& self::$_Public_Path;
        self::$__Parsers['SR_Key'][] = '%SkinPath%';
        self::$__Parsers['SR_Data'][] =& self::$_Skin_Path;
        self::$__Parsers['SR_Key'][] = '%DefaultSkin%';
        self::$__Parsers['SR_Data'][] =& self::$_Skin_Default;
        // Everything OK so far
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * URI EXTRACTOR
     * Try every posibility to obtain all the segments of the current URL
     *
     * @access public
     * @return array
    */
    public static function Extract()
    {
        // No point in executing twice to get the same result
        if (!empty(self::$__Segments['HOST'])) return self::$__Segments;
        // Let's try to have a falback for most basic data
        $Script_URI = (isset($_SERVER['SCRIPT_URI'])) ? parse_url($_SERVER['SCRIPT_URI']) : array();
        if (empty($Script_URI)) {
            $Script_URI = parse_url(self::$_Fallback_Base);
        }
        // Try ever possibility to obtain the data that surounds the script name
        if (isset($_SERVER['PHP_SELF'])) {
            $Script_Path = $_SERVER['PHP_SELF'];
        } elseif (isset($_SERVER['REQUEST_URI'])) {
            $Script_Path = preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);
        } elseif (isset($Script_URI['path'])) {
            $Script_Path = $Script_URI['path'];
        } elseif (isset($_SERVER['SCRIPT_NAME'])) {
            $Script_Path = isset($_SERVER['SCRIPT_NAME']).(isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '');
        } elseif (isset($_SERVER['DOCUMENT_ROOT']) && isset($_SERVER['SCRIPT_FILENAME'])) {
            $Script_Path = substr($_SERVER['SCRIPT_FILENAME'], strlen($_SERVER['DOCUMENT_ROOT']),
                                    (strlen($_SERVER['SCRIPT_FILENAME'])-strlen($_SERVER['DOCUMENT_ROOT'])));
            $Script_Path .= (isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '');
        } else {
            $Script_Path = '';
        }
        // Explode the previously extracted data
        if (strlen($Script_Path) > 0) {
            $Script_Path = preg_split('/[\/]/', $Script_Path, -1, PREG_SPLIT_NO_EMPTY);
        } else {
            $Script_Path = array();
        }
        // Try to obtain the name of the currently executed script
        if (isset($_SERVER['SCRIPT_FILENAME'])) {
            $Script_Name = basename($_SERVER['SCRIPT_FILENAME']);
        } elseif (isset($_SERVER['SCRIPT_NAME'])) {
            $Script_Name = basename($_SERVER['SCRIPT_NAME']);
        } else {
            $Script_Name = self::$_Fallback_Script;
        }
        // Try to find the name of the script in the script path
        $Script_Split = (is_string($Script_Name)) ? array_search($Script_Name, $Script_Path, TRUE) : NULL;
        // Try to obtain the request scheme
        if (isset($_SERVER['REQUEST_SCHEME'])) {
            self::$__Segments['SCHEME'] = $_SERVER['REQUEST_SCHEME'];
        } elseif (isset($_SERVER['SERVER_PROTOCOL'])) {
            self::$__Segments['SCHEME'] = strtolower($_SERVER['SERVER_PROTOCOL']);
            self::$__Segments['SCHEME'] = substr(self::$__Segments['SCHEME'], 0, strpos(self::$__Segments['SCHEME'], '/'));
            self::$__Segments['SCHEME'] .= (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on') ? 's' : '';
        } elseif (isset($Script_URI['scheme'])) {
            self::$__Segments['SCHEME'] = $Script_URI['scheme'];
        } else {
            self::$__Segments['SCHEME'] = self::$_Fallback_Scheme;
        }
        // Try to obtain the user name (if one was used)
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            self::$__Segments['USER'] = $_SERVER['PHP_AUTH_USER'];
        } elseif (isset($Script_URI['user'])) {
            self::$__Segments['USER'] = $Script_URI['user'];
        } else {
            self::$__Segments['USER'] = self::$_Fallback_User;
        }
        // Try to obtain the user password (if one was used)
        if (isset($_SERVER['PHP_AUTH_PW'])) {
            self::$__Segments['PASSWD'] = $_SERVER['PHP_AUTH_PW'];
        } elseif (isset($Script_URI['pass'])) {
            self::$__Segments['PASSWD'] = $Script_URI['pass'];
        } else {
            self::$__Segments['PASSWD'] = self::$_Fallback_Passwd;
        }
        // Try to obtai the host name
        if (isset($_SERVER['SERVER_NAME'])) {
            self::$__Segments['HOST'] = $_SERVER['SERVER_NAME'];
        } elseif (isset($_SERVER['HTTP_HOST'])) {
            self::$__Segments['HOST'] = $_SERVER['HTTP_HOST'];
        } elseif (isset($Script_URI['host'])) {
            self::$__Segments['HOST'] = $Script_URI['host'];
        } else {
            self::$__Segments['HOST'] = self::$_Fallback_Host;
        }
        // Try to obtain the port number (if one was used)
        if (isset($Script_URI['port'])) {
            self::$__Segments['PORT'] = $Script_URI['port'];
        } else {
            self::$__Segments['PORT'] = self::$_Fallback_Port;
        }
        // Try to obtain the path to the script
        if (is_numeric($Script_Split)) {
            self::$__Segments['PATH'] = implode('/', array_slice($Script_Path, 0, $Script_Split, TRUE));
        } else {
            self::$__Segments['PATH'] = '';
        }
        // Try to obtain the Script name
        if (is_string($Script_Name)) {
            self::$__Segments['SCRIPT'] = $Script_Name;
        } else {
            self::$__Segments['SCRIPT'] = '';
        }
        // Try to obtain any passed info
        if (isset($_SERVER['PATH_INFO'])) {
            self::$__Segments['INFO'] = implode('/', preg_split('/[\/]/', $_SERVER['PATH_INFO'], -1, PREG_SPLIT_NO_EMPTY));
        } elseif (is_numeric($Script_Split)) {
            self::$__Segments['INFO'] = implode('/', array_slice($Script_Path, $Script_Split+1));
        } else {
            self::$__Segments['INFO'] = '';
        }
        // -----Pending Feature: Try to also extract the query string

        // Return the extracted URI segments
        return self::$__Segments;

    }

    /** ----------------------------------------------------------------------------------------------------------------
     * URI COMPILER
     * Compile raw URI segments into a usable URL
     *
     * @access public
     * @param $Until [string] - The name of the segment where compilation should stop and return
     * @return string
    */
    public static function Compile($Until=NULL)
    {
        $URI= '';
        $Until = (is_string($Until)) ? strtoupper($Until) : $Until;
        if ($Until === 'SCHEME') {
            return $URI .= (self::$__Segments['SCHEME'] !== '') ? self::$__Segments['SCHEME'].self::$_Separator_Scheme : '';
        } else {
            $URI .= (self::$__Segments['SCHEME'] !== '') ? self::$__Segments['SCHEME'].self::$_Separator_Scheme : '';
        }
        if ($Until === 'USER') {
            return $URI .= (self::$__Segments['USER'] !== '') ? self::$__Segments['USER'].self::$_Separator_Credentials : '';
        } else {
            $URI .= (self::$__Segments['USER'] !== '') ? self::$__Segments['USER'] : '';
        }
        $URI .= (self::$__Segments['USER'] !== '' || self::$__Segments['PASSWD'] !== '') ? self::$_Separator_Credentials : '';
        if ($Until === 'PASSWD') {
            return $URI .= (self::$__Segments['PASSWD'] !== '') ? self::$__Segments['PASSWD'].self::$_Separator_Auth : '';
        } else {
            $URI .= (self::$__Segments['PASSWD'] !== '') ? self::$__Segments['PASSWD'] : '';
        }
        $URI .= (self::$__Segments['USER'] !== '' || self::$__Segments['PASSWD'] !== '') ? self::$_Separator_Auth : '';
        if ($Until === 'HOST') {
            return $URI .= (self::$__Segments['HOST'] !== '') ? self::$__Segments['HOST'] : '';
        } else {
            $URI .= (self::$__Segments['HOST'] !== '') ? self::$__Segments['HOST'] : '';
        }
        if ($Until === 'PORT') {
            return $URI .= (self::$__Segments['PORT'] !== '') ? self::$_Separator_Port.self::$__Segments['PORT'] : '';
        } else {
            $URI .= (self::$__Segments['PORT'] !== '') ? self::$_Separator_Port.self::$__Segments['PORT'] : '';
        }
        if ($Until === 'PATH') {
            return $URI .= (self::$__Segments['PATH'] !== '') ? '/'.self::$__Segments['PATH'] : '';
        } else {
            $URI .= (self::$__Segments['PATH'] !== '') ? '/'.self::$__Segments['PATH'] : '';
        }
        if ($Until === 'SCRIPT') {
            return $URI .= (self::$__Segments['SCRIPT'] !== '') ? '/'.self::$__Segments['SCRIPT'] : '';
        } else {
            $URI .= (self::$__Segments['SCRIPT'] !== '') ? '/'.self::$__Segments['SCRIPT'] : '';
        }
        if ($Until === 'INFO') {
            return $URI .= (self::$__Segments['INFO'] !== '') ? '/'.self::$__Segments['INFO'] : '';
        } else {
            $URI .= (self::$__Segments['INFO'] !== '') ? '/'.self::$__Segments['INFO'] : '';
        }
        return $URI;
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * SEGMENT RETRIEVER
     * Return a specific URI segment
     *
     * @access public
     * @param $Name [string] - The name of the segment you want
     * @return string (on success) bool (on failure)
    */
    public static function Segment($Name)
    {
        if (isset(self::$__Segments[$Name])) {
            return self::$__Segments[$Name];
        } return FALSE;
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * BASE RETRIEVER
     * Return a specific precompiled base
     *
     * @access public
     * @param $Name [string] - The name of the base you want
     * @return mixed (on success) boolean (on failure)
    */
    public static function Base($Name)
    {
        switch ($Name) {
            case 'Host':
            case 'Domain':
                return self::$Base_Host;
            break;
            case 'App':
            case 'Base':
                return self::$Base_App;
            break;
            case 'Script':
            case 'Index':
                return self::$Base_Script;
            break;
            case 'Current':
            case 'This':
                return self::$Base_Current;
            break;
            case 'Public':
            case 'Web':
                return self::$Base_Public;
            break;
            case 'Skin':
            case 'Theme':
                return self::$Base_Skin;
            break;
            case 'All':
                return array(
                    'Host'=>self::$Base_Host,
                    'App'=>self::$Base_App,
                    'Script'=>self::$Base_Script,
                    'Current'=>self::$Base_Current,
                    'Public'=>self::$Base_Public,
                    'Skin'=>self::$Base_Skin,
                );
            break;
        } return FALSE;
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * STRING PARSER
     * Replace known keywords in the specified string with current URI data
     *
     * @access public
     * @param $String [string] - A string that you want to parse
     * @return void
    */
    public static function Parse($String)
    {
        if (is_string($String)) {
            return str_replace(self::$__Parsers['SR_Key'], self::$__Parsers['SR_Data'], $String);
        } elseif (is_array($String)) {
            foreach ($String as $K => $V) {
                $Parsed[$K] = self::$replace($V);
            } return $Parsed;
        } return FALSE;
    }
}
if (isset($_URI_Params)) {
    _URI::__Init($_URI_Params);
} else {
    _URI::__Init();
} 
?>

<?php
// Change a few parameters before loading the class.
$_URI_Params = array(
    'Public_Relative' => FALSE,
    'Skin_Relative' => FALSE,
    'Skin_Default' => 'classic',
    // etc.
);
// Get the URI class
//require('uri.php');
// Output all extracted URI segments
echo '<pre>';
var_dump(_URI::Extract());
echo '</pre>';
// Output extracted segments individually
echo 'Scheme: '._URI::Segment('SCHEME').'<br/>';
echo 'User: '._URI::Segment('USER').'<br/>';
echo 'Password: '._URI::Segment('PASSWD').'<br/>';
echo 'Host: '._URI::Segment('HOST').'<br/>';
echo 'Port: '._URI::Segment('PORT').'<br/>';
echo 'Path: '._URI::Segment('PATH').'<br/>';
echo 'Script: '._URI::Segment('SCRIPT').'<br/>';
echo 'Info: '._URI::Segment('INFO').'<br/>';
// Compile extracted segments into a usable URL
echo '<br/>';
echo 'Full Compiled URI: '._URI::Compile().'<br/>';
echo '<br/>';
// Output precompiled common bases for a faster result and better performance
echo 'Host Base: '._URI::Base('Host').'<br/>';
echo 'Application Base: '._URI::Base('App').'<br/>';
echo 'Running Script: '._URI::Base('Script').'<br/>';
echo 'Current URI Base: '._URI::Base('Current').'<br/>';
echo 'Public Folder Base: '._URI::Base('Public').'<br/>';
echo 'Skin Folder Base: '._URI::Base('Skin').'<br/>';
// Get all the precompiled bases in an associative array
echo '<pre>';
var_dump(_URI::Base('All'));
echo '</pre>';
// Parse an example string and replace known keys with actual URI data.
echo _URI::Parse('This is my current domain: %HostBase%
And the current application is here: %AppBase%
I load my skins form: %SkinBase%
etc.
'); 

