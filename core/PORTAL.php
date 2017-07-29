<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/5/2016
 * Time: 12:15 PM
 */
class PORTAL
{
    protected $currencyCode;
    public function __construct()
    {

        $this->currencyCode = strtolower(findCurrency());
    }
}