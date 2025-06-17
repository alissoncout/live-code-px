<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $isCollection = $this->resource instanceof \Illuminate\Support\Collection;

        if ($isCollection) {
            return $this->collectionToArray($this->resource);
        }

        return $this->resourceToArray($this->resource);
    }

    protected function collectionToArray($collection)
    {
        return $collection->map(function ($item) {
            return $this->resourceToArray($item);
        })->toArray();
    }

    protected function resourceToArray($resource)
    {
        return [
            'id' => $resource->id,
            'title' => $resource->title,
            'content' => $resource->content,
            'user'=> array(
                'id' => $resource->user_id,
                'name' => $resource->user->name,
                'email' => $resource->user->email,
            )
        ];
    }
}
