<?php
function route_class(){
    //把路由名称中的 . 替换为 -
    return str_replace('.', '-', Route::currentRouteName());
}
