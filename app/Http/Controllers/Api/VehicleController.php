<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Interfaces\VehiclesInterface;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\ApiController;

class VehicleController extends ApiController
{
    protected $VehicleRepository;

    public function __construct(VehiclesInterface $VehicleRepository)
    {
        $this->VehicleRepository = $VehicleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll($this->VehicleRepository->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->VehicleRepository->store($request, new Vehicle());

        if ($response['success'] === true) {
            return $this->showOne($response['vehicle'], $response['code']);
        } else {
           return $this->errorResponse($response['message'], $response['code']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        $response = $this->VehicleRepository->show($vehicle);

        return $this->showOne($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $response = $this->VehicleRepository->update($request, $vehicle);

        if ($response['success']) {
            return $this->showOne($response['vehicle'], $response['code']);
        } else {
            return $this->errorResponse($response['message'], $response['code']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $response = $this->VehicleRepository->destroy($vehicle);

        if ($response['code'] === 200) {
            return $this->showMessage($response['message']);
        }else {
            return $this->errorResponse($response['message'], $response['code']);
        }

    }
}
