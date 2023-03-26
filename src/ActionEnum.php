<?php

namespace App;

enum ActionEnum: string
{
    case PLUS = 'plus';
    case MINUS = 'minus';
    case MULTIPLY = 'multiply';
    case DIVISION = 'division';
}
