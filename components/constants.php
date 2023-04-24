<?php

namespace app\components;


class Constants
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const Admin = 1;

    const DOCUMENT_FOR_COMPANY = 1;
    const DOCUMENT_FOR_VEHICLE = 2;
    const PACKAGE_TAX = [
        "0"=>"0%",
        "5"=>"5%",
        "12"=>"12%",
        "18"=>"18%"
    ];
    const PACKAGE_WISE = [
        "1"=>"Challan Wise",
        "2"=> "Day Wise",
        "3"=>"Trip wise",
        "4"=>"Destination Wise",
        "5"=>"Month wise",
        "6"=>"Shift wise"
    ];

    const KYC_DETAILS = [
        "gst"=>"GST",
        "pan"=>"PAN",
        "cin"=>"CIN",
        "tan"=>"TAN",
        "reg"=>"reg",
        "others"=>"others"
    ];
    const LABEL_STATUS = [
        self::STATUS_INACTIVE => 'In Active',
        self::STATUS_ACTIVE => 'Active',
    ];
}
 