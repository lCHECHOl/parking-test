<?php

namespace App\Decorators;

use Illuminate\Support\Facades\Cache;
use App\Interfaces\VehiclesInterface;
use App\Repositories\VehicleRepository;

class CacheVehicles implements VehiclesInterface
{
    protected $vehicles;

    public function __construct(VehicleRepository $vehicles)
    {
        $this->vehicles = $vehicles;
    }

    public function getAll()
    {
        $key = "vehicles.page." . request('page', 1);

        return Cache::tags(['vehicles', 'paginacion'.request('page', 1), 'col'])->rememberForever($key, function () {
            return $this->vehicles->getAll();
        });
    }

    public function store($request, $user)
    {
        $created = $this->vehicles->store($request, $user);

        if ($created['success'] === true) {
            Cache::tags('vehicles')->flush();
        }

        return $created;
    }

    public function show($user)
    {
        return Cache::tags('vehicles')->rememberForever("vehicles.".$user->id, function () use ($user) {
            return $this->vehicles->show($user);
        });
    }

    public function update($request, $user)
    {
        $updated = $this->vehicles->update($request, $user);

        if ($updated['success'] === true) {
            Cache::tags('vehicles')->flush();
        }

        return $updated;
    }

    public function destroy($user)
    {
        $deleted = $this->vehicles->destroy($user);
        if ($deleted['code'] === 200) {
            Cache::tags('vehicles')->flush();
        }

        return $deleted;
    }

}
