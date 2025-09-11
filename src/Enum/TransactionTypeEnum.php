<?php

namespace App\Enum;

enum TransactionTypeEnum: string
{
    case SALE = 'Sale';
    case RENT = 'Rent';
    case EXCHANGE = 'Exchange';
    case LEASE = 'Lease';
    case SUBLEASE = 'Sublease';
}
