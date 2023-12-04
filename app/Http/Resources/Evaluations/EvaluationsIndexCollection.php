<?php

namespace App\Http\Resources\Evaluations;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EvaluationsIndexCollection extends ResourceCollection
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
            'evaluations' => $this->collection->map(function ($evaluation) {
                return [
                    'id' => $evaluation->id,
                    'name' => $evaluation->name,
                    'questions' => $evaluation->questions->map(function ($question) {
                            return [
                                'id' => $question->id,
                                'question' => $question->question,
                                'multiple' => $question->multiple,
                                'answers '=> $question->answers->map(function ($answer) {
                                        return [
                                            'id' => $answer->id,
                                            'answer' => $answer->answer,
                                            'correct' => $answer->correct
                                        ];
                                    }
                                )->toArray()
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
