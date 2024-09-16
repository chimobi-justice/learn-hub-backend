<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *  title="PaginationResource",
 *  description="Pagination Resource",
 *  @OA\Xml(
 *   name="PaginationResource"
 *  )
 * )
*/
class PaginationResource extends JsonResource
{
    /**
     * @OA\Property(
     *   property="current_page",
     *   type="number",
     *   description="current pagination page number",
     *   example="1"
     * )
     * @OA\Property(
     *   property="last_page",
     *   type="number",
     *   description="last pagination page number",
     *   example="40"
     * )
     * @OA\Property(
     *   property="next_page_url",
     *   type="string",
     *   description="next page url",
     *   example="https://learn-hub-backend.com?page=2"
     * )
     * @OA\Property(
     *   property="total",
     *   type="number",
     *   description="total returned number",
     *   example="100"
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
            "current_page" => $this->currentPage(),
            "last_page" => $this->lastPage(),
            "next_page_url" => $this->nextPageUrl(),
            "total" => $this->total()
        ];
    }
}
