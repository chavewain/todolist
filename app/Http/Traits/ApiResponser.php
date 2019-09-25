<?php

namespace App\Http\Traits;

use Illuminate\Support\Collection;


trait ApiResponser
{
    private function successResponse($data, $code)
    {
    	return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
    	return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {       

        if($collection->isEmpty()){
            return $this->successResponse(['data' => $collection], $code);
        }

        $transformer = $collection->first()->transformer;

        $collection = $this->filterData($collection, $transformer);
        $collection = $this->sortData($collection, $transformer);
        $collection = $this->transformData($collection, $transformer);

    	return $this->successResponse($collection, $code);
    }

    protected function showOne($instance, $code = 200)
    {
        $transformer = $instance->transformer;
        $data = $this->transformData($instance, $transformer);
    	return $this->successResponse([$data], $code);
    }

    protected function showMessage($message, $code = 200){
        return $this->successResponse(['data' => $message], $code);
    }

    protected function filterData(Collection $collection, $transformer)
    {
        foreach (request()->query() as $query => $value) {
            $attribute = $transformer::originalAttributes($query);
            if (isset($attribute, $value)) {
                $collection = $collection->where($attribute, $value);
            }
        }
        return $collection;
    }


    protected function sortData(Collection $collection, $transformer)
    {
        if(request()->has('sort_by')){
            $attribute = $transformer::originalAttributes(request()->sort_by);
            $collection = $collection->sortBy->{$attribute};
        }

        return $collection;
    }


    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);

        return $transformation->toArray();
    }
}