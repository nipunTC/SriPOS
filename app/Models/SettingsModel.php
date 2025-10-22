<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'store_name',
        'store_email',
        'store_phone',
        'store_lanphone',
        'shop_registration_number',
        'store_address',
        'shop_logo',
        'currency_symbol',
        'currency_position',
        'tax_rate',
        'printer_type',
        'printer_ip',
        'printer_port',
        'updated_at'
    ];
}
