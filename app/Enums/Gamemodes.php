<?php

namespace App\Enums;

enum Gamemodes: int
{
    case Solo = 0;
    case Public = 1;
    case Survival = 2;

    /**
     * Retrieve static nicename for case
     * @return string
     */
    public static function getDisplayName(int $value): ?string
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
            self::Solo => __('gamemode.solo'),
            self::Public => __('gamemode.public'),
            self::Survival => __('gamemode.survival'),
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
