<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Constants\TablesNameConstant;

class PasswordReset extends Model
{
    protected $table = TablesNameConstant::PASSWORD_RESETS;
}
