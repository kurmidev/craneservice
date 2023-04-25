<?php

namespace app\components;


class Constants
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const Admin = 1;

    const DOCUMENT_FOR_COMPANY = 1;
    const DOCUMENT_FOR_VEHICLE = 2;
    const DOCUMENT_FOR_CLIENT = 3;
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

    const CLIENT_KYC_DETAILS = [
        "gst"=>"GST",
        "pan"=>"PAN",
    ];

    const CLIENT_TYPE_VENDOR = 1;
    const CLIENT_TYPE_CUSTOMER = 2;
    const CLIENT_IS_COMPANY = 1;
    const CLIENT_IS_INDIVIDUAL = 2;
    const CLIENT_IS_LABEL = [
        self::CLIENT_IS_COMPANY=>"Company",
        self::CLIENT_IS_INDIVIDUAL=>"Individual"
    ];

    const LABEL_STATUS = [
        self::STATUS_INACTIVE => 'In Active',
        self::STATUS_ACTIVE => 'Active',
    ];
}
 