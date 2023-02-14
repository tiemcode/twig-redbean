<?php

class BaseController
{
    public function getBeanById($typeOfBean, $queryStringKey)
    {
        $bean = R::findOne($typeOfBean, ' id LIKE ? ', [$queryStringKey]);
        return $bean;
    }
}
