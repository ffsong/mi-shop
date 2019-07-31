<?php

namespace App\Policies;

use App\User;
use App\UserAddress;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class UserAddressPolicy
{
    use HandlesAuthorization;

//    //策略自动发现
//    public function boot()
//    {
//        $this->registerPolicies();
//
//        // 使用 Gate::guessPolicyNamesUsing 方法来自定义策略文件的寻找逻辑
//        Gate::guessPolicyNamesUsing(function ($class) {
//            // class_basename 是 Laravel 提供的一个辅助函数，可以获取类的简短名称
//            // 例如传入 \App\User 会返回 User
//            return '\\App\\Policies\\'.class_basename($class).'Policy';
//        });
//    }

    public function own(User $user, UserAddress $address)
    {
        return $address->user_id == $user->id;
    }
}
