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
        "0" => "0%",
        "5" => "5%",
        "12" => "12%",
        "18" => "18%"
    ];
    CONST PACKAGE_WISE_CHALLAN = 1;
    CONST PACKAGE_WISE_DAY = 2;
    CONST PACKAGE_WISE_TRIP = 3;
    CONST PACKAGE_WISE_DESTINATION = 4;
    CONST PACKAGE_WISE_MONTH = 5;
    CONST PACKAGE_WISE_SHIFT = 6;
    const PACKAGE_WISE = [
        self::PACKAGE_WISE_CHALLAN => "Challan Wise",
        self::PACKAGE_WISE_DAY => "Day Wise",
        self::PACKAGE_WISE_TRIP => "Trip wise",
        self::PACKAGE_WISE_DESTINATION => "Destination Wise",
        self::PACKAGE_WISE_MONTH => "Month wise",
        self::PACKAGE_WISE_SHIFT => "Shift wise"
    ];


    const KYC_DETAILS = [
        "gst" => "GST",
        "pan" => "PAN",
        "cin" => "CIN",
        "tan" => "TAN",
        "reg" => "reg",
        "others" => "others"
    ];

    const CLIENT_KYC_DETAILS = [
        "gst" => "GST",
        "pan" => "PAN",
    ];

    const CLIENT_TYPE_VENDOR = 1;
    const CLIENT_TYPE_CUSTOMER = 2;
    const CLIENT_IS_COMPANY = 1;
    const CLIENT_IS_INDIVIDUAL = 2;

    const DAYWISE_FULL_DAY = 1;
    const DAYWISE_HALF_DAY = 2;

    const PACKAGE_SHIFT_TYPE_SHIFT = 1;
    const PACKAGE_SHIFT_TYPE_HOURS = 2;

    const CLIENT_IS_LABEL = [
        self::CLIENT_IS_COMPANY => "Company",
        self::CLIENT_IS_INDIVIDUAL => "Individual"
    ];

    const LABEL_STATUS = [
        self::STATUS_INACTIVE => 'In Active',
        self::STATUS_ACTIVE => 'Active',
    ];

    const DAYWISE_LABEL = [
        self::DAYWISE_FULL_DAY => "Full Day",
        self::DAYWISE_HALF_DAY => "Half Day"
    ];

    const PACKAGE_SHIFT_TYPE = [
        self::PACKAGE_SHIFT_TYPE_SHIFT => "Shift",
        self::PACKAGE_SHIFT_TYPE_HOURS => "Hour"
    ];

    public static function getTimeList(){
        $resp = [];
        for($i=1;$i<61;$i++){
            $resp[$i] = "{$i} minutes";
        }
        return $resp;
    }
}
