<?php

namespace App\Http\Enum;

abstract class LogEnum
{
   const LOGIN = 'login';
   const CREATED = 'created';
   const UPDATED = 'updated';
   const DELETED = 'deleted';
   const RESTORE = 'restore';
}