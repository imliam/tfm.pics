<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'url' => $this->url,
            'path' => $this->path,
            'height' => $this->height,
            'width' => $this->width,
            'area' => $this->area,
            'date_added' => $this->date_created,
        ];
    }
}
