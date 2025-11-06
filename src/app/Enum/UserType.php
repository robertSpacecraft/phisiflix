<?php

namespace App\Enum;

enum UserType
{
    case ADMIN;
    case EDITOR;
    case REGULAR;
    case ADVERTISING;

    public static function createFromString(string $type): UserType{
        return match(strtolower($type)){
            'admin'=>UserType::ADMIN,
            'editor'=>UserType::EDITOR,
            'regular'=>UserType::REGULAR,
            'advertising'=>UserType::ADVERTISING,
        };
    }
}
