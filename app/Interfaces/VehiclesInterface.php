<?php

namespace App\Interfaces;

interface VehiclesInterface
{
    public function getAll();

    public function store($request, $vehicle);

    public function show($vehicle);

    public function update($request, $vehicle);

    public function destroy($vehicle);
}
