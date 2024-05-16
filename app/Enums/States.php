<?php

namespace App\Enums;

enum States: int
{
    case Draft = 0;
    case UnderReview = 1;
    case FailedReview = 2;
    case Ready = 3;
    case Used = 4;

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
            self::Draft => __('state.draft'),
            self::UnderReview => __('state.waiting'),
            self::FailedReview => __('state.failed'),
            self::Ready => __('state.ready'),
            self::Used => __('state.used'),
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
