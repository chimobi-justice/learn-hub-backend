<?php

namespace App\Http\Resources;

use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *  title="DateTimeResource",
 *  description="format date time",
 *  @OA\Xml(
 *   name="DateTimeResource"
 *  )
 * )
*/
class DateTimeResource extends JsonResource
{
    /**
     * @OA\Property(
     *   property="human",
     *   type="string",
     *   description="long format string",
     *   example="2 hours ago"
     * )
     * @OA\Property(
     *   property="date_time",
     *   type="string",
     *   description="string representation",
     *   example="2024-01-22 12:01:58"
     * )
     * * @OA\Property(
     *   property="human_short",
     *   type="string",
     *   description="short format string",
     *   example="2h ago"
     * )
     */
    private $data;
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'human' => $this->diffForHumans(),
            'date_time' => $this->toDateTimeString(),
            'human_short' => $this->diffForHumans(now(), CarbonInterface::DIFF_RELATIVE_TO_NOW, true),
        ];
    }
}
