<?php

namespace Access\Controller;

use Access\Controller\AppController;

class PermissionsController extends AppController{
    
    public function index($model, $foreign_key){
        $this->loadModel('Acos');
        $this->loadModel('Aros');
        $this->loadModel('Permissions');
        $acos_list = $this->Acos->find('treeList',
                [
                    'keyPath'=>'id',
                    'valuePath'=>'alias',
                    'spacer'=>'- '
                ]
            )->all()->toArray();
        
        $acos = $this->Acos->find()
                ->all();
        
        $aro = $this->Aros->find()
                ->where(compact('model', 'foreign_key'))
                ->first();
        
        $aros_acos = $this->Permissions->find()
                ->where(['aro_id'=>$aro->id])
                ->all();
        
        $this->set(compact('acos_list', 'acos', 'aro', 'aros_acos'));
    }
    
    public function grant($aro, $aco){
        
    }
    
    public function deny($aro, $aco){
        
    }
    
    public function delete($id){
        
    }
}