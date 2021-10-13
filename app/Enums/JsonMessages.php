<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class JsonMessages extends Enum
{
    CONST SUCCESS = "You successfully created a recipe!";
    CONST FAILED = "Ingredients has to has to be exact 100 together!";
}
