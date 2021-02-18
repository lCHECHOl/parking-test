<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser
{
	/**
	 * Funcion de respuesta exitosa
	 *
	 * @param Collection|array $data
	 * @param $code
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	private function successResponse($data, $code)
	{
		return response()->json($data, $code);
	}

	/**
	 * Funcion de error de respuesta
	 *
	 * @param string $message
	 * @param int $code
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function errorResponse(string $message, int $code)
	{
		return response()->json(['error' => $message, 'code' => $code], $code);
	}

	/**
	 * Funcion de respuesta para una coleccion de datos
	 *
	 * @param Collection $collection
	 * @param int $code
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function showAll($collection, int $code = 200)
	{
		if ($collection->isEmpty()) {
			return $this->successResponse(['data' => $collection], $code);
		}

        $transformer = $collection->first()->transformer;

		$collection = $this->filterData($collection, $transformer);
		$collection = $this->sortData($collection, $transformer);
		$collection = $this->paginate($collection);
		$collection = $this->transformData($collection, $transformer);


		return $this->successResponse($collection, $code);
	}

	/**
	 * Funcion de respuesta para una coleccion
	 *
	 * @param Model $instance
	 * @param int $code
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function showOne(Model $instance, int $code = 200)
	{
		$transformer = $instance->transformer;
		$instance = $this->transformData($instance, $transformer);

		return $this->successResponse($instance, $code);
	}

	/**
	 * Funcion de respuesta exitosa
	 *
	 * @param string $message
	 * @param int $code
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function showMessage(string $message, int $code = 200)
	{
		return $this->successResponse(['data' => $message], $code);
	}

	/**
	 * Funcion para filtrar una coleccion
	 *
	 * @param Collection $collection,
	 * @param $transformer
	 *
	 * @return Illuminate\Support\Collection
	 */
	protected function filterData($collection, $transformer)
	{
		foreach (request()->query() as $query => $value) {
			$attribute = $transformer::originalAttribute($query);

			if (isset($attribute, $value)) {
				$collection = $collection->where($attribute, $value);
			}
		}

		return $collection;
	}

	/**
	 * Funcion para ordenar una coleccion
	 *
	 * @param Collection $collection,
	 * @param $transformer
	 *
	 * @return Illuminate\Support\Collection
	 */
	protected function sortData($collection, $transformer)
	{
		if (request()->has('sort_by')) {
			$attribute = $transformer::originalAttribute(request()->sort_by);

			$collection = $collection->sortBy->{$attribute};
		}
		return $collection;
	}

	/**
	 * Funcion para paginar una coleccion
	 *
	 * @param Collection $collection,
	 *
	 * @return Illuminate\Pagination\LengthAwarePaginator
	 */
	protected function paginate($collection)
	{
		$rules = [
			'per_page' => 'integer|min:10|max:50'
		];

		Validator::validate(request()->all(), $rules);

		$page = LengthAwarePaginator::resolveCurrentPage();

		$perPage = 15;
		if (request()->has('per_page')) {
			$perPage = (int) request()->per_page;
		}

		$results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

		$paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
			'path' => LengthAwarePaginator::resolveCurrentPath(),
		]);

		$paginated->appends(request()->all());

		return $paginated;
	}

	/**
	 * Funcion para tranformar los campos de una coleccion
	 *
	 * @param Collection $data
	 * @param $transformer
	 *
	 * @return array
	 */
	protected function transformData($data, $transformer)
	{
		$transformation = fractal($data, new $transformer);

		return $transformation->toArray();
	}
}