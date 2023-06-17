<?php

namespace app\components;


class Constants
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const STATUS_DELETED = -1;

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
    const PACKAGE_WISE_CHALLAN = 1;
    const PACKAGE_WISE_DAY = 2;
    const PACKAGE_WISE_TRIP = 3;
    const PACKAGE_WISE_DESTINATION = 4;
    const PACKAGE_WISE_MONTH = 5;
    const PACKAGE_WISE_SHIFT = 6;
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

    const INVOICE_TYPE_PERFORMA = 1;
    const INVOICE_TYPE_GST = 2;
    const CLIENT_IS_LABEL = [
        self::CLIENT_IS_COMPANY => "Company",
        self::CLIENT_IS_INDIVIDUAL => "Individual"
    ];

    const LABEL_STATUS = [
        self::STATUS_INACTIVE => 'In Active',
        self::STATUS_ACTIVE => 'Active',
    ];

    const LABEL_YESNO = [
        self::STATUS_INACTIVE => 'No',
        self::STATUS_ACTIVE => 'Yes',
    ];

    const DAYWISE_LABEL = [
        self::DAYWISE_FULL_DAY => "Full Day",
        self::DAYWISE_HALF_DAY => "Half Day"
    ];

    const PACKAGE_SHIFT_TYPE = [
        self::PACKAGE_SHIFT_TYPE_SHIFT => "Shift",
        self::PACKAGE_SHIFT_TYPE_HOURS => "Hour"
    ];

    const INVOICE_TYPE_LIST = [
        self::INVOICE_TYPE_GST => "GST",
        self::INVOICE_TYPE_PERFORMA => "Performa"
    ];

    const IS_YES_NO = [
        0 => "No",
        1 => "Yes"
    ];


    const PAYMENT_MODE_CASH = 1;
    const PAYMENT_MODE_CHEQUE = 2;
    const PAYMENT_MODE_ONLINE = 3;
    const PAYMENT_MODE_CREDIT = 4;
    const PAYMENT_MODE_OTHER = 5;

    const PAYMENT_STATUS_NOT_PAID = 0;
    const PAYMENT_STATUS_HALF_PAID = 1;
    const PAYMENT_STAUS_FULLY_PAID = 2;
    const QUOTATION_TYPE_MAIN = 1;
    const QUOTATION_TYPE_ADDONS = 2;
    const PAYMENT_MODE_LIST= [
        self::PAYMENT_MODE_CASH => "CASH",
        self::PAYMENT_MODE_CHEQUE => "Cheque",
        self::PAYMENT_MODE_OTHER => "Other"
    ];

    const EXPENSE_TYPE_WITH_INVENTORY = 1;
    const EXPENSE_TYPE_WITHOUT_INVENTORY = 2;

    const EXPENSE_TYPE_LIST = [
        self::EXPENSE_TYPE_WITH_INVENTORY=>"With Inventory",
        self::EXPENSE_TYPE_WITHOUT_INVENTORY=>"Without Inventory"
    ];

    const EXPENSE_TYPE_NORMAL = 1;
    const EXPENSE_TYPE_STAFF = 2;
    const CHALLAN_PAID =1;
    const CHALLAN_UNPAID = 2;

    const CHALLAN_STATUS = [
        self::CHALLAN_UNPAID => "Pending",
        self::CHALLAN_PAID => "Invoice Generated"
    ];

    const INVOICE_PENDING = 1;
    const INVOICE_PAID = 2;
    const INVOICE_CANCEL = -1;
    
    const INVOICE_STATUS = [
        self::INVOICE_PENDING => "Pending",
        self::INVOICE_PAID => "Paid",
        self::INVOICE_CANCEL => "Cancel",
    ];

    const DEFAUL_TERMS_CONDITION = "1. Gst tax18% as per government rule will be added.
    2. Payment terms charges &monthly billing payment will be done within 10 days of bill
    submission of monthly bill.
    3. Shift- the given quotation is for 10 hrs shift (including lunch )in a single strength & 26 shifts for a month.
    4. Reaching time will be extra 30 min";


    const PAYMENT_IR_RESPECTIVE_INVOICE = 1;
    const PAYMENT_INVOICEWISE = 2;

    const PREFIX_GST = 1;
    const PREFIX_PERFORMA = 2;

    const PREFIX_LIST = [
        self::PREFIX_GST => "GST",
        self::PREFIX_PERFORMA => "PERFORMA"
    ];

    public static function getTimeList()
    {
        $resp = [];
        for ($i = 1; $i < 180; $i++) {
            $resp[$i] = ($i<60)? "{$i} minutes": round(($i/60),0).":".($i%60)." hrs" ;
        }
        return $resp;
    }
}
