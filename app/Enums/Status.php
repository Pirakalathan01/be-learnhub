<?php

namespace App\Enums;

enum Status: string
{
    const Requested = 'Requested';
    const Enrolled = 'Enrolled';
    const Cancelled = 'Cancelled';
    const Completed = 'Completed';
}
