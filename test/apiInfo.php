<?php
include '../../../autoload.php';
use \DaTaoKe\Requests\BindSteategyClass;

/**
 * 获取接口信息（终端输出）
 */
function getApiInfo(){
    //获取所有接口信息
//    BindSteategyClass::GetAllSteategy();
    //获取指定接口信息
    BindSteategyClass::GetAllSteategy("活动商品");
}
getApiInfo();