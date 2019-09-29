<?php

namespace App\Transformers;

use App\Task;
use League\Fractal\TransformerAbstract;

class TaskTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Task $task)
    {
        return [
            'identificador' => (int)$task->id,
            'titulo' => (string)$task->name,
            'detalles' => (string)$task->description,
            'estado' => (string)$task->status,
            'imagen' => (string)$task->image,
            'usuario' => (string)$task->user_id,
            'fechaCreacion' => (string)$task->created_at,
            'fechaActualizacion' => (string)$task->updated_at,
            'fechaEliminacion' => isset($task->deleted_at) ? (string) $task->deleted_at : null,

        ];
    }



    public static function originalAttributes($index)
    {
        $attributes = [
            'identificador' => 'id',
            'titulo' => 'name',
            'detalles' => 'description',
            'estado' => 'status',
            'imagen' => 'image',
            'usuario' => 'user_id',
            'fechaCreacion' => 'created_at',
            'fechaActualizacion' => 'updated_at',
            'fechaEliminacion' => 'deleted_at',   
        ];

        return (isset($attributes[$index])) ? $attributes[$index] : null;
    }
}
