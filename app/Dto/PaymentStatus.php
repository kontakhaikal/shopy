<?php

namespace App\Dto;

enum PaymentStatus: string
{
    case CHARGED = "charged";
    case PAID = "paid";
}
