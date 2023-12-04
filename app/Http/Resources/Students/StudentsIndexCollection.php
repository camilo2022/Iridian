<?php

namespace App\Http\Resources\Students;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentsIndexCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'students' => $this->collection->map(function ($student) {
                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'document' => $student->document,
                    'phone' => $student->phone,
                    'email' => $student->email,
                ];
            }),
            'meta' => [
                'pagination' => $this->paginationMeta(),
            ],
        ];
    }

    protected function paginationMeta()
    {
        return [
            'total' => $this->total(),
            'count' => $this->count(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'total_pages' => $this->lastPage(),
        ];
    }
}
