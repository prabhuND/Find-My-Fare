<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2013 Bitrix
 */

require_once(substr(__FILE__, 0, strlen(__FILE__) - strlen("/include.php"))."/bx_root.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/start.php");

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/virtual_io.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/virtual_file.php");


$application = \Bitrix\Main\Application::getInstance();
$application->initializeExtendedKernel(array(
	"get" => $_GET,
	"post" => $_POST,
	"files" => $_FILES,
	"cookie" => $_COOKIE,
	"server" => $_SERVER,
	"env" => $_ENV
));

//define global application object
$GLOBALS["APPLICATION"] = new CMain;

if(defined("SITE_ID"))
	define("LANG", SITE_ID);

if(defined("LANG"))
{
	if(defined("ADMIN_SECTION") && ADMIN_SECTION===true)
		$db_lang = CLangAdmin::GetByID(LANG);
	else
		$db_lang = CLang::GetByID(LANG);

	$arLang = $db_lang->Fetch();

	if(!$arLang)
	{
		throw new \Bitrix\Main\SystemException("Incorrect site: ".LANG.".");
	}
}
else
{
	$arLang = $GLOBALS["APPLICATION"]->GetLang();
	define("LANG", $arLang["LID"]);
}

$lang = $arLang["LID"];
if (!defined("SITE_ID"))
	define("SITE_ID", $arLang["LID"]);
define("SITE_DIR", $arLang["DIR"]);
define("SITE_SERVER_NAME", $arLang["SERVER_NAME"]);
define("SITE_CHARSET", $arLang["CHARSET"]);
define("FORMAT_DATE", $arLang["FORMAT_DATE"]);
define("FORMAT_DATETIME", $arLang["FORMAT_DATETIME"]);
define("LANG_DIR", $arLang["DIR"]);
define("LANG_CHARSET", $arLang["CHARSET"]);
define("LANG_ADMIN_LID", $arLang["LANGUAGE_ID"]);
define("LANGUAGE_ID", $arLang["LANGUAGE_ID"]);

$context = $application->getContext();
$context->setLanguage(LANGUAGE_ID);
$context->setCulture(new \Bitrix\Main\Context\Culture($arLang));

$request = $context->getRequest();
if (!$request->isAdminSection())
{
	$context->setSite(SITE_ID);
}

$application->start();

$GLOBALS["APPLICATION"]->reinitPath();

if (!defined("POST_FORM_ACTION_URI"))
{
	define("POST_FORM_ACTION_URI", htmlspecialcharsbx(GetRequestUri()));
}

$GLOBALS["MESS"] = array();
$GLOBALS["ALL_LANG_FILES"] = array();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/tools.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/database.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/main.php");
IncludeModuleLangFile(__FILE__);

error_reporting(COption::GetOptionInt("main", "error_reporting", E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR|E_PARSE) & ~E_STRICT & ~E_DEPRECATED);

if(!defined("BX_COMP_MANAGED_CACHE") && COption::GetOptionString("main", "component_managed_cache_on", "Y") <> "N")
{
	define("BX_COMP_MANAGED_CACHE", true);
}

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/filter_tools.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/ajax_tools.php");

