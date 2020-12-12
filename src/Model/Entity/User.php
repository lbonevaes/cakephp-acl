<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $group_id
 * @property int $plan_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Group $group
 * @property \App\Model\Entity\Plan $plan
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'password' => true,
        'group_id' => true,
        'plan_id' => true,
        'created' => true,
        'modified' => true,
        'group' => true,
        'plan' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    
    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }
    
    public function parentNode()
    {
        if(!$this->id){
            return null;
        }
        if(isset($this->groups_id)){
            $groupId = $this->groups_id;
        } else {
            $users = \Cake\ORM\TableRegistry::get('Access.Users');
            $user = $users->find('all', ['fields'=>['group_id']])
                    ->where(['id'=> $this->id])->first();
            $groupId = $user->group_id;
        }
        if(!$groupId){
            return null;
        }
        
        return ['Access.groupss'=>['id'=>$groupId]];
    }
}
