<?php

namespace App\Interfaces;

interface UsersInterface
{
    public function getAll();

    public function store($request, $user);

    public function show($user);

    public function update($request, $user);

    public function destroy($user);
}