/*ZDUyZmZYjhkZmU1NTQ3ZjdiZjc0MTgwMDU1ZGM0YTc1MmFlNGI=*/$GLOBALS['_____740972820']= array(base64_decode(''.'R2V0TW9kdWxlRXZ'.'lbn'.'Rz'),base64_decode('RX'.'hlY3'.'V0ZU1vZHVsZU'.'V2Z'.'W5'.'0RXg='));$GLOBALS['____1084990108']= array(base64_decode('Z'.'GVm'.'aW5l'),base64_decode(''.'c3Ry'.'bGVu'),base64_decode('Y'.'mF'.'zZTY'.'0X2Rl'.'Y29k'.'ZQ=='),base64_decode('dW5zZXJ'.'pYWxpemU='),base64_decode('aXNfYXJyYXk='),base64_decode('Y291bnQ='),base64_decode('aW5fYX'.'JyY'.'Xk='),base64_decode('c2VyaWFsaXpl'),base64_decode('YmF'.'zZTY0X2V'.'uY29k'.'ZQ=='),base64_decode('c3Ryb'.'GVu'),base64_decode('YXJy'.'YXl'.'fa2V'.'5X2V4'.'aX'.'N0cw=='),base64_decode('YXJ'.'yYXlfa2V'.'5'.'X2V'.'4aXN0'.'cw='.'='),base64_decode('bWt0aW1l'),base64_decode('Z'.'GF0'.'Z'.'Q=='),base64_decode('ZG'.'F0ZQ='.'='),base64_decode('Y'.'XJyYXlf'.'a2V5'.'X2V4'.'aXN0cw=='),base64_decode(''.'c3Ry'.'bGV'.'u'),base64_decode('Y'.'X'.'JyY'.'Xlfa2'.'V5X2V4'.'aXN0cw=='),base64_decode('c3RybGV'.'u'),base64_decode('YXJyYXlf'.'a2'.'V'.'5X2V4a'.'XN0'.'cw'.'=='),base64_decode('Y'.'XJ'.'yYXlfa2'.'V'.'5X2V4a'.'XN'.'0cw'.'=='),base64_decode('bWt0aW1l'),base64_decode('Z'.'GF0ZQ='.'='),base64_decode('ZG'.'F0ZQ=='),base64_decode('bWV0aG9'.'kX2'.'V4a'.'X'.'N'.'0cw'.'=='),base64_decode('Y2F'.'sbF'.'9'.'1'.'c2VyX'.'2Z1'.'b'.'mNfYX'.'JyYXk='),base64_decode('c3Ryb'.'GV'.'u'),base64_decode('Y'.'XJy'.'Y'.'Xlfa2V'.'5'.'X2V4aXN'.'0cw=='),base64_decode('YXJyYXlfa2V5X2'.'V'.'4a'.'XN'.'0cw=='),base64_decode('c2V'.'yaWF'.'s'.'aXpl'),base64_decode('Y'.'mF'.'zZ'.'TY0X2VuY29k'.'Z'.'Q=='),base64_decode(''.'c'.'3Ry'.'bG'.'V'.'u'),base64_decode('Y'.'XJyYXlfa2V5X2V4aXN0cw=='),base64_decode('YXJ'.'yYX'.'lfa2V5'.'X2V4a'.'XN'.'0cw=='),base64_decode('YXJyYXl'.'fa2V5X2V4aXN0cw=='),base64_decode('aX'.'NfYXJyYXk='),base64_decode('YXJ'.'yYX'.'lf'.'a2'.'V5X2V4aXN'.'0'.'cw=='),base64_decode('c'.'2VyaWFs'.'aXpl'),base64_decode('YmFzZT'.'Y'.'0X'.'2'.'V'.'uY29'.'k'.'ZQ=='),base64_decode('YXJyYX'.'lfa2V5'.'X'.'2V4aXN0'.'cw=='),base64_decode('Y'.'XJyYXlfa2V5X2'.'V4aXN0c'.'w='.'='),base64_decode('c2VyaW'.'FsaXpl'),base64_decode('YmFzZTY0'.'X2VuY29'.'kZQ=='),base64_decode(''.'aX'.'N'.'fYXJyY'.'Xk='),base64_decode('aXNfYXJyYXk='),base64_decode('aW5'.'f'.'Y'.'XJ'.'yYXk'.'='),base64_decode('YXJyYX'.'lfa2V5X2V4aXN0cw'.'='.'='),base64_decode('aW5fYXJyYXk='),base64_decode('bW'.'t0'.'a'.'W1l'),base64_decode('ZGF0Z'.'Q=='),base64_decode('ZGF0ZQ'.'='.'='),base64_decode(''.'ZGF'.'0ZQ=='),base64_decode('bWt0'.'aW1l'),base64_decode('ZGF0ZQ=='),base64_decode('ZGF0ZQ=='),base64_decode('aW5'.'fYXJ'.'y'.'YXk='),base64_decode('YXJyYXlfa2V5X'.'2V4aXN0cw=='),base64_decode('YXJyYXl'.'fa2V5X2V4'.'aX'.'N0'.'cw'.'=='),base64_decode('c2VyaWFsaXpl'),base64_decode(''.'YmFzZ'.'TY0'.'X'.'2Vu'.'Y2'.'9kZ'.'Q='.'='),base64_decode('YXJyYX'.'lfa2V5'.'X2'.'V'.'4aXN0cw=='),base64_decode(''.'a'.'W5'.'0dmFs'),base64_decode('dGltZ'.'Q=='),base64_decode('YXJyYXlfa2V5X2V4'.'aXN0cw=='),base64_decode('Z'.'mlsZV9leG'.'lzd'.'HM='),base64_decode('c3RyX3'.'J'.'l'.'cG'.'x'.'hY2'.'U='),base64_decode('Y'.'2x'.'hc3NfZ'.'Xhpc3'.'Rz'),base64_decode('ZG'.'V'.'maW'.'5l'));if(!function_exists(__NAMESPACE__.'\\___2125515865')){function ___2125515865($_914929547){static $_677166890= false; if($_677166890 == false) $_677166890=array('S'.'U5U'.'Uk'.'FORVRfR'.'URJVElPTg='.'=',''.'WQ==','bWF'.'pbg==','f'.'mN'.'w'.'Zl9'.'t'.'YX'.'B'.'fdmFsdWU=','','ZQ==','Z'.'g==','Z'.'Q='.'=','R'.'g==',''.'W'.'A==','Zg==','bWFpbg'.'==','fmNw'.'Zl9tY'.'XBfdmFs'.'dWU=','UG9ydGFs','Rg='.'=','ZQ==','ZQ==','WA==','Rg='.'=',''.'R'.'A==','RA'.'==','bQ==','ZA='.'=','WQ==','Z'.'g='.'=','Zg'.'==','Zg'.'='.'=','Zg='.'=','U'.'G'.'9'.'y'.'d'.'GFs','Rg='.'=',''.'ZQ='.'=','Z'.'Q==','WA==','Rg==','RA==',''.'RA='.'=',''.'bQ==','ZA==','WQ==','bW'.'Fpb'.'g='.'=','T'.'24=','U2'.'V0dGl'.'uZ'.'3NDaGFu'.'Z2U=','Zg==',''.'Zg'.'==','Zg'.'==','Zg==',''.'bWF'.'p'.'b'.'g==','fmNw'.'Zl9'.'t'.'Y'.'X'.'B'.'fd'.'mFsd'.'W'.'U=','ZQ'.'==',''.'ZQ==','Z'.'Q==','RA==','Z'.'Q='.'=','ZQ==','Zg==','Zg==',''.'Z'.'g==','ZQ==','bWF'.'pb'.'g'.'==','fmN'.'w'.'Zl9'.'t'.'YXBfdmFs'.'dWU=','ZQ==','Zg='.'=',''.'Zg==',''.'Zg='.'=','Zg='.'=','bWFpbg==','fmNwZ'.'l9tY'.'XBfdmFsdWU=','ZQ='.'=','Z'.'g==','UG9ydGF'.'s','UG9ydGFs','ZQ'.'==','Z'.'Q='.'=','U'.'G9ydGFs','Rg==',''.'WA'.'='.'=','R'.'g'.'==','RA'.'==','Z'.'Q'.'='.'=','Z'.'Q==','RA==','bQ==',''.'ZA='.'=','WQ'.'==','Z'.'Q==','WA'.'==','Z'.'Q==','R'.'g'.'==','ZQ==','R'.'A='.'=','Zg='.'=',''.'ZQ'.'==','RA==',''.'ZQ==','bQ==',''.'Z'.'A==','WQ==','Zg==','Zg'.'==',''.'Zg='.'=',''.'Zg'.'==','Zg==','Zg'.'==','Zg==','Zg==',''.'bWF'.'pbg==','fmN'.'w'.'Zl'.'9tY'.'X'.'Bf'.'dmFsdWU=','ZQ==','ZQ==','UG9ydG'.'Fs','Rg==','W'.'A'.'==','VFlQRQ'.'==','R'.'EFU'.'RQ==','RkVBVFVSRVM=','RVhQSVJFR'.'A==','VFlQ'.'RQ==','RA==','VFJZX0'.'RBWVNfQ09V'.'Tl'.'Q=','REFUR'.'Q'.'==','VFJZ'.'X0R'.'BWV'.'Nf'.'Q09VTlQ=',''.'RV'.'h'.'QSVJFRA==','R'.'kVB'.'V'.'FVSRVM=','Z'.'g==','Zg==','R'.'E9DVU1FTlRfUk9P'.'VA==','L2Jpd'.'HJpeC9tb2R1bGVzLw='.'=','L2luc3RhbGw'.'vaW5kZ'.'Xgu'.'cGhw','Lg='.'=',''.'Xw==','c2VhcmN'.'o','Tg==','','','QUNUSVZF','WQ==',''.'c2'.'9jaWFsbmV0d29ya'.'w==',''.'YWxsb3d'.'fZnJ'.'pZWxkcw==','WQ='.'=','SUQ=',''.'c29jaWFsbmV0d2'.'9yaw==','YWxsb3dfZnJpZW'.'xkcw==',''.'SUQ=','c29'.'jaWFsbm'.'V0d2'.'9'.'yaw'.'==',''.'Y'.'Wxsb3dfZnJp'.'ZWxk'.'cw'.'='.'=',''.'Tg==','','',''.'QUNU'.'SVZF','WQ==',''.'c29'.'jaW'.'F'.'sbmV0d29yaw==','YWxsb3dfbWljc'.'m'.'9ibG9nX3VzZXI'.'=','WQ='.'=','SUQ'.'=','c29jaWFsb'.'mV0'.'d29yaw='.'=','YW'.'xsb3'.'dfbWljcm9'.'ib'.'G9n'.'X3VzZXI'.'=','SUQ=','c29'.'ja'.'WFsbmV0'.'d'.'29y'.'aw'.'==',''.'YW'.'xsb3dfbWljcm9'.'i'.'bG9nX3'.'Vz'.'ZXI'.'=','c29jaWF'.'sbmV0d'.'2'.'9'.'yaw='.'=','YWxsb'.'3'.'dfbWl'.'jcm9'.'ib'.'G9nX'.'2d'.'yb3Vw',''.'WQ==','SUQ=',''.'c29jaWFsbmV0d29yaw==',''.'YWxsb3'.'dfbWljcm'.'9i'.'bG9nX2dyb3Vw','S'.'UQ=','c29j'.'aWFsb'.'m'.'V0d2'.'9yaw==','YWx'.'sb3dfbWlj'.'c'.'m9ibG9nX2d'.'yb3V'.'w','Tg==','','','QU'.'N'.'USV'.'ZF','WQ='.'=','c29jaWFsbm'.'V0d29y'.'a'.'w='.'=','Y'.'Wxs'.'b'.'3'.'dfZmlsZXNfd'.'X'.'Nlcg'.'==','W'.'Q==',''.'SUQ=','c'.'2'.'9ja'.'W'.'FsbmV0d'.'29yaw='.'=','YWx'.'s'.'b3'.'dfZmlsZXN'.'fdX'.'Nlcg==','SUQ'.'=','c29jaW'.'FsbmV0d2'.'9yaw==','YWxsb'.'3'.'dfZ'.'ml'.'sZXN'.'fdX'.'N'.'l'.'cg==','Tg'.'==','','','Q'.'UNUSVZF','WQ='.'=','c'.'29jaWFsbm'.'V'.'0d29y'.'aw==',''.'YWxs'.'b3'.'dfYmx'.'vZ191c2'.'Vy',''.'WQ==','SU'.'Q=','c'.'29jaWFsbm'.'V'.'0d29'.'ya'.'w==','YWxsb'.'3dfYmxvZ191c'.'2Vy','SUQ=','c2'.'9jaWFs'.'bm'.'V0d'.'29yaw==','YWxsb3dfYm'.'xv'.'Z19'.'1c2Vy','Tg==','','',''.'QU'.'NUSV'.'ZF',''.'WQ==','c29ja'.'W'.'Fsb'.'mV0d29'.'ya'.'w==','YWxsb3'.'d'.'fc'.'GhvdG9f'.'d'.'X'.'Nlcg==','WQ==','SU'.'Q=','c'.'2'.'9ja'.'W'.'Fsbm'.'V0d29'.'yaw==',''.'YWxsb'.'3dfcGhvd'.'G9fdXNlcg==',''.'SUQ=','c29j'.'a'.'W'.'Fsb'.'mV'.'0d29yaw==','YWxsb3'.'dfcGh'.'vdG9fdX'.'Nl'.'cg==','Tg'.'==','','',''.'QUNU'.'SVZF','W'.'Q==','c29jaWFsbm'.'V0d2'.'9yaw==','YWx'.'sb'.'3dfZm9'.'ydW1fdXNl'.'cg==','W'.'Q='.'=','SU'.'Q'.'=',''.'c2'.'9'.'jaWFs'.'bm'.'V'.'0d29'.'ya'.'w'.'==','YW'.'xsb3'.'dfZm9ydW1'.'fdXNlcg==','SUQ'.'=','c29j'.'aWFsbmV0d29yaw'.'==','YWxsb3dfZ'.'m9'.'ydW1fdXNlcg'.'='.'=','Tg==','','','QU'.'NUSVZF','WQ==','c2'.'9ja'.'W'.'F'.'sbmV0'.'d'.'2'.'9'.'yaw==','Y'.'Wx'.'s'.'b3df'.'d'.'GFza3'.'Nfd'.'XNlcg==','W'.'Q==',''.'SUQ=','c29jaWFs'.'bmV0d29ya'.'w==','YW'.'x'.'s'.'b3dfdGFza'.'3Nf'.'dXN'.'lcg==',''.'S'.'UQ'.'=','c29jaWFsb'.'mV0d2'.'9yaw==','YW'.'xsb3dfdGFza3NfdXNlcg'.'==','c2'.'9jaWF'.'sbmV0'.'d29'.'ya'.'w='.'=','YWxsb3df'.'dGFz'.'a3NfZ3Jvd'.'X'.'A=','WQ==','SUQ=','c2'.'9ja'.'WFsbmV0d29'.'yaw==','YWxsb3dfdGFza3N'.'fZ3Jvd'.'XA=','SUQ=','c29j'.'aWFsb'.'mV0'.'d2'.'9yaw'.'==','YWxsb3'.'dfd'.'GFza'.'3NfZ3'.'JvdXA=',''.'dG'.'Fza3M'.'=',''.'Tg'.'='.'=','','','QUN'.'USV'.'ZF','WQ='.'=','c29jaWFsbmV0'.'d29yaw'.'==','YWxs'.'b3d'.'fY2FsZW5k'.'YXJfdXNlcg'.'='.'=','WQ==','SUQ=','c29jaWF'.'sbmV0d29y'.'aw==','YWx'.'s'.'b3dfY'.'2FsZW5kY'.'XJf'.'dXN'.'l'.'cg==','SUQ=','c29'.'jaWFsbm'.'V0d29'.'ya'.'w==',''.'YWxsb3'.'d'.'fY2'.'Fs'.'Z'.'W5kYXJ'.'fdXNlcg==',''.'c29j'.'aWFs'.'bm'.'V'.'0d'.'2'.'9yaw'.'==','YWxsb3df'.'Y'.'2FsZW5kYXJfZ3Jv'.'dXA=','WQ==','SU'.'Q=','c2'.'9jaW'.'FsbmV'.'0d29yaw==',''.'YWx'.'sb'.'3dfY'.'2FsZW5kYXJf'.'Z'.'3JvdXA'.'=','S'.'U'.'Q=','c2'.'9ja'.'WFs'.'b'.'mV0d29y'.'a'.'w='.'=','YWxsb3dfY2Fs'.'ZW5kYXJfZ3'.'JvdXA=','QUNUSV'.'ZF',''.'WQ='.'=','Tg'.'==','ZXh'.'0cmFuZXQ'.'=','aWJsb'.'2Nr','T25BZ'.'nRlcklCb'.'G9j'.'a'.'0Vs'.'Z'.'W1lb'.'n'.'RVcGR'.'hd'.'GU=','aW50c'.'mFuZXQ=',''.'Q0lu'.'dHJhbmV0'.'RXZlbnRIYW'.'5k'.'bGV'.'y'.'cw'.'='.'=','U1B'.'SZ'.'Wdp'.'c3'.'Rl'.'clVwZ'.'G'.'F0Z'.'WRJdGVt',''.'Q0lud'.'HJhbm'.'V0U2'.'hhcmVwb2ludDo'.'6QWdlbnRMaXN0'.'cygpOw'.'==','aW'.'50cmFu'.'ZX'.'Q=',''.'Tg==','Q0'.'lu'.'dHJhbm'.'V0U2hhc'.'mVwb2ludDo'.'6QWdlbnRRdWV'.'1Z'.'Sgp'.'Ow'.'==','a'.'W50cmFuZ'.'XQ=','Tg==','Q0'.'ludHJhbm'.'V0U2hhcm'.'Vw'.'b2lu'.'d'.'Do6QWdlbnRV'.'cGR'.'hdGUoKT'.'s=','a'.'W50'.'cm'.'F'.'uZ'.'XQ=','Tg='.'=',''.'aWJsb2Nr','T25BZnRl'.'cklCbG9ja0VsZW1lbnRB'.'Z'.'GQ'.'=','aW50cmF'.'uZ'.'XQ=',''.'Q0'.'l'.'udHJhbmV0RXZlb'.'nRIY'.'W'.'5kbG'.'Vycw==','U1BSZWdpc'.'3'.'RlclV'.'wZGF0Z'.'WR'.'J'.'d'.'G'.'V'.'t','a'.'W'.'Jsb2N'.'r','T'.'25BZn'.'Rlck'.'lCbG'.'9'.'ja0VsZW1lbnRVcGRhdG'.'U=','aW'.'50cmFuZ'.'XQ=',''.'Q0ludHJhb'.'mV0R'.'XZlbnRIYW5kbGVycw='.'=','U1BSZWdpc3R'.'lclVwZGF0ZWRJdG'.'Vt','Q0lu'.'d'.'H'.'JhbmV0U2hhcm'.'Vw'.'b2'.'l'.'udDo6QWdlbnRMaX'.'N0c'.'ygpOw==',''.'aW5'.'0cmF'.'u'.'ZXQ=','Q0lu'.'dH'.'JhbmV0U2hhcmV'.'wb2l'.'udDo6Q'.'WdlbnR'.'RdWV1ZSgpOw'.'==','aW50cmFuZXQ=','Q'.'0lu'.'dH'.'Jhbm'.'V'.'0U2hhcmV'.'wb2ludDo'.'6QWdlbnRV'.'cG'.'RhdGU'.'o'.'KTs=','aW5'.'0cmFuZ'.'XQ=',''.'Y3Jt','bWFpbg==','T25CZWZ'.'vcmVQcm9sb2c=',''.'bWFpbg==','Q'.'1dpem'.'FyZFNvbFBhbm'.'V'.'sSW50c'.'m'.'FuZX'.'Q=','U2hvd'.'1Bhbm'.'Vs','L21vZHVsZXMva'.'W50cmFuZXQvcGFu'.'ZWx'.'fY'.'nV'.'0'.'dG9uL'.'nBocA='.'=','R'.'U5DT'.'0RF','WQ==');return base64_decode($_677166890[$_914929547]);}};$GLOBALS['____1084990108'][0](___2125515865(0), ___2125515865(1));class CBXFeatures{ private static $_1134879887= 30; private static $_447850007= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller",), "Holding" => array( "Cluster", "MultiSites",),); private static $_42027364= false; private static $_1390721070= false; private static function __1649552849(){ if(self::$_42027364 == false){ self::$_42027364= array(); foreach(self::$_447850007 as $_436540816 => $_1583885008){ foreach($_1583885008 as $_2087735441) self::$_42027364[$_2087735441]= $_436540816;}} if(self::$_1390721070 == false){ self::$_1390721070= array(); $_1777190422= COption::GetOptionString(___2125515865(2), ___2125515865(3), ___2125515865(4)); if($GLOBALS['____1084990108'][1]($_1777190422)>(240*2-480)){ $_1777190422= $GLOBALS['____1084990108'][2]($_1777190422); self::$_1390721070= $GLOBALS['____1084990108'][3]($_1777190422); if(!$GLOBALS['____1084990108'][4](self::$_1390721070)) self::$_1390721070= array();} if($GLOBALS['____1084990108'][5](self::$_1390721070) <=(976-2*488)) self::$_1390721070= array(___2125515865(5) => array(), ___2125515865(6) => array());}} public static function InitiateEditionsSettings($_1747834056){ self::__1649552849(); $_783119842= array(); foreach(self::$_447850007 as $_436540816 => $_1583885008){ $_1528100038= $GLOBALS['____1084990108'][6]($_436540816, $_1747834056); self::$_1390721070[___2125515865(7)][$_436540816]=($_1528100038? array(___2125515865(8)): array(___2125515865(9))); foreach($_1583885008 as $_2087735441){ self::$_1390721070[___2125515865(10)][$_2087735441]= $_1528100038; if(!$_1528100038) $_783119842[]= array($_2087735441, false);}} $_1416195301= $GLOBALS['____1084990108'][7](self::$_1390721070); $_1416195301= $GLOBALS['____1084990108'][8]($_1416195301); COption::SetOptionString(___2125515865(11), ___2125515865(12), $_1416195301); foreach($_783119842 as $_442710324) self::__2146697917($_442710324[(920-2*460)], $_442710324[round(0+1)]);} public static function IsFeatureEnabled($_2087735441){ if($GLOBALS['____1084990108'][9]($_2087735441) <= 0) return true; self::__1649552849(); if(!$GLOBALS['____1084990108'][10]($_2087735441, self::$_42027364)) return true; if(self::$_42027364[$_2087735441] == ___2125515865(13)) $_982030773= array(___2125515865(14)); elseif($GLOBALS['____1084990108'][11](self::$_42027364[$_2087735441], self::$_1390721070[___2125515865(15)])) $_982030773= self::$_1390721070[___2125515865(16)][self::$_42027364[$_2087735441]]; else $_982030773= array(___2125515865(17)); if($_982030773[(224*2-448)] != ___2125515865(18) && $_982030773[(910-2*455)] != ___2125515865(19)){ return false;} elseif($_982030773[(1036/2-518)] == ___2125515865(20)){ if($_982030773[round(0+0.25+0.25+0.25+0.25)]< $GLOBALS['____1084990108'][12]((1392/2-696),(142*2-284),(1260/2-630), Date(___2125515865(21)), $GLOBALS['____1084990108'][13](___2125515865(22))- self::$_1134879887, $GLOBALS['____1084990108'][14](___2125515865(23)))){ if(!isset($_982030773[round(0+0.4+0.4+0.4+0.4+0.4)]) ||!$_982030773[round(0+2)]) self::__759400522(self::$_42027364[$_2087735441]); return false;}} return!$GLOBALS['____1084990108'][15]($_2087735441, self::$_1390721070[___2125515865(24)]) || self::$_1390721070[___2125515865(25)][$_2087735441];} public static function IsFeatureInstalled($_2087735441){ if($GLOBALS['____1084990108'][16]($_2087735441) <= 0) return true; self::__1649552849(); return($GLOBALS['____1084990108'][17]($_2087735441, self::$_1390721070[___2125515865(26)]) && self::$_1390721070[___2125515865(27)][$_2087735441]);} public static function IsFeatureEditable($_2087735441){ if($GLOBALS['____1084990108'][18]($_2087735441) <= 0) return true; self::__1649552849(); if(!$GLOBALS['____1084990108'][19]($_2087735441, self::$_42027364)) return true; if(self::$_42027364[$_2087735441] == ___2125515865(28)) $_982030773= array(___2125515865(29)); elseif($GLOBALS['____1084990108'][20](self::$_42027364[$_2087735441], self::$_1390721070[___2125515865(30)])) $_982030773= self::$_1390721070[___2125515865(31)][self::$_42027364[$_2087735441]]; else $_982030773= array(___2125515865(32)); if($_982030773[(189*2-378)] != ___2125515865(33) && $_982030773[(856-2*428)] != ___2125515865(34)){ return false;} elseif($_982030773[(205*2-410)] == ___2125515865(35)){ if($_982030773[round(0+0.2+0.2+0.2+0.2+0.2)]< $GLOBALS['____1084990108'][21]((792-2*396),(150*2-300),(768-2*384), Date(___2125515865(36)), $GLOBALS['____1084990108'][22](___2125515865(37))- self::$_1134879887, $GLOBALS['____1084990108'][23](___2125515865(38)))){ if(!isset($_982030773[round(0+2)]) ||!$_982030773[round(0+0.4+0.4+0.4+0.4+0.4)]) self::__759400522(self::$_42027364[$_2087735441]); return false;}} return true;} private static function __2146697917($_2087735441, $_1168054508){ if($GLOBALS['____1084990108'][24]("CBXFeatures", "On".$_2087735441."SettingsChange")) $GLOBALS['____1084990108'][25](array("CBXFeatures", "On".$_2087735441."SettingsChange"), array($_2087735441, $_1168054508)); $_2118037301= $GLOBALS['_____740972820'][0](___2125515865(39), ___2125515865(40).$_2087735441.___2125515865(41)); while($_375623897= $_2118037301->Fetch()) $GLOBALS['_____740972820'][1]($_375623897, array($_2087735441, $_1168054508));} public static function SetFeatureEnabled($_2087735441, $_1168054508= true, $_564207389= true){ if($GLOBALS['____1084990108'][26]($_2087735441) <= 0) return; if(!self::IsFeatureEditable($_2087735441)) $_1168054508= false; $_1168054508=($_1168054508? true: false); self::__1649552849(); $_1932730065=(!$GLOBALS['____1084990108'][27]($_2087735441, self::$_1390721070[___2125515865(42)]) && $_1168054508 || $GLOBALS['____1084990108'][28]($_2087735441, self::$_1390721070[___2125515865(43)]) && $_1168054508 != self::$_1390721070[___2125515865(44)][$_2087735441]); self::$_1390721070[___2125515865(45)][$_2087735441]= $_1168054508; $_1416195301= $GLOBALS['____1084990108'][29](self::$_1390721070); $_1416195301= $GLOBALS['____1084990108'][30]($_1416195301); COption::SetOptionString(___2125515865(46), ___2125515865(47), $_1416195301); if($_1932730065 && $_564207389) self::__2146697917($_2087735441, $_1168054508);} private static function __759400522($_436540816){ if($GLOBALS['____1084990108'][31]($_436540816) <= 0 || $_436540816 == "Portal") return; self::__1649552849(); if(!$GLOBALS['____1084990108'][32]($_436540816, self::$_1390721070[___2125515865(48)]) || $GLOBALS['____1084990108'][33]($_436540816, self::$_1390721070[___2125515865(49)]) && self::$_1390721070[___2125515865(50)][$_436540816][(798-2*399)] != ___2125515865(51)) return; if(isset(self::$_1390721070[___2125515865(52)][$_436540816][round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) && self::$_1390721070[___2125515865(53)][$_436540816][round(0+0.4+0.4+0.4+0.4+0.4)]) return; $_783119842= array(); if($GLOBALS['____1084990108'][34]($_436540816, self::$_447850007) && $GLOBALS['____1084990108'][35](self::$_447850007[$_436540816])){ foreach(self::$_447850007[$_436540816] as $_2087735441){ if($GLOBALS['____1084990108'][36]($_2087735441, self::$_1390721070[___2125515865(54)]) && self::$_1390721070[___2125515865(55)][$_2087735441]){ self::$_1390721070[___2125515865(56)][$_2087735441]= false; $_783119842[]= array($_2087735441, false);}} self::$_1390721070[___2125515865(57)][$_436540816][round(0+0.5+0.5+0.5+0.5)]= true;} $_1416195301= $GLOBALS['____1084990108'][37](self::$_1390721070); $_1416195301= $GLOBALS['____1084990108'][38]($_1416195301); COption::SetOptionString(___2125515865(58), ___2125515865(59), $_1416195301); foreach($_783119842 as $_442710324) self::__2146697917($_442710324[(888-2*444)], $_442710324[round(0+0.25+0.25+0.25+0.25)]);} public static function ModifyFeaturesSettings($_1747834056, $_1583885008){ self::__1649552849(); foreach($_1747834056 as $_436540816 => $_1075339042) self::$_1390721070[___2125515865(60)][$_436540816]= $_1075339042; $_783119842= array(); foreach($_1583885008 as $_2087735441 => $_1168054508){ if(!$GLOBALS['____1084990108'][39]($_2087735441, self::$_1390721070[___2125515865(61)]) && $_1168054508 || $GLOBALS['____1084990108'][40]($_2087735441, self::$_1390721070[___2125515865(62)]) && $_1168054508 != self::$_1390721070[___2125515865(63)][$_2087735441]) $_783119842[]= array($_2087735441, $_1168054508); self::$_1390721070[___2125515865(64)][$_2087735441]= $_1168054508;} $_1416195301= $GLOBALS['____1084990108'][41](self::$_1390721070); $_1416195301= $GLOBALS['____1084990108'][42]($_1416195301); COption::SetOptionString(___2125515865(65), ___2125515865(66), $_1416195301); self::$_1390721070= false; foreach($_783119842 as $_442710324) self::__2146697917($_442710324[(1488/2-744)], $_442710324[round(0+0.5+0.5)]);} public static function SaveFeaturesSettings($_13499312, $_407489592){ self::__1649552849(); $_168789259= array(___2125515865(67) => array(), ___2125515865(68) => array()); if(!$GLOBALS['____1084990108'][43]($_13499312)) $_13499312= array(); if(!$GLOBALS['____1084990108'][44]($_407489592)) $_407489592= array(); if(!$GLOBALS['____1084990108'][45](___2125515865(69), $_13499312)) $_13499312[]= ___2125515865(70); foreach(self::$_447850007 as $_436540816 => $_1583885008){ if($GLOBALS['____1084990108'][46]($_436540816, self::$_1390721070[___2125515865(71)])) $_586014351= self::$_1390721070[___2125515865(72)][$_436540816]; else $_586014351=($_436540816 == ___2125515865(73))? array(___2125515865(74)): array(___2125515865(75)); if($_586014351[min(244,0,81.333333333333)] == ___2125515865(76) || $_586014351[min(188,0,62.666666666667)] == ___2125515865(77)){ $_168789259[___2125515865(78)][$_436540816]= $_586014351;} else{ if($GLOBALS['____1084990108'][47]($_436540816, $_13499312)) $_168789259[___2125515865(79)][$_436540816]= array(___2125515865(80), $GLOBALS['____1084990108'][48](min(160,0,53.333333333333), min(194,0,64.666666666667), min(112,0,37.333333333333), $GLOBALS['____1084990108'][49](___2125515865(81)), $GLOBALS['____1084990108'][50](___2125515865(82)), $GLOBALS['____1084990108'][51](___2125515865(83)))); else $_168789259[___2125515865(84)][$_436540816]= array(___2125515865(85));}} $_783119842= array(); foreach(self::$_42027364 as $_2087735441 => $_436540816){ if($_168789259[___2125515865(86)][$_436540816][(231*2-462)] != ___2125515865(87) && $_168789259[___2125515865(88)][$_436540816][(1416/2-708)] != ___2125515865(89)){ $_168789259[___2125515865(90)][$_2087735441]= false;} else{ if($_168789259[___2125515865(91)][$_436540816][(240*2-480)] == ___2125515865(92) && $_168789259[___2125515865(93)][$_436540816][round(0+1)]< $GLOBALS['____1084990108'][52]((924-2*462),(1388/2-694), min(66,0,22), Date(___2125515865(94)), $GLOBALS['____1084990108'][53](___2125515865(95))- self::$_1134879887, $GLOBALS['____1084990108'][54](___2125515865(96)))) $_168789259[___2125515865(97)][$_2087735441]= false; else $_168789259[___2125515865(98)][$_2087735441]= $GLOBALS['____1084990108'][55]($_2087735441, $_407489592); if(!$GLOBALS['____1084990108'][56]($_2087735441, self::$_1390721070[___2125515865(99)]) && $_168789259[___2125515865(100)][$_2087735441] || $GLOBALS['____1084990108'][57]($_2087735441, self::$_1390721070[___2125515865(101)]) && $_168789259[___2125515865(102)][$_2087735441] != self::$_1390721070[___2125515865(103)][$_2087735441]) $_783119842[]= array($_2087735441, $_168789259[___2125515865(104)][$_2087735441]);}} $_1416195301= $GLOBALS['____1084990108'][58]($_168789259); $_1416195301= $GLOBALS['____1084990108'][59]($_1416195301); COption::SetOptionString(___2125515865(105), ___2125515865(106), $_1416195301); self::$_1390721070= false; foreach($_783119842 as $_442710324) self::__2146697917($_442710324[(195*2-390)], $_442710324[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function GetFeaturesList(){ self::__1649552849(); $_1112153039= array(); foreach(self::$_447850007 as $_436540816 => $_1583885008){ if($GLOBALS['____1084990108'][60]($_436540816, self::$_1390721070[___2125515865(107)])) $_586014351= self::$_1390721070[___2125515865(108)][$_436540816]; else $_586014351=($_436540816 == ___2125515865(109))? array(___2125515865(110)): array(___2125515865(111)); $_1112153039[$_436540816]= array( ___2125515865(112) => $_586014351[(1428/2-714)], ___2125515865(113) => $_586014351[round(0+0.2+0.2+0.2+0.2+0.2)], ___2125515865(114) => array(),); $_1112153039[$_436540816][___2125515865(115)]= false; if($_1112153039[$_436540816][___2125515865(116)] == ___2125515865(117)){ $_1112153039[$_436540816][___2125515865(118)]= $GLOBALS['____1084990108'][61](($GLOBALS['____1084990108'][62]()- $_1112153039[$_436540816][___2125515865(119)])/ round(0+17280+17280+17280+17280+17280)); if($_1112153039[$_436540816][___2125515865(120)]> self::$_1134879887) $_1112153039[$_436540816][___2125515865(121)]= true;} foreach($_1583885008 as $_2087735441) $_1112153039[$_436540816][___2125515865(122)][$_2087735441]=(!$GLOBALS['____1084990108'][63]($_2087735441, self::$_1390721070[___2125515865(123)]) || self::$_1390721070[___2125515865(124)][$_2087735441]);} return $_1112153039;} private static function __1175259680($_1166731201, $_1359724491){ if(IsModuleInstalled($_1166731201) == $_1359724491) return true; $_882977429= $_SERVER[___2125515865(125)].___2125515865(126).$_1166731201.___2125515865(127); if(!$GLOBALS['____1084990108'][64]($_882977429)) return false; include_once($_882977429); $_311913484= $GLOBALS['____1084990108'][65](___2125515865(128), ___2125515865(129), $_1166731201); if(!$GLOBALS['____1084990108'][66]($_311913484)) return false; $_1917100344= new $_311913484; if($_1359724491){ if(!$_1917100344->InstallDB()) return false; $_1917100344->InstallEvents(); if(!$_1917100344->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___2125515865(130))) CSearch::DeleteIndex($_1166731201); UnRegisterModule($_1166731201);} return true;} protected static function OnRequestsSettingsChange($_2087735441, $_1168054508){ self::__1175259680("form", $_1168054508);} protected static function OnLearningSettingsChange($_2087735441, $_1168054508){ self::__1175259680("learning", $_1168054508);} protected static function OnJabberSettingsChange($_2087735441, $_1168054508){ self::__1175259680("xmpp", $_1168054508);} protected static function OnVideoConferenceSettingsChange($_2087735441, $_1168054508){ self::__1175259680("video", $_1168054508);} protected static function OnBizProcSettingsChange($_2087735441, $_1168054508){ self::__1175259680("bizprocdesigner", $_1168054508);} protected static function OnListsSettingsChange($_2087735441, $_1168054508){ self::__1175259680("lists", $_1168054508);} protected static function OnWikiSettingsChange($_2087735441, $_1168054508){ self::__1175259680("wiki", $_1168054508);} protected static function OnSupportSettingsChange($_2087735441, $_1168054508){ self::__1175259680("support", $_1168054508);} protected static function OnControllerSettingsChange($_2087735441, $_1168054508){ self::__1175259680("controller", $_1168054508);} protected static function OnAnalyticsSettingsChange($_2087735441, $_1168054508){ self::__1175259680("statistic", $_1168054508);} protected static function OnVoteSettingsChange($_2087735441, $_1168054508){ self::__1175259680("vote", $_1168054508);} protected static function OnFriendsSettingsChange($_2087735441, $_1168054508){ if($_1168054508) $_1527036426= "Y"; else $_1527036426= ___2125515865(131); $_1778048149= CSite::GetList(($_1528100038= ___2125515865(132)),($_401153388= ___2125515865(133)), array(___2125515865(134) => ___2125515865(135))); while($_700568144= $_1778048149->Fetch()){ if(COption::GetOptionString(___2125515865(136), ___2125515865(137), ___2125515865(138), $_700568144[___2125515865(139)]) != $_1527036426){ COption::SetOptionString(___2125515865(140), ___2125515865(141), $_1527036426, false, $_700568144[___2125515865(142)]); COption::SetOptionString(___2125515865(143), ___2125515865(144), $_1527036426);}}} protected static function OnMicroBlogSettingsChange($_2087735441, $_1168054508){ if($_1168054508) $_1527036426= "Y"; else $_1527036426= ___2125515865(145); $_1778048149= CSite::GetList(($_1528100038= ___2125515865(146)),($_401153388= ___2125515865(147)), array(___2125515865(148) => ___2125515865(149))); while($_700568144= $_1778048149->Fetch()){ if(COption::GetOptionString(___2125515865(150), ___2125515865(151), ___2125515865(152), $_700568144[___2125515865(153)]) != $_1527036426){ COption::SetOptionString(___2125515865(154), ___2125515865(155), $_1527036426, false, $_700568144[___2125515865(156)]); COption::SetOptionString(___2125515865(157), ___2125515865(158), $_1527036426);} if(COption::GetOptionString(___2125515865(159), ___2125515865(160), ___2125515865(161), $_700568144[___2125515865(162)]) != $_1527036426){ COption::SetOptionString(___2125515865(163), ___2125515865(164), $_1527036426, false, $_700568144[___2125515865(165)]); COption::SetOptionString(___2125515865(166), ___2125515865(167), $_1527036426);}}} protected static function OnPersonalFilesSettingsChange($_2087735441, $_1168054508){ if($_1168054508) $_1527036426= "Y"; else $_1527036426= ___2125515865(168); $_1778048149= CSite::GetList(($_1528100038= ___2125515865(169)),($_401153388= ___2125515865(170)), array(___2125515865(171) => ___2125515865(172))); while($_700568144= $_1778048149->Fetch()){ if(COption::GetOptionString(___2125515865(173), ___2125515865(174), ___2125515865(175), $_700568144[___2125515865(176)]) != $_1527036426){ COption::SetOptionString(___2125515865(177), ___2125515865(178), $_1527036426, false, $_700568144[___2125515865(179)]); COption::SetOptionString(___2125515865(180), ___2125515865(181), $_1527036426);}}} protected static function OnPersonalBlogSettingsChange($_2087735441, $_1168054508){ if($_1168054508) $_1527036426= "Y"; else $_1527036426= ___2125515865(182); $_1778048149= CSite::GetList(($_1528100038= ___2125515865(183)),($_401153388= ___2125515865(184)), array(___2125515865(185) => ___2125515865(186))); while($_700568144= $_1778048149->Fetch()){ if(COption::GetOptionString(___2125515865(187), ___2125515865(188), ___2125515865(189), $_700568144[___2125515865(190)]) != $_1527036426){ COption::SetOptionString(___2125515865(191), ___2125515865(192), $_1527036426, false, $_700568144[___2125515865(193)]); COption::SetOptionString(___2125515865(194), ___2125515865(195), $_1527036426);}}} protected static function OnPersonalPhotoSettingsChange($_2087735441, $_1168054508){ if($_1168054508) $_1527036426= "Y"; else $_1527036426= ___2125515865(196); $_1778048149= CSite::GetList(($_1528100038= ___2125515865(197)),($_401153388= ___2125515865(198)), array(___2125515865(199) => ___2125515865(200))); while($_700568144= $_1778048149->Fetch()){ if(COption::GetOptionString(___2125515865(201), ___2125515865(202), ___2125515865(203), $_700568144[___2125515865(204)]) != $_1527036426){ COption::SetOptionString(___2125515865(205), ___2125515865(206), $_1527036426, false, $_700568144[___2125515865(207)]); COption::SetOptionString(___2125515865(208), ___2125515865(209), $_1527036426);}}} protected static function OnPersonalForumSettingsChange($_2087735441, $_1168054508){ if($_1168054508) $_1527036426= "Y"; else $_1527036426= ___2125515865(210); $_1778048149= CSite::GetList(($_1528100038= ___2125515865(211)),($_401153388= ___2125515865(212)), array(___2125515865(213) => ___2125515865(214))); while($_700568144= $_1778048149->Fetch()){ if(COption::GetOptionString(___2125515865(215), ___2125515865(216), ___2125515865(217), $_700568144[___2125515865(218)]) != $_1527036426){ COption::SetOptionString(___2125515865(219), ___2125515865(220), $_1527036426, false, $_700568144[___2125515865(221)]); COption::SetOptionString(___2125515865(222), ___2125515865(223), $_1527036426);}}} protected static function OnTasksSettingsChange($_2087735441, $_1168054508){ if($_1168054508) $_1527036426= "Y"; else $_1527036426= ___2125515865(224); $_1778048149= CSite::GetList(($_1528100038= ___2125515865(225)),($_401153388= ___2125515865(226)), array(___2125515865(227) => ___2125515865(228))); while($_700568144= $_1778048149->Fetch()){ if(COption::GetOptionString(___2125515865(229), ___2125515865(230), ___2125515865(231), $_700568144[___2125515865(232)]) != $_1527036426){ COption::SetOptionString(___2125515865(233), ___2125515865(234), $_1527036426, false, $_700568144[___2125515865(235)]); COption::SetOptionString(___2125515865(236), ___2125515865(237), $_1527036426);} if(COption::GetOptionString(___2125515865(238), ___2125515865(239), ___2125515865(240), $_700568144[___2125515865(241)]) != $_1527036426){ COption::SetOptionString(___2125515865(242), ___2125515865(243), $_1527036426, false, $_700568144[___2125515865(244)]); COption::SetOptionString(___2125515865(245), ___2125515865(246), $_1527036426);}} self::__1175259680(___2125515865(247), $_1168054508);} protected static function OnCalendarSettingsChange($_2087735441, $_1168054508){ if($_1168054508) $_1527036426= "Y"; else $_1527036426= ___2125515865(248); $_1778048149= CSite::GetList(($_1528100038= ___2125515865(249)),($_401153388= ___2125515865(250)), array(___2125515865(251) => ___2125515865(252))); while($_700568144= $_1778048149->Fetch()){ if(COption::GetOptionString(___2125515865(253), ___2125515865(254), ___2125515865(255), $_700568144[___2125515865(256)]) != $_1527036426){ COption::SetOptionString(___2125515865(257), ___2125515865(258), $_1527036426, false, $_700568144[___2125515865(259)]); COption::SetOptionString(___2125515865(260), ___2125515865(261), $_1527036426);} if(COption::GetOptionString(___2125515865(262), ___2125515865(263), ___2125515865(264), $_700568144[___2125515865(265)]) != $_1527036426){ COption::SetOptionString(___2125515865(266), ___2125515865(267), $_1527036426, false, $_700568144[___2125515865(268)]); COption::SetOptionString(___2125515865(269), ___2125515865(270), $_1527036426);}}} protected static function OnSMTPSettingsChange($_2087735441, $_1168054508){ self::__1175259680("mail", $_1168054508);} protected static function OnExtranetSettingsChange($_2087735441, $_1168054508){ $_75310143= COption::GetOptionString("extranet", "extranet_site", ""); if($_75310143){ $_988169904= new CSite; $_988169904->Update($_75310143, array(___2125515865(271) =>($_1168054508? ___2125515865(272): ___2125515865(273))));} self::__1175259680(___2125515865(274), $_1168054508);} protected static function OnDAVSettingsChange($_2087735441, $_1168054508){ self::__1175259680("dav", $_1168054508);} protected static function OntimemanSettingsChange($_2087735441, $_1168054508){ self::__1175259680("timeman", $_1168054508);} protected static function Onintranet_sharepointSettingsChange($_2087735441, $_1168054508){ if($_1168054508){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___2125515865(275), ___2125515865(276), ___2125515865(277), ___2125515865(278), ___2125515865(279)); CAgent::AddAgent(___2125515865(280), ___2125515865(281), ___2125515865(282), round(0+500)); CAgent::AddAgent(___2125515865(283), ___2125515865(284), ___2125515865(285), round(0+60+60+60+60+60)); CAgent::AddAgent(___2125515865(286), ___2125515865(287), ___2125515865(288), round(0+720+720+720+720+720));} else{ UnRegisterModuleDependences(___2125515865(289), ___2125515865(290), ___2125515865(291), ___2125515865(292), ___2125515865(293)); UnRegisterModuleDependences(___2125515865(294), ___2125515865(295), ___2125515865(296), ___2125515865(297), ___2125515865(298)); CAgent::RemoveAgent(___2125515865(299), ___2125515865(300)); CAgent::RemoveAgent(___2125515865(301), ___2125515865(302)); CAgent::RemoveAgent(___2125515865(303), ___2125515865(304));}} protected static function OncrmSettingsChange($_2087735441, $_1168054508){ if($_1168054508) COption::SetOptionString("crm", "form_features", "Y"); self::__1175259680(___2125515865(305), $_1168054508);} protected static function OnClusterSettingsChange($_2087735441, $_1168054508){ self::__1175259680("cluster", $_1168054508);} protected static function OnMultiSitesSettingsChange($_2087735441, $_1168054508){ if($_1168054508) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___2125515865(306), ___2125515865(307), ___2125515865(308), ___2125515865(309), ___2125515865(310), ___2125515865(311));} protected static function OnIdeaSettingsChange($_2087735441, $_1168054508){ self::__1175259680("idea", $_1168054508);} protected static function OnMeetingSettingsChange($_2087735441, $_1168054508){ self::__1175259680("meeting", $_1168054508);} protected static function OnXDImportSettingsChange($_2087735441, $_1168054508){ self::__1175259680("xdimport", $_1168054508);}} $GLOBALS['____1084990108'][67](___2125515865(312), ___2125515865(313));/**/			//Do not remove this

//component 2.0 template engines
$GLOBALS["arCustomTemplateEngines"] = array();

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/urlrewriter.php");

/**
 * Defined in dbconn.php
 * @param string $DBType
 */

\Bitrix\Main\Loader::registerAutoLoadClasses(
	"main",
	array(
		"CSiteTemplate" => "classes/general/site_template.php",
		"CBitrixComponent" => "classes/general/component.php",
		"CComponentEngine" => "classes/general/component_engine.php",
		"CComponentAjax" => "classes/general/component_ajax.php",
		"CBitrixComponentTemplate" => "classes/general/component_template.php",
		"CComponentUtil" => "classes/general/component_util.php",
		"CControllerClient" => "classes/general/controller_member.php",
		"PHPParser" => "classes/general/php_parser.php",
		"CDiskQuota" => "classes/".$DBType."/quota.php",
		"CEventLog" => "classes/general/event_log.php",
		"CEventMain" => "classes/general/event_log.php",
		"CAdminFileDialog" => "classes/general/file_dialog.php",
		"WLL_User" => "classes/general/liveid.php",
		"WLL_ConsentToken" => "classes/general/liveid.php",
		"WindowsLiveLogin" => "classes/general/liveid.php",
		"CAllFile" => "classes/general/file.php",
		"CFile" => "classes/".$DBType."/file.php",
		"CTempFile" => "classes/general/file_temp.php",
		"CFavorites" => "classes/".$DBType."/favorites.php",
		"CUserOptions" => "classes/general/user_options.php",
		"CGridOptions" => "classes/general/grids.php",
		"CUndo" => "/classes/general/undo.php",
		"CAutoSave" => "/classes/general/undo.php",
		"CRatings" => "classes/".$DBType."/ratings.php",
		"CRatingsComponentsMain" => "classes/".$DBType."/ratings_components.php",
		"CRatingRule" => "classes/general/rating_rule.php",
		"CRatingRulesMain" => "classes/".$DBType."/rating_rules.php",
		"CTopPanel" => "public/top_panel.php",
		"CEditArea" => "public/edit_area.php",
		"CComponentPanel" => "public/edit_area.php",
		"CTextParser" => "classes/general/textparser.php",
		"CPHPCacheFiles" => "classes/general/cache_files.php",
		"CDataXML" => "classes/general/xml.php",
		"CXMLFileStream" => "classes/general/xml.php",
		"CRsaProvider" => "classes/general/rsasecurity.php",
		"CRsaSecurity" => "classes/general/rsasecurity.php",
		"CRsaBcmathProvider" => "classes/general/rsabcmath.php",
		"CRsaOpensslProvider" => "classes/general/rsaopenssl.php",
		"CASNReader" => "classes/general/asn.php",
		"CBXShortUri" => "classes/".$DBType."/short_uri.php",
		"CFinder" => "classes/general/finder.php",
		"CAccess" => "classes/general/access.php",
		"CAuthProvider" => "classes/general/authproviders.php",
		"IProviderInterface" => "classes/general/authproviders.php",
		"CGroupAuthProvider" => "classes/general/authproviders.php",
		"CUserAuthProvider" => "classes/general/authproviders.php",
		"CTableSchema" => "classes/general/table_schema.php",
		"CCSVData" => "classes/general/csv_data.php",
		"CSmile" => "classes/general/smile.php",
		"CSmileGallery" => "classes/general/smile.php",
		"CSmileSet" => "classes/general/smile.php",
		"CGlobalCounter" => "classes/general/global_counter.php",
		"CUserCounter" => "classes/".$DBType."/user_counter.php",
		"CUserCounterPage" => "classes/".$DBType."/user_counter.php",
		"CHotKeys" => "classes/general/hot_keys.php",
		"CHotKeysCode" => "classes/general/hot_keys.php",
		"CBXSanitizer" => "classes/general/sanitizer.php",
		"CBXArchive" => "classes/general/archive.php",
		"CAdminNotify" => "classes/general/admin_notify.php",
		"CBXFavAdmMenu" => "classes/general/favorites.php",
		"CAdminInformer" => "classes/general/admin_informer.php",
		"CSiteCheckerTest" => "classes/general/site_checker.php",
		"CSqlUtil" => "classes/general/sql_util.php",
		"CFileUploader" => "classes/general/uploader.php",
		"LPA" => "classes/general/lpa.php",
		"CAdminFilter" => "interface/admin_filter.php",
		"CAdminList" => "interface/admin_list.php",
		"CAdminUiList" => "interface/admin_ui_list.php",
		"CAdminUiResult" => "interface/admin_ui_list.php",
		"CAdminUiContextMenu" => "interface/admin_ui_list.php",
		"CAdminListRow" => "interface/admin_list.php",
		"CAdminTabControl" => "interface/admin_tabcontrol.php",
		"CAdminForm" => "interface/admin_form.php",
		"CAdminFormSettings" => "interface/admin_form.php",
		"CAdminTabControlDrag" => "interface/admin_tabcontrol_drag.php",
		"CAdminDraggableBlockEngine" => "interface/admin_tabcontrol_drag.php",
		"CJSPopup" => "interface/jspopup.php",
		"CJSPopupOnPage" => "interface/jspopup.php",
		"CAdminCalendar" => "interface/admin_calendar.php",
		"CAdminViewTabControl" => "interface/admin_viewtabcontrol.php",
		"CAdminTabEngine" => "interface/admin_tabengine.php",
		"CCaptcha" => "classes/general/captcha.php",
		"CMpNotifications" => "classes/general/mp_notifications.php",

		//deprecated
		"CHTMLPagesCache" => "lib/composite/helper.php",
		"StaticHtmlMemcachedResponse" => "lib/composite/responder.php",
		"StaticHtmlFileResponse" => "lib/composite/responder.php",
		"Bitrix\\Main\\Page\\Frame" => "lib/composite/engine.php",
		"Bitrix\\Main\\Page\\FrameStatic" => "lib/composite/staticarea.php",
		"Bitrix\\Main\\Page\\FrameBuffered" => "lib/composite/bufferarea.php",
		"Bitrix\\Main\\Page\\FrameHelper" => "lib/composite/bufferarea.php",
		"Bitrix\\Main\\Data\\StaticHtmlCache" => "lib/composite/page.php",
		"Bitrix\\Main\\Data\\StaticHtmlStorage" => "lib/composite/data/abstractstorage.php",
		"Bitrix\\Main\\Data\\StaticHtmlFileStorage" => "lib/composite/data/filestorage.php",
		"Bitrix\\Main\\Data\\StaticHtmlMemcachedStorage" => "lib/composite/data/memcachedstorage.php",
		"Bitrix\\Main\\Data\\StaticCacheProvider" => "lib/composite/data/cacheprovider.php",
		"Bitrix\\Main\\Data\\AppCacheManifest" => "lib/composite/appcache.php",
	)
);

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/agent.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/user.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/event.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/menu.php");
AddEventHandler("main", "OnAfterEpilog", array("\\Bitrix\\Main\\Data\\ManagedCache", "finalize"));
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/usertype.php");

if(file_exists(($_fname = $_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/update_db_updater.php")))
{
	$US_HOST_PROCESS_MAIN = False;
	include($_fname);
}

if(file_exists(($_fname = $_SERVER["DOCUMENT_ROOT"]."/bitrix/init.php")))
	include_once($_fname);

if(($_fname = getLocalPath("php_interface/init.php", BX_PERSONAL_ROOT)) !== false)
	include_once($_SERVER["DOCUMENT_ROOT"].$_fname);

if(($_fname = getLocalPath("php_interface/".SITE_ID."/init.php", BX_PERSONAL_ROOT)) !== false)
	include_once($_SERVER["DOCUMENT_ROOT"].$_fname);

if(!defined("BX_FILE_PERMISSIONS"))
	define("BX_FILE_PERMISSIONS", 0644);
if(!defined("BX_DIR_PERMISSIONS"))
	define("BX_DIR_PERMISSIONS", 0755);

//global var, is used somewhere
$GLOBALS["sDocPath"] = $GLOBALS["APPLICATION"]->GetCurPage();

if((!(defined("STATISTIC_ONLY") && STATISTIC_ONLY && substr($GLOBALS["APPLICATION"]->GetCurPage(), 0, strlen(BX_ROOT."/admin/"))!=BX_ROOT."/admin/")) && COption::GetOptionString("main", "include_charset", "Y")=="Y" && strlen(LANG_CHARSET)>0)
	header("Content-Type: text/html; charset=".LANG_CHARSET);

if(COption::GetOptionString("main", "set_p3p_header", "Y")=="Y")
	header("P3P: policyref=\"/bitrix/p3p.xml\", CP=\"NON DSP COR CUR ADM DEV PSA PSD OUR UNR BUS UNI COM NAV INT DEM STA\"");

header("X-Powered-CMS: Bitrix Site Manager (".(LICENSE_KEY == "DEMO"? "DEMO" : md5("BITRIX".LICENSE_KEY."LICENCE")).")");
if (COption::GetOptionString("main", "update_devsrv", "") == "Y")
	header("X-DevSrv-CMS: Bitrix");

define("BX_CRONTAB_SUPPORT", defined("BX_CRONTAB"));

if(COption::GetOptionString("main", "check_agents", "Y")=="Y")
{
	define("START_EXEC_AGENTS_1", microtime());
	$GLOBALS["BX_STATE"] = "AG";
	$GLOBALS["DB"]->StartUsingMasterOnly();
	CAgent::CheckAgents();
	$GLOBALS["DB"]->StopUsingMasterOnly();
	define("START_EXEC_AGENTS_2", microtime());
	$GLOBALS["BX_STATE"] = "PB";
}

//session initialization
ini_set("session.cookie_httponly", "1");

if(($domain = \Bitrix\Main\Web\Cookie::getCookieDomain()) <> '')
{
	ini_set("session.cookie_domain", $domain);
}

if(COption::GetOptionString("security", "session", "N") === "Y"	&& CModule::IncludeModule("security"))
	CSecuritySession::Init();

session_start();

foreach (GetModuleEvents("main", "OnPageStart", true) as $arEvent)
	ExecuteModuleEventEx($arEvent);

//define global user object
$GLOBALS["USER"] = new CUser;

//session control from group policy
$arPolicy = $GLOBALS["USER"]->GetSecurityPolicy();
$currTime = time();
if(
	(
		//IP address changed
		$_SESSION['SESS_IP']
		&& strlen($arPolicy["SESSION_IP_MASK"])>0
		&& (
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($_SESSION['SESS_IP']))
			!=
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($_SERVER['REMOTE_ADDR']))
		)
	)
	||
	(
		//session timeout
		$arPolicy["SESSION_TIMEOUT"]>0
		&& $_SESSION['SESS_TIME']>0
		&& $currTime-$arPolicy["SESSION_TIMEOUT"]*60 > $_SESSION['SESS_TIME']
	)
	||
	(
		//session expander control
		isset($_SESSION["BX_SESSION_TERMINATE_TIME"])
		&& $_SESSION["BX_SESSION_TERMINATE_TIME"] > 0
		&& $currTime > $_SESSION["BX_SESSION_TERMINATE_TIME"]
	)
	||
	(
		//signed session
		isset($_SESSION["BX_SESSION_SIGN"])
		&& $_SESSION["BX_SESSION_SIGN"] <> bitrix_sess_sign()
	)
	||
	(
		//session manually expired, e.g. in $User->LoginHitByHash
		isSessionExpired()
	)
)
{
	$_SESSION = array();
	@session_destroy();

	//session_destroy cleans user sesssion handles in some PHP versions
	//see http://bugs.php.net/bug.php?id=32330 discussion
	if(COption::GetOptionString("security", "session", "N") === "Y"	&& CModule::IncludeModule("security"))
		CSecuritySession::Init();

	session_id(md5(uniqid(rand(), true)));
	session_start();
	$GLOBALS["USER"] = new CUser;
}
$_SESSION['SESS_IP'] = $_SERVER['REMOTE_ADDR'];
$_SESSION['SESS_TIME'] = time();
if(!isset($_SESSION["BX_SESSION_SIGN"]))
	$_SESSION["BX_SESSION_SIGN"] = bitrix_sess_sign();

//session control from security module
if(
	(COption::GetOptionString("main", "use_session_id_ttl", "N") == "Y")
	&& (COption::GetOptionInt("main", "session_id_ttl", 0) > 0)
	&& !defined("BX_SESSION_ID_CHANGE")
)
{
	if(!array_key_exists('SESS_ID_TIME', $_SESSION))
	{
		$_SESSION['SESS_ID_TIME'] = $_SESSION['SESS_TIME'];
	}
	elseif(($_SESSION['SESS_ID_TIME'] + COption::GetOptionInt("main", "session_id_ttl")) < $_SESSION['SESS_TIME'])
	{
		if(COption::GetOptionString("security", "session", "N") === "Y" && CModule::IncludeModule("security"))
		{
			CSecuritySession::UpdateSessID();
		}
		else
		{
			session_regenerate_id();
		}
		$_SESSION['SESS_ID_TIME'] = $_SESSION['SESS_TIME'];
	}
}

define("BX_STARTED", true);

if (isset($_SESSION['BX_ADMIN_LOAD_AUTH']))
{
	define('ADMIN_SECTION_LOAD_AUTH', 1);
	unset($_SESSION['BX_ADMIN_LOAD_AUTH']);
}

if(!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS!==true)
{
	$bLogout = isset($_REQUEST["logout"]) && (strtolower($_REQUEST["logout"]) == "yes");

	if($bLogout && $GLOBALS["USER"]->IsAuthorized())
	{
		$GLOBALS["USER"]->Logout();
		LocalRedirect($GLOBALS["APPLICATION"]->GetCurPageParam('', array('logout')));
	}

	// authorize by cookies
	if(!$GLOBALS["USER"]->IsAuthorized())
	{
		$GLOBALS["USER"]->LoginByCookies();
	}

	$arAuthResult = false;

	//http basic and digest authorization
	if(($httpAuth = $GLOBALS["USER"]->LoginByHttpAuth()) !== null)
	{
		$arAuthResult = $httpAuth;
		$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
	}

	//Authorize user from authorization html form
	if(isset($_REQUEST["AUTH_FORM"]) && $_REQUEST["AUTH_FORM"] <> '')
	{
		$bRsaError = false;
		if(COption::GetOptionString('main', 'use_encrypted_auth', 'N') == 'Y')
		{
			//possible encrypted user password
			$sec = new CRsaSecurity();
			if(($arKeys = $sec->LoadKeys()))
			{
				$sec->SetKeys($arKeys);
				$errno = $sec->AcceptFromForm(array('USER_PASSWORD', 'USER_CONFIRM_PASSWORD'));
				if($errno == CRsaSecurity::ERROR_SESS_CHECK)
					$arAuthResult = array("MESSAGE"=>GetMessage("main_include_decode_pass_sess"), "TYPE"=>"ERROR");
				elseif($errno < 0)
					$arAuthResult = array("MESSAGE"=>GetMessage("main_include_decode_pass_err", array("#ERRCODE#"=>$errno)), "TYPE"=>"ERROR");

				if($errno < 0)
					$bRsaError = true;
			}
		}

		if($bRsaError == false)
		{
			if(!defined("ADMIN_SECTION") || ADMIN_SECTION !== true)
				$USER_LID = SITE_ID;
			else
				$USER_LID = false;

			if($_REQUEST["TYPE"] == "AUTH")
			{
				$arAuthResult = $GLOBALS["USER"]->Login($_REQUEST["USER_LOGIN"], $_REQUEST["USER_PASSWORD"], $_REQUEST["USER_REMEMBER"]);
			}
			elseif($_REQUEST["TYPE"] == "OTP")
			{
				$arAuthResult = $GLOBALS["USER"]->LoginByOtp($_REQUEST["USER_OTP"], $_REQUEST["OTP_REMEMBER"], $_REQUEST["captcha_word"], $_REQUEST["captcha_sid"]);
			}
			elseif($_REQUEST["TYPE"] == "SEND_PWD")
			{
				$arAuthResult = CUser::SendPassword($_REQUEST["USER_LOGIN"], $_REQUEST["USER_EMAIL"], $USER_LID, $_REQUEST["captcha_word"], $_REQUEST["captcha_sid"], $_REQUEST["USER_PHONE_NUMBER"]);
			}
			elseif($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["TYPE"] == "CHANGE_PWD")
			{
				$arAuthResult = $GLOBALS["USER"]->ChangePassword($_REQUEST["USER_LOGIN"], $_REQUEST["USER_CHECKWORD"], $_REQUEST["USER_PASSWORD"], $_REQUEST["USER_CONFIRM_PASSWORD"], $USER_LID, $_REQUEST["captcha_word"], $_REQUEST["captcha_sid"], true, $_REQUEST["USER_PHONE_NUMBER"]);
			}
			elseif(COption::GetOptionString("main", "new_user_registration", "N") == "Y" && $_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["TYPE"] == "REGISTRATION" && (!defined("ADMIN_SECTION") || ADMIN_SECTION!==true))
			{
				$arAuthResult = $GLOBALS["USER"]->Register($_REQUEST["USER_LOGIN"], $_REQUEST["USER_NAME"], $_REQUEST["USER_LAST_NAME"], $_REQUEST["USER_PASSWORD"], $_REQUEST["USER_CONFIRM_PASSWORD"], $_REQUEST["USER_EMAIL"], $USER_LID, $_REQUEST["captcha_word"], $_REQUEST["captcha_sid"], false, $_REQUEST["USER_PHONE_NUMBER"]);
			}

			if($_REQUEST["TYPE"] == "AUTH" || $_REQUEST["TYPE"] == "OTP")
			{
				//special login form in the control panel
				if($arAuthResult === true && defined('ADMIN_SECTION') && ADMIN_SECTION === true)
				{
					//store cookies for next hit (see CMain::GetSpreadCookieHTML())
					$GLOBALS["APPLICATION"]->StoreCookies();
					$_SESSION['BX_ADMIN_LOAD_AUTH'] = true;

					//logout or re-authorize the user if something importand has changed
					$GLOBALS["USER"]->CheckAuthActions();

					CMain::FinalActions('<script type="text/javascript">window.onload=function(){top.BX.AUTHAGENT.setAuthResult(false);};</script>');
					die();
				}
			}
		}
		$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
	}
	elseif(!$GLOBALS["USER"]->IsAuthorized())
	{
		//Authorize by unique URL
		$GLOBALS["USER"]->LoginHitByHash();
	}
}

//logout or re-authorize the user if something importand has changed
$GLOBALS["USER"]->CheckAuthActions();

//magic short URI
if(defined("BX_CHECK_SHORT_URI") && BX_CHECK_SHORT_URI && CBXShortUri::CheckUri())
{
	//local redirect inside
	die();
}

//application password scope control
if(($applicationID = $GLOBALS["USER"]->GetParam("APPLICATION_ID")) !== null)
{
	$appManager = \Bitrix\Main\Authentication\ApplicationManager::getInstance();
	if($appManager->checkScope($applicationID) !== true)
	{
		$event = new \Bitrix\Main\Event("main", "onApplicationScopeError", Array('APPLICATION_ID' => $applicationID));
		$event->send();

		CHTTP::SetStatus("403 Forbidden");
		die();
	}
}

//define the site template
if(!defined("ADMIN_SECTION") || ADMIN_SECTION !== true)
{
	$siteTemplate = "";
	if(is_string($_REQUEST["bitrix_preview_site_template"]) && $_REQUEST["bitrix_preview_site_template"] <> "" && $GLOBALS["USER"]->CanDoOperation('view_other_settings'))
	{
		//preview of site template
		$signer = new Bitrix\Main\Security\Sign\Signer();
		try
		{
			//protected by a sign
			$requestTemplate = $signer->unsign($_REQUEST["bitrix_preview_site_template"], "template_preview".bitrix_sessid());

			$aTemplates = CSiteTemplate::GetByID($requestTemplate);
			if($template = $aTemplates->Fetch())
			{
				$siteTemplate = $template["ID"];

				//preview of unsaved template
				if(isset($_GET['bx_template_preview_mode']) && $_GET['bx_template_preview_mode'] == 'Y' && $GLOBALS["USER"]->CanDoOperation('edit_other_settings'))
				{
					define("SITE_TEMPLATE_PREVIEW_MODE", true);
				}
			}
		}
		catch(\Bitrix\Main\Security\Sign\BadSignatureException $e)
		{
		}
	}
	if($siteTemplate == "")
	{
		$siteTemplate = CSite::GetCurTemplate();
	}
	define("SITE_TEMPLATE_ID", $siteTemplate);
	define("SITE_TEMPLATE_PATH", getLocalPath('templates/'.SITE_TEMPLATE_ID, BX_PERSONAL_ROOT));
}

//magic parameters: show page creation time
if(isset($_GET["show_page_exec_time"]))
{
	if($_GET["show_page_exec_time"]=="Y" || $_GET["show_page_exec_time"]=="N")
		$_SESSION["SESS_SHOW_TIME_EXEC"] = $_GET["show_page_exec_time"];
}

//magic parameters: show included file processing time
if(isset($_GET["show_include_exec_time"]))
{
	if($_GET["show_include_exec_time"]=="Y" || $_GET["show_include_exec_time"]=="N")
		$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"] = $_GET["show_include_exec_time"];
}

//magic parameters: show include areas
if(isset($_GET["bitrix_include_areas"]) && $_GET["bitrix_include_areas"] <> "")
	$GLOBALS["APPLICATION"]->SetShowIncludeAreas($_GET["bitrix_include_areas"]=="Y");

//magic sound
if($GLOBALS["USER"]->IsAuthorized())
{
	$cookie_prefix = COption::GetOptionString('main', 'cookie_name', 'BITRIX_SM');
	if(!isset($_COOKIE[$cookie_prefix.'_SOUND_LOGIN_PLAYED']))
		$GLOBALS["APPLICATION"]->set_cookie('SOUND_LOGIN_PLAYED', 'Y', 0);
}

//magic cache
\Bitrix\Main\Composite\Engine::shouldBeEnabled();

foreach(GetModuleEvents("main", "OnBeforeProlog", true) as $arEvent)
	ExecuteModuleEventEx($arEvent);

if((!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS!==true) && (!defined("NOT_CHECK_FILE_PERMISSIONS") || NOT_CHECK_FILE_PERMISSIONS!==true))
{
	$real_path = $request->getScriptFile();

	if(!$GLOBALS["USER"]->CanDoFileOperation('fm_view_file', array(SITE_ID, $real_path)) || (defined("NEED_AUTH") && NEED_AUTH && !$GLOBALS["USER"]->IsAuthorized()))
	{
		/** @noinspection PhpUndefinedVariableInspection */
		if($GLOBALS["USER"]->IsAuthorized() && $arAuthResult["MESSAGE"] == '')
			$arAuthResult = array("MESSAGE"=>GetMessage("ACCESS_DENIED").' '.GetMessage("ACCESS_DENIED_FILE", array("#FILE#"=>$real_path)), "TYPE"=>"ERROR");

		if(defined("ADMIN_SECTION") && ADMIN_SECTION==true)
		{
			if ($_REQUEST["mode"]=="list" || $_REQUEST["mode"]=="settings")
			{
				echo "<script>top.location='".$GLOBALS["APPLICATION"]->GetCurPage()."?".DeleteParam(array("mode"))."';</script>";
				die();
			}
			elseif ($_REQUEST["mode"]=="frame")
			{
				echo "<script type=\"text/javascript\">
					var w = (opener? opener.window:parent.window);
					w.location.href='".$GLOBALS["APPLICATION"]->GetCurPage()."?".DeleteParam(array("mode"))."';
				</script>";
				die();
			}
			elseif(defined("MOBILE_APP_ADMIN") && MOBILE_APP_ADMIN==true)
			{
				echo json_encode(Array("status"=>"failed"));
				die();
			}
		}

		/** @noinspection PhpUndefinedVariableInspection */
		$GLOBALS["APPLICATION"]->AuthForm($arAuthResult);
	}
}

/*ZDUyZmZOGE0ODJhMDE0NmRkOGUyZTVlOTI2NzM1ZWUzNjE5ZmI=*/$GLOBALS['____858689142']= array(base64_decode(''.'b'.'X'.'RfcmFuZA=='),base64_decode('Z'.'Xh'.'wb'.'G'.'9kZQ=='),base64_decode('cGF'.'j'.'aw='.'='),base64_decode(''.'bWQ1'),base64_decode('Y29uc3RhbnQ='),base64_decode('aGFz'.'a'.'F9o'.'bW'.'F'.'j'),base64_decode('c3RyY2'.'1w'),base64_decode(''.'aXNfb2'.'JqZWN0'),base64_decode('Y'.'2'.'Fsb'.'F'.'91c'.'2Vy'.'X2Z1bm'.'M='),base64_decode('Y2F'.'sbF91'.'c2Vy'.'X'.'2Z1bmM='),base64_decode('Y2FsbF91'.'c'.'2VyX2Z1bmM='),base64_decode('Y2Fs'.'bF91'.'c'.'2'.'VyX2Z1bmM='),base64_decode('Y2'.'FsbF91c2VyX'.'2Z'.'1bmM='));if(!function_exists(__NAMESPACE__.'\\___373456282')){function ___373456282($_830943286){static $_202835780= false; if($_202835780 == false) $_202835780=array(''.'REI=','U0'.'VMRUNU'.'IFZBT'.'FVFIE'.'Z'.'ST00gYl9'.'vcHRp'.'b24gV0hFUkUg'.'TkFNRT0nflB'.'B'.'UkFNX'.'01'.'BWF9VU0VS'.'Uyc'.'gQU5E'.'IE1'.'PRFVM'.'RV9JRD0nbWFpbicgQU'.'5E'.'IF'.'NJV'.'E'.'VfS'.'UQ'.'g'.'S'.'V'.'Mg'.'T'.'lVMT'.'A'.'==','VkFM'.'VUU=','Lg='.'=','SCo=','Yml0cml'.'4','T'.'ElDRU5TRV9LR'.'Vk=','c2hhMjU'.'2','V'.'VNFUg='.'=','V'.'VNFU'.'g==','VVNFUg'.'==','SXNBdXRob3JpemVk','VVNFUg==','SXN'.'BZG1pbg==','QVBQT'.'ElDQ'.'VRJT04=','UmV'.'zdGFyd'.'EJ1ZmZ'.'lc'.'g==',''.'TG9jYWx'.'S'.'ZWRpcmVjd'.'A'.'==','L2xpY'.'2Vuc2'.'Vfcm'.'V'.'zdHJpY3Rpb2'.'4ucGhw','XEJ'.'pdHJpeFxNYWluX'.'EN'.'vbmZpZ1x'.'PcHR'.'pb246OnN'.'ldA==','bWF'.'p'.'bg==','UEFSQ'.'U'.'1fT'.'UFYX1V'.'TRVJT');return base64_decode($_202835780[$_830943286]);}};if($GLOBALS['____858689142'][0](round(0+1), round(0+5+5+5+5)) == round(0+1.75+1.75+1.75+1.75)){ $_1715848848= $GLOBALS[___373456282(0)]->Query(___373456282(1), true); if($_817445542= $_1715848848->Fetch()){ $_36828703= $_817445542[___373456282(2)]; list($_495341242, $_1703497780)= $GLOBALS['____858689142'][1](___373456282(3), $_36828703); $_408295913= $GLOBALS['____858689142'][2](___373456282(4), $_495341242); $_481331531= ___373456282(5).$GLOBALS['____858689142'][3]($GLOBALS['____858689142'][4](___373456282(6))); $_619666360= $GLOBALS['____858689142'][5](___373456282(7), $_1703497780, $_481331531, true); if($GLOBALS['____858689142'][6]($_619666360, $_408295913) !== min(186,0,62)){ if(isset($GLOBALS[___373456282(8)]) && $GLOBALS['____858689142'][7]($GLOBALS[___373456282(9)]) && $GLOBALS['____858689142'][8](array($GLOBALS[___373456282(10)], ___373456282(11))) &&!$GLOBALS['____858689142'][9](array($GLOBALS[___373456282(12)], ___373456282(13)))){ $GLOBALS['____858689142'][10](array($GLOBALS[___373456282(14)], ___373456282(15))); $GLOBALS['____858689142'][11](___373456282(16), ___373456282(17), true);}}} else{ $GLOBALS['____858689142'][12](___373456282(18), ___373456282(19), ___373456282(20), round(0+4+4+4));}}/**/       //Do not remove this

if(isset($REDIRECT_STATUS) && $REDIRECT_STATUS==404)
{
	if(COption::GetOptionString("main", "header_200", "N")=="Y")
		CHTTP::SetStatus("200 OK");
}
