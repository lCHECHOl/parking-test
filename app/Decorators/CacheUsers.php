<?php

namespace App\Decorators;

use App\Repositories\Users;
use App\Interfaces\UsersInterface;
use Illuminate\Support\Facades\Cache;

class CacheUsers implements UsersInterface
{
    protected $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function getAll()
    {
        $key = "users.page." . request('page', 1);

        return Cache::tags(['users', 'paginacion'.request('page', 1), 'col'])->rememberForever($key, function () {
            return $this->users->getAll();
        });
    }

    public function store($request, $user)
    {
        $created = $this->users->store($request, $user);

        if ($created['success'] === true) {
            Cache::tags('users')->flush();
        }

        return $created;
    }

    public function show($user)
    {
        return Cache::tags('users')->rememberForever("users.".$user->id, function () use ($user) {
            return $this->users->show($user);
        });
    }

    public function update($request, $user)
    {
        $updated = $this->users->update($request, $user);

        if ($updated['success'] === true) {
            Cache::tags('users')->flush();
        }

        return $updated;
    }

    public function destroy($user)
    {
        $deleted = $this->users->destroy($user);
        if ($deleted['code'] === 200) {
            Cache::tags('users')->flush();
        }

        return $deleted;
    }

}
