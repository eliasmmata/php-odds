<?php
/**
 * Helper con todas las funciones de extración de código fuente para parse Tv
 * @author Pablo Muñoz
 */

namespace BesoccerOdds\Helpers\Data;

use BesoccerOdds\Classes\Helper;

class RoleUserDataHelper extends Helper{	   
    
    /**
	 * Array role de los usuarios de deep
	 * @author Pablo Muñoz
     * @lastedit 10/11/2022 - Pablo Muñoz
     * @param int $role 
	 * @return string 
	 */
    public static function getRoleUsers($role) :string
    {
        $roles = [
            '1'=>'Datos',
            '2'=>'Periodistas',
            '3'=>'Marketing',
            '4'=>'Desarrollo',
            '5'=>'Besoccer Pro Admin',
            '6'=>'Diseño',
            '7'=>'SEO',
            '8'=>'Besoccer Pro Editor',
            '9'=>'Sistemas',
            '10'=>'SuperAdmin',
            '11'=>'Negocio',
            '12'=>'Academy',
            '13'=>'RRHH',
            '14'=>'Restauración',
            '15'=>'Colaborador',
            '16'=>'Fotógrafo',
            '17'=>'Cocina',
        ];

       return $roles[$role];
    } 
    
    /**
	 * Array subroles de los usuarios de deep
	 * @author Pablo Muñoz
     * @lastedit 11/11/2022 - Pablo Muñoz
     * @param int $subrole 
	 * @return string 
	 */
    public static function getSubRoleUsers($subRole) :string
    {
        $subRoles = [
            '1'=>'Empleado',
            '2'=>'Encargado',
            '3'=>'Supervisor',            
        ];

       return $subRoles[$subRole];
    }
    
}