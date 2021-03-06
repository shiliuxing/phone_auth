<?php 
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
require_once dirname(__FILE__) . '/lib/function.php';
require_once dirname(__FILE__) . '/lib/sms.class.php';
global $_G;

if (isset($_REQUEST['site_name'])) {
    $params = array (
        'vid' => get_request('id'),
        'key' => get_request('key'),
        'site_name' => get_request('site_name', $_G['setting']['bbname']),
        'style_color' => get_request('style_color', '3c8aff'),
        'btn_style' => get_request('btn_style', 'dark'),
        'enable_inter' => get_request('enable_inter', '0'), //open international sms
        'register_email' => get_request('register_email', '0'),
        'qq_login' => get_request('qq_login', '0'), //open international sms
        'wechat_login' => get_request('wechat_login', '0'),
        'qq_login_url' => get_request('qq_login_url', get_site_url().'/connect.php?mod=login&op=init&referer=forum.php&statfrom=login_simple'),
        'wechat_login_url' => get_request('wechat_login_url', get_site_url().'/plugin.php?id=wechat:login')
    );
    C::t('common_setting')->update_batch(array("phone_auth_setting"=>$params));
    updatecache('setting');
    $landurl = 'action=plugins&operation=config&do='.$pluginid.'&identifier=phone_auth&pmod=v_setting';
	cpmsg('plugins_edit_succeed', $landurl, 'succeed');
}

$params = get_params();
$params['site_url'] = characet($params['site_url'], CHARSET, 'utf-8');
$static_path  = rtrim($_G['siteurl'], '/').'/source/plugin/phone_auth/static';
$site_url = get_site_url();
include template('phone_auth:v_setting');
?>
