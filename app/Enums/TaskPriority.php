<?php

namespace App\Enums;

enum TaskPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
        };
    }

    /**
     * color
     *
     * @return string
     */
    public function color(): string
    {
        return match ($this) {
            self::LOW => 'bg-green-500/50 text-green-500',
            self::MEDIUM => 'bg-yellow-500/50 text-yellow-500',
            self::HIGH => 'bg-red-500/50 text-red-500',
        };
    }

    public function checkPriority($priority): bool
    {
        return match ($this) {
            self::LOW => $priority === self::LOW,
            self::MEDIUM => $priority === self::MEDIUM,
            self::HIGH => $priority === self::HIGH,
        };
    }
}
