<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const TYPE_EXPENSE = 0;
    const TYPE_INCOME = 1;

    public static array $types = [
        self::TYPE_EXPENSE => 'Expense',
        self::TYPE_INCOME  => 'Income',
    ];

    const CURRENCY_USD = 0;
    const CURRENCY_RUB = 1;
    const CURRENCY_UZS = 2;

    public static array $currencies = [
        self::CURRENCY_USD => 'USD',
        self::CURRENCY_RUB => 'RUB',
        self::CURRENCY_UZS => 'UZS',
    ];

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'type' => self::$types[$this->type],
            'currency' => self::$currencies[$this->currency],
            'typeValue' => $this->type,
            'currencyValue' => $this->currency,
        ]);
    }
}
