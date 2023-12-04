<?php

namespace App\Http\Resources\Questions;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionsIndexCollection extends ResourceCollection
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
            'questions' => $this->collection->map(function ($question) {
                return [
                    'id' => $question->id,
                    'name' => $question->name,
                    'evaluation' => $question->evaluation,
                    'answers' => $question->answers->map(function ($answer) {
                            return [
                                'id' => $answer->id,
                                'question' => $answer->question
                            ];
                        }
                    )->toArray()
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
