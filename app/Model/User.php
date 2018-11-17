<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'active', 'fullname',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // get all items
    public function getItem($id) {
        return $this->findOrFail($id);
    }
    // get all items
    public function getItems() {
        return $this->orderBy('id', 'DESC')->paginate(getenv('ADMIN_MYINFO'));
    }
    // add item
    public function addItem($arItem){
        try {
            DB::beginTransaction();
            $arGroups = $arItem['vgroup'];
            unset($arItem['vgroup']);

            DB::table('users')->insert($arItem);
            $uid = DB::getPdo()->lastInsertId();

            //chèn vào users_groups
            foreach ($arGroups as $gid) {
                if ($gid > 0) {
                    try{
                        DB::table('users_groups')->insert(['uId' => $uid, 'gId' => $gid]);
                    } catch (\Exception $e2) {  
                        print_r($e2->getMessage());
                        break;
                    }
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            print_r($e->getMessage()); 
            DB::rollback();
        }
        return false;
    }
    //edit item
    public function editItem($id, $arItem){
        try {
            DB::beginTransaction();

            $objItem = $this->findOrFail($id);
            $objItem->username = trim($arItem['username']);
            if (isset($arItem['password'])) {
                $objItem->password = trim($arItem['password']);
            }
            $objItem->fullname = trim($arItem['fullname']);
            $objItem->email = trim($arItem['email']);

            $arGroups = $arItem['vgroup'];
            unset($arItem['vgroup']);
            try{
                $result = $objItem->save();
            } catch (\Exception $e3) {  
                print_r($e3->getMessage());
                $result = false;
            }

            //xử lý bảng vusers_groups
            //xóa các record cũ
            DB::table('users_groups')->where(['uId' => $id])->delete();
            //tạo các record mới
            foreach ($arGroups as $gid) {
                if ($gid > 0) {
                    try{
                        DB::table('users_groups')->insert(['uId' => $id, 'gId' => $gid]);
                    } catch (\Exception $e2) {  
                        print_r($e2->getMessage());
                        break;
                    }
                }
            }

            DB::commit();
            return $result;
        } catch (\Exception $e) {
            print_r($e->getMessage()); 
            DB::rollback();
            die();
        }
        return false;
    }
    
    //delete item
    public function delItem($id){
        try {
            $objItem = $this->findOrFail($id);
            $uid = $objItem->id;

            $objItem->delete();
            //xoa tai bang users_groups
            DB::table('users_groups')->where('uId', $uid)->delete();
            return true;
        } catch (\Exception $e) {
            print_r($e->getMessage()); 
        }
        return false;
    }
    //edit profile
    public function editProfile($id, $arItem){
        try {
            DB::beginTransaction();

            $objItem = $this->findOrFail($id);

            $objItem->fullname = trim($arItem['fullname']);

            try{
                $result = $objItem->save();
            } catch (\Exception $e3) {  
                print_r($e3->getMessage());
                $result = false;
            }

            DB::commit();
            return $result;
        } catch (\Exception $e) {
            print_r($e->getMessage()); 
            DB::rollback();
            die();
        }
        return false;

            
    }
     //
    public function getItemPl($id) {
        try{
            return $this->select('fullname','avatar','slogan')->findOrFail($id)->toArray();
        }catch(\Exception $e) {
            print_r($e->getMessage()); 
            DB::rollback();
        }
        return null;
    }
}
