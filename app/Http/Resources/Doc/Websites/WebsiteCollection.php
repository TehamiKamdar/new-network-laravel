<?php
namespace App\Http\Resources\Doc\Websites;

use App\Http\Resources\BaseCollection;

class WebsiteCollection extends BaseCollection
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array{data: \App\Http\Resources\Doc\Websites\WebsiteResource[], pagination: array{total: int, count: int, per_page: int, current_page: int, total_pages: int}}
     */
    /** @var string */
    public $collects = \App\Http\Resources\Doc\Websites\WebsiteResource::class;
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'pagination' => $this->pagination
        ];
    }
}