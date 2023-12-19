<?php

define('BENCHMARK', '1');


// Proyect Folders
define('VIEWS_FOLDER','../views');
define('MEDIA_FOLDER','../media');
define('PROXY_FOLDER','../config/proxies');

// Folders html
define('MEDIA_ROOT', '/media/img/');
define('MEDIA_CSS', '/media/css/');
define('MEDIA_JS', '/media/js/');
define('FONT_ICONS', '/media/css/');

// Python Constants
define('PY_DEV', 0);  // (1) Activa o (0) desactiva el modo desarrollador
define('PY_URL_PROD', 'http://py.besoccer.com/');
define('PY_URL_TEST', 'http://pytest.besoccer.com/');

if(PY_DEV){
    define('PY_URL', PY_URL_TEST);
}else{
    define('PY_URL', PY_URL_PROD);
} 
// DB Names in project
define('FUTBOL', 'futbol');
define('BIGDATA', 'bigdata');
define('BETS', 'bets');
define('ELO', 'elo');

// DB Tables
define('CATEGORIES', FUTBOL.'.categories');
define('LEAGUES', FUTBOL.'.leagues');
define('DATATEAMS', FUTBOL.'.datateams');
define('CALENDARS', FUTBOL.'.calendars');

define('INDEX_FD', BIGDATA.'.index_fd');
define('INDEX_GS', BIGDATA.'.index_gs');
define('PROVIDERS_RF', BIGDATA.'.providers_rf');
define('PROVIDERS_EP', BIGDATA.'.providers_ep');
define('PROVIDERS_GS', BIGDATA.'.providers_gs');
define('PROVIDERS_ODDS', BIGDATA.'.providers_odds');
define('DATATEAMS_FD', BIGDATA.'.datateams_fd');
define('DATATEAMS_GS', BIGDATA.'.datateams_gs');
define('CALENDARS_ODDS', BIGDATA.'.calendars_odds');
define('ODDS', BIGDATA.'.odds');
define('ERRORS', BIGDATA.'.errors_gs');
define('TIMESTAMP_GS', BIGDATA.'.timestamp_gs');
define('TIMESTAMP_EP', BIGDATA.'.timestamp_ep');

define('BS_INDEX', BETS.'.bs_index');
define('BS_REL_TEAMS', BETS.'.bs_rel_teams');
define('BS_NO_REL_CALENDARS', BETS.'.bs_no_rel_calendars');
define('EVENT', BETS.'.event');

define('ODDS_MATCH_WINNER', ELO.'.odds_match_winner');
define('ODDS_MATCH_2NDHALF', ELO.'.odds_2nd_half_winner');
define('ODDS_HOME_AWAY', ELO.'.odds_home_away');
define('ASIAN_HANDICAP', ELO.'.odds_asian_handicap');
define('DOUBLE_CHANCE', ELO.'.odds_double_chance');
define('GOALS_OVER_UNDER', ELO.'.odds_goals_over_under');
define('OVER_UNDER_FIRST', ELO.'.odds_goals_over_under_1st_half');
define('OVER_UNDER_SECOND', ELO.'.odds_goals_over_under_2nd_half');
define('CLEAN_SHEET_HOME', ELO.'.odds_clean_sheet_home');
define('CLEAN_SHEET_AWAY', ELO.'.odds_clean_sheet_away');
define('CORRECT_SCORE', ELO.'.odds_correct_score');
define('CORRECT_SCORE_FIRST', ELO.'.odds_correct_score_1st_half');
define('CORRECT_SCORE_SECOND', ELO.'.odds_correct_score_2nd_half');

// SDK Info
$sdkInfo = json_decode(file_get_contents('../composer.json'), TRUE);
define('SDK_VERSION', $sdkInfo['require']['besoccer/sdk']);



?>