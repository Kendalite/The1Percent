<?php

namespace App\Enums;

enum UserRoles: string
{
    case User = 'player';
    case Writer = 'writer';
    case Referee = 'referee';
    case Host = 'host';
    case Admin = 'admin';

    /**
     * Retrieve static nicename for case
     * @return string
     */
    public static function getDisplayName(string $value): ?string
    {
        return self::tryFrom($value)?->displayName();
    }

    /**
     * Retrieve nicename for case
     * @return string
     */
    public function displayName(): string
    {
        return match($this) {
            self::User => __('roles.user'),
            self::Writer => __('roles.writer'),
            self::Referee => __('roles.referee'),
            self::Host => __('roles.host'),
            self::Admin => __('roles.admin'),
        };
    }

    /**
     * Retourne un tableau d'option pour l'utilisation dans un select
     * @return array
     */
    public static function optionsArray():array
    {
        return collect(self::cases())->mapWithKeys(function(UserRoles $item, $key) {
            return [$item->value => $item->getDisplayName($item->value)];
        })->toArray();
    }
}
