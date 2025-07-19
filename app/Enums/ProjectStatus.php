<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    /**
     * label
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
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
            self::PENDING => 'bg-yellow-500',
            self::IN_PROGRESS => 'bg-blue-500',
            self::COMPLETED => 'bg-green-500',
            self::CANCELLED => 'bg-red-500',
        };
    }

    public function checkStatus($status): bool
    {
        return match ($this) {
            self::PENDING => $status === self::PENDING,
            self::IN_PROGRESS => $status === self::IN_PROGRESS,
            self::COMPLETED => $status === self::COMPLETED,
            self::CANCELLED => $status === self::CANCELLED,
        };
    }
}
