<?php

namespace App\Enums;

enum QuestionFormat: int
{
    case AlphaNumeric = 'open';
    case Numeric = 'nums';
    case MultipleChoice = 'qcms';
    // case Drawing = 'draw';

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
            self::AlphaNumeric => __('format.open'),
            self::Numeric => __('format.nums'),
            self::MultipleChoice => __('format.qcms'),
            // self::Drawing => __('format.draw'),
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
