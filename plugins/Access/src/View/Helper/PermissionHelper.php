<?php

namespace Access\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\Routing\Router;

/**
 * Permissions helper
 */
class PermissionHelper extends Helper {

    public function link($aro, $aco, $aros_acos) {
        $permission = $this->check($aro, $aco, $aros_acos);
        
        $action = 'deny';
        $class = 'default';
        $label = 'Permissão herdada';
        
        if($permission['check']) {
            $class = 'success';
            $label = 'Acesso permitido';
        }
        
        if($permission['check'] === false) {
            $action = 'grant';
            $class = 'danger';
            $label = 'Acesso bloqueado';
        }
        
        $url = Router::url('/access/permissions/'.$action.'/'.$aro->id.'/'.$aco->id, true);
        $url_inherit = Router::url('/access/permissions/delete/'.$permission['id'], true);
        
        $html = '<a href="'.$url.'" class="btn btn-xs btn-'.$class.'">'.$label.'</a>';
        $html .= '<a href="'.$url_inherit.'" class="btn btn-xs btn-default">Herdar</a>';
        
        return $html;
    }

    protected function check($aro, $aco, $aros_acos) {
        foreach($aros_acos as $permission){
            if($permission->aco_id == $aco->id and $permission->aro_id == $aro->id ){
                return [
                    'check'=>$permission->_read == 1,
                    'id'=>$permission->id,
                ];
            }
        }
        return null;
    }
}
