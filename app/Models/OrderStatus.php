<?php

namespace App\Models;

enum OrderStatus: string
{
    case PLACED = "placed";
    case PENDING = "pending";
    case PAID = "paid";
    case PACK = "pack";
    case DELIVERED = "delivered";
    case COMPLETED = "completed";
    case CANCELED = "canceled";
}
