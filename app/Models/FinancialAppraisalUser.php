<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FinancialAppraisalUser extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'reservations_count',
        'reservation_type',
        'performance_result_1',
        'performance_result',
        'organization_result',
        'result',
        'duration_type'
    ];

    public const ANNUAL = 'annual';
    public const HAVE_RESERVATIONS = 'have reservations';
    public const NO_RESERVATIONS = 'no reservations';
    public const NO_OPINION = 'no opinion';

    public const QUARTER_ANNUAL = 'quarter annual';

    public static array $appraisal_types = [
        self::ANNUAL,
        self::QUARTER_ANNUAL
    ];

    public static array $review_types = [
        self::HAVE_RESERVATIONS,
        self::NO_RESERVATIONS,
        self::NO_OPINION
    ];


    public static function getAppraisalTypes(): array
    {
        return self::$appraisal_types;
    }

    public static function getReviewsTypes(): array
    {
        return self::$review_types;
    }
}
