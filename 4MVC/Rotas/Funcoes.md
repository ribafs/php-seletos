# Funções e constantes mágicas

As que são úteis para rotas

- $_SERVER['REQUEST_URI']
- __DIR__
- dirname()

http://localhost/mvc5/clients

$link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; - http://localhost/mvc5/public/index.php

$link = 'http://'.$_SERVER['HTTP_HOST'] - http://localhost

$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; - http://localhost/mvc5/clients

$link = "$_SERVER[REQUEST_URI]"; - mvc5/clients

print dirname("$_SERVER[REQUEST_URI]"); - mv5

$url = explode('/', $url);

print $url[2]; - clients // 0 - vazio e 1 - mvc5


Converter string em array

Converter array em string

$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

http://localhost/mvc5/

--
function url_origin( $s, $use_forwarded_host = false )
{
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false )
{
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}

$absolute_url = full_url( $_SERVER );
echo $absolute_url;
--

Examples for: https://(www.)example.com/subFolder/myfile.php?var=blabla#555

// ======= PATHINFO ====== //
$x = pathinfo($url);
$x['dirname']      // https://example.com/subFolder
$x['basename']     //                               myfile.php?var=blabla#555 // Unsecure! 
$x['extension']    //                               php?var=blabla#555 // Unsecure! 
$x['filename']     //                               myfile

// ======= PARSE_URL ====== //
$x = parse_url($url);
$x['scheme']       // https
$x['host']         // example.com
$x['path']         // /subFolder/myfile.php
$x['query']        // var=blabla
$x['fragment']     // 555

//=================================================== //
//========== self-defined SERVER variables ========== //
//=================================================== //
$_SERVER["DOCUMENT_ROOT"]  // /home/user/public_html
$_SERVER["SERVER_ADDR"]    // 143.34.112.23
$_SERVER["SERVER_PORT"]    // 80(or 443 etc..)
$_SERVER["REQUEST_SCHEME"] // https  similar: $_SERVER["SERVER_PROTOCOL"] 
$_SERVER['HTTP_HOST']      // example.com (or with WWW)  similar: $_SERVER["ERVER_NAME"]
$_SERVER["REQUEST_URI"]    // /subFolder/myfile.php?var=blabla
$_SERVER["QUERY_STRING"]   // var=blabla
__FILE__                   // /home/user/public_html/subFolder/myfile.php
__DIR__                    // /home/user/public_html/subFolder  same: dirname(__FILE__)
$_SERVER["REQUEST_URI"]    // /subFolder/myfile.php?var=blabla
parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)//  /subFolder/myfile.php 
$_SERVER["PHP_SELF"]       // /subFolder/myfile.php

// ==================================================================//
//if "myfile.php" is included in "PARENTFILE.php" , and you visit  "PARENTFILE.PHP?abc":
$_SERVER["SCRIPT_FILENAME"]// /home/user/public_html/parentfile.php
$_SERVER["PHP_SELF"]       // /parentfile.php
$_SERVER["REQUEST_URI"]    // /parentfile.php?var=blabla
__FILE__                   // /home/user/public_html/subFolder/myfile.php

// =================================================== //
// ================= handy variables ================= //
// =================================================== //
//If site uses HTTPS:
$HTTP_or_HTTPS = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off') || $_SERVER['SERVER_PORT']==443) ? 'https://':'http://' );            //in some cases, you need to add this condition too: if ('https'==$_SERVER['HTTP_X_FORWARDED_PROTO'])  ...

//To trim values to filename, i.e. 
basename($url)             // myfile.php

//excellent solution to find origin
$debug_files = debug_backtrace();
$caller_file = count($debug_files) ? $debug_files[count($debug_files) - 1]['file'] : __FILE__;

Notice ! ! !

    hashtag # parts were manually used in the above example just for illustration purposes, however, server-side languages (including php) can't natively detect them (Only Javascript can do that, as hashtag is only browser/client side functionality ).
    DIRECTORY_SEPARATOR returns \ for Windows-type hosting, instead of /.

==


Here is my solution - code is inspired by Tracy Debugger. It was changed for support different server ports. You can get full current URL including $_SERVER['REQUEST_URI'] or just the basic server URL. Check my function:

function getCurrentUrl($full = true) {
    if (isset($_SERVER['REQUEST_URI'])) {
        $parse = parse_url(
            (isset($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'off') ? 'https://' : 'http://') .
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '')) . (($full) ? $_SERVER['REQUEST_URI'] : null)
        );
        $parse['port'] = $_SERVER["SERVER_PORT"]; // Setup protocol for sure (80 is default)
        return http_build_url('', $parse);
    }
}

Here is test code:

// Follow $_SERVER variables was set only for test
$_SERVER['HTTPS'] = 'off'; // on
$_SERVER['SERVER_PORT'] = '9999'; // Setup
$_SERVER['HTTP_HOST'] = 'some.crazy.server.5.name:8088'; // Port is optional there
$_SERVER['REQUEST_URI'] = '/150/tail/single/normal?get=param';

echo getCurrentUrl();
// http://some.crazy.server.5.name:9999/150/tail/single/normal?get=param

echo getCurrentUrl(false);
// http://some.crazy.server.5.name:9999/




- parse_url()

$url = 'http://username:password@hostname:9090/path?arg=value#anchor';

var_dump(parse_url($url));
var_dump(parse_url($url, PHP_URL_SCHEME));
var_dump(parse_url($url, PHP_URL_USER));
var_dump(parse_url($url, PHP_URL_PASS));
var_dump(parse_url($url, PHP_URL_HOST));
var_dump(parse_url($url, PHP_URL_PORT));
var_dump(parse_url($url, PHP_URL_PATH));
var_dump(parse_url($url, PHP_URL_QUERY));
var_dump(parse_url($url, PHP_URL_FRAGMENT));
