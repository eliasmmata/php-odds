<?php

use BesoccerOdds\Classes\DbPDO;
use BesoccerOdds\Helpers\Data\RoleUserDataHelper;
use BeSoccerSDK\Classes\Builder;
use BeSoccerSDK\Classes\Show;
use BeSoccerSDK\Models\Deep\EditorUserModel;

    $results = ['?r=1', '?r=2'];
    $uri = str_replace($results, '', $_SERVER['REQUEST_URI']);
    if (isset($_POST) && !empty($_POST) && $_POST['pass'] == md5($_POST['user'].date('Y-m'))) {        
        
        $pdo = new DbPDO('deep');
        $pdo->bind("email",$_POST['user']);
        $user = $pdo->query("SELECT id, nick, role, sub_role, active, email, main_image FROM editor_users WHERE email = :email");
        $user = $user[0];
        $roles = new RoleUserDataHelper();
        $user['roles'] = $user['role'];
        $user['role'] = $roles->getRoleUsers($user['role']);
        $user['sub_roles'] = $user['sub_role'];
        $user['sub_role'] = $roles->getSubRoleUsers($user['sub_role']);
        $rollesAcces = [1,4,5,9,10];  
        
        if (in_array($user['roles'],$rollesAcces)) {

            if (!isset($_COOKIE['oauthScrap']) && count($user) > 0) {
                setcookie('oauthScrap', json_encode($user), time() + (60 * 60 * 24));                
                header ('location: '.$uri.'');
                die;
            }                

            if (!isset($_COOKIE['oauthScrap']) && count($user) == 0) {

                header ('location: '.$uri.'?r=2');
                die;             
            }
        }else {

            header ('location: '.$uri.'?r=1');
        }    
    }elseif (isset($_POST) && !empty($_POST) && $_POST['pass'] != md5($_POST['user'].date('Y-m'))){
        header ('location: '.$uri.'?r=2');
        die; 
    } 
?>