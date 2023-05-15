<?php

namespace app\components;

use app\components\Constants as C;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class MenuHelper
{

    public static $menu = [
        "dashboard" => [
            "config" => ["class" => "nav-icon fas fa-home"],
            "items" => [
                'customer_dashboard' => [
                    ['module' => '', 'controller' => 'site', 'action' => 'index', 'label' => 'Customer Dashboard', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                ],
                'vendor_dashboard' => [
                    ['module' => '', 'controller' => 'site', 'action' => 'index', 'label' => 'Vendor Dashboard', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                ]
            ]
        ],
        "customer" => [
            "config" => ["class" => "nav-icon fas fa-users"],
            "items" => [
                'customer' => [
                    ['module' => '', 'controller' => 'customer', 'action' => 'index', 'label' => 'Customer', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'customer', 'action' => 'add-customer', 'label' => 'Add Customer', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'customer', 'action' => 'edit-customer', 'label' => 'Edit Customer', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'customer', 'action' => 'view-customer', 'label' => 'Customer Details', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'customer', 'action' => 'add-challan', 'label' => 'Add Challan', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'customer', 'action' => 'add-site', 'label' => 'Add Site', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'customer', 'action' => 'edit-site', 'label' => 'Edit Site', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'customer', 'action' => 'print-challan', 'label' => 'Print Challan', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'customer', 'action' => 'add-invoice', 'label' => 'Add Invoice', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'customer', 'action' => 'print-invoice', 'label' => 'Print Invoice', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                ],
            ]
        ],
        "vendor" => [
            "config" => ["class" => "nav-icon fas fa-shopping-cart"],
            "items" => [
                'vendor' => [
                    ['module' => '', 'controller' => 'vendor', 'action' => 'index', 'label' => 'Vendor', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vendor', 'action' => 'add-vendor', 'label' => 'Add Vendor', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vendor', 'action' => 'edit-vendor', 'label' => 'Edit Vendor', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vendor', 'action' => 'view-vendor', 'label' => 'Customer Vendor', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vendor', 'action' => 'add-challan', 'label' => 'Add Challan', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vendor', 'action' => 'print-challan', 'label' => 'Print Challan', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vendor', 'action' => 'add-challan', 'label' => 'Add Challan', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vendor', 'action' => 'add-site', 'label' => 'Add Site', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vendor', 'action' => 'edit-site', 'label' => 'Edit Site', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vendor', 'action' => 'print-challan', 'label' => 'Print Challan', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vendor', 'action' => 'add-invoice', 'label' => 'Add Invoice', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vendor', 'action' => 'print-invoice', 'label' => 'Print Invoice', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                ]
            ]
        ],
        "configuration" => [
            "config" => ["class" => "nav-icon fas fa-wrench"],
            "items" => [
                'company' => [
                    ['module' => '', 'controller' => 'company', 'action' => 'company', 'label' => 'Company', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'company', 'action' => 'add-company', 'label' => 'Add Company', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'company', 'action' => 'edit-company', 'label' => 'Edit Company', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                ],
                'plan-attributes' => [
                    ['module' => '', 'controller' => 'plan', 'action' => 'plan-attributes', 'label' => 'Plan Attributes', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'plan', 'action' => 'add-plan-attributes', 'label' => 'Add Plan Attributes', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'plan', 'action' => 'edit-plan-attributes', 'label' => 'Edit Plan Attributes', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                ],
                'plan' => [
                    ['module' => '', 'controller' => 'plan', 'action' => 'plan', 'label' => 'Plan', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'plan', 'action' => 'add-plan', 'label' => 'Add Plan', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'plan', 'action' => 'edit-plan', 'label' => 'Edit Plan', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                ],
                'settings' => [
                    ['module' => '', 'controller' => 'settings', 'action' => 'settings-attribute', 'label' => 'settings Attributes', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'settings', 'action' => 'add-settings-attributes', 'label' => 'Add settings Attributes', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'settings', 'action' => 'edit-settings-attributes', 'label' => 'Edit settings Attributes', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                ],
                'vehicle' => [
                    ['module' => '', 'controller' => 'vehicle', 'action' => 'vehicle', 'label' => 'Vehicle', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vehicle', 'action' => 'add-vehicle', 'label' => 'Add Vehicle', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'vehicle', 'action' => 'edit-vehicle', 'label' => 'Edit Vehicle', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                ],
                'plugins' => [
                    ['module' => '', 'controller' => 'plugins', 'action' => 'plugins', 'label' => 'Plugins', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'plugins', 'action' => 'add-plugins', 'label' => 'Add Plugins', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'plugins', 'action' => 'edit-plugins', 'label' => 'Edit Plugins', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                ],
                'templates' => [
                    ['module' => '', 'controller' => 'templates', 'action' => 'templates', 'label' => 'Templates', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'templates', 'action' => 'add-templates', 'label' => 'Add Templates', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'templates', 'action' => 'edit-templates', 'label' => 'Edit Templates', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                ],
                'city' => [
                    ['module' => '', 'controller' => 'location', 'action' => 'city', 'label' => 'City', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                 //   ['module' => '', 'controller' => 'location', 'action' => 'add-city', 'label' => 'Add City', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                 //   ['module' => '', 'controller' => 'location', 'action' => 'edit-city', 'label' => 'Edit City', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                ],
            ]
        ],
        "employee" => [
            "config" => ["class" => "nav-icon fas fa-user-circle"],
            "items" => [
                'employee' => [
                    ['module' => '', 'controller' => 'employee', 'action' => 'employee', 'label' => 'Employee', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'employee', 'action' => 'add-employee', 'label' => 'Add Employee', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'employee', 'action' => 'edit-employee', 'label' => 'Edit Employee', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                ],
                'department' => [
                    ['module' => '', 'controller' => 'employee', 'action' => 'department', 'label' => 'Department', 'is_menu' => true, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'employee', 'action' => 'add-department', 'label' => 'Add Department', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                    ['module' => '', 'controller' => 'employee', 'action' => 'edit-department', 'label' => 'Edit Department', 'is_menu' => false, 'icon' => "icon icon ion-ios-photos-outline"],
                ],
            ]
        ],
        "reports" => []
    ];


    public static function getDisplayMenu($menu = [], $is_submenu = false) {
        $menu = empty($menu) ? self::$menu : $menu;
        $result = [];
        foreach ($menu as $key => $mvalues) {
            $menuItems = empty($mvalues['items']) ? $mvalues : $mvalues['items'];
            $menuConfig = empty($mvalues['config']) ? [] : $mvalues['config'];
            $is_submenu = count($menuItems) > 1 ? true : false;
            if (\yii\helpers\ArrayHelper::isAssociative($menuItems)) {
                foreach ($menuItems as $k => $m) {
                    if ($is_submenu) {
                        $label = self::styleMenuLabel($key, $menuConfig);
                        $result[$key] = [
                            'url' => "#",
                            'label' => $label,
                            'options' => ['class' => 'nav-item'],
                            'items' => array_values(self::getDisplayMenu($menuItems)),
                            'submenuTemplate' => "\n<ul class='nav nav-treeview'>\n{items}\n</ul>\n",
                            "template"=> '<a href="{url}" class="nav-link"><i class="nav-icon fas '.$mvalues['config']['class'].'"></i><p>{label}<i class="right fas fa-angle-left"></i> </p></a>'
                        ];
                    } else {
                        $mv = current($m);
                        $label = self::styleMenuLabel($mv['label'], $menuConfig);
                        $result[$k] = [
                            'url' => \Yii::$app->urlManager->createUrl(implode("/", [$mv['module'], $mv['controller'], $mv['action']])),
                            'label' => $label,
                            'options' => ['class' => 'nav-item'],
                            "template"=> '<a href="{url}" class="nav-link"><i class="'.$mvalues['config']['class'].'"></i><p>{label}</p></a>'
                        ];
                    }
                }
            } else {
                foreach ($menuItems as $k => $mv) {
                    if ($mv['is_menu']) {
                        $result[$key] = [
                            'url' => \Yii::$app->urlManager->createUrl(implode("/", [$mv['module'], $mv['controller'], $mv['action']])),
                            'label' => $mv['label'],
                            "template"=> '<a href="{url}" class="nav-link"><i class="fa fa-angle-double-right nav-icon"></i><p>{label}</p></a>',
                            'options' => ['class' => "nav-item "],
                        ];
                    }
                }
            }
        }
        return $result;
    }

    public static function styleMenuLabel($label, $menuConfig = []) {
        $text = ucwords(implode(' ', preg_split('/(?=[A-Z])/', $label)));
        // $label = "";
        // if (!empty($menuConfig)) {
        //     $label .= Html::tag("i", "", ["class" => $menuConfig['class']]);
        // }
        // $label .= Html::tag('p', $text);
        return $text;
    }

    public static function getDisplayTitle($menu = []) {
        $menu = empty($menu) ? self::$menu : $menu;
        $menuItem = !empty($menu['items']) ? $menu['items'] : $menu;
        $title = [];
        $st = [];
        foreach ($menuItem as $k => $m) {
            if (ArrayHelper::isAssociative($m)) {
                $st = self::getDisplayTitle($m);
            } else {
                foreach ($m as $sk => $sm) {
                    extract($sm);
                    $st[$controller][$action] = ['title' => $label, 'icon' => $icon];
                }
            }
            $title = ArrayHelper::merge($title, $st);
        }
        return $title;
    }

    public static function renderMenu() {
        return MenuHelper::getDisplayMenu();
    }

    public static function renderPageTitle($c = "", $a = "") {
        $titleList = \Yii::$app->cache->getOrSet('titles', function () {
            return MenuHelper::getDisplayTitle();
        });
        return !empty($titleList[$c][$a]) ? $titleList[$c][$a] : SITE_NAME;
    }

}


