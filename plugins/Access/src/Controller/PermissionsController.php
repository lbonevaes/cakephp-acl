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
        $this->loadModel('Acos');
        $this->loadModel('Aros');
        
        $aco = $this->Acos->get($aco);
        $aro = $this->Aros->get($aro);
        
        $aro = [
            'model'=>$aro->model,
            'foreign_key'=>$aro->foreign_key
        ];
        
        $this->Acl->allow($aro, $aco->id, '*');
        return $this->redirect(['action'=>'index', $aro['model'], $aro['foreign_key']]);
    }
    
    public function deny($aro, $aco){
        $this->loadModel('Acos');
        $this->loadModel('Aros');
        
        $aco = $this->Acos->get($aco);
        $aro = $this->Aros->get($aro);
        
        $aro = [
            'model'=>$aro->model,
            'foreign_key'=>$aro->foreign_key
        ];
        
        $this->Acl->deny($aro, $aco->id, '*');
        return $this->redirect(['action'=>'index', $aro['model'], $aro['foreign_key']]);
    }
    
    public function delete($id){
        $this->loadModel('Aros');
        $this->loadModel('ArosAcos');
        
        $permission = $this->ArosAcos->find()
                ->where([
                    'id'=>$id
                ])
                ->first();
        
        $this->ArosAcos->delete($permission);
        
        $aro = $this->Aros->get($permission->aro_id);
        
        return $this->redirect(['action'=>'index', $aro->model, $aro->foreign_key]);
    }
}