<?php

namespace Tests\Unit\Services;

use App\Models\User;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class ServiceTestCase extends TestCase
{
    protected $actingUser;
    protected $targetModel;
    protected $cache;
    protected $redis;
    protected $store;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingUser = Mockery::mock(User::class);
        $this->cache = Mockery::mock(CacheManager::class);
        $this->redis = Mockery::mock(RedisManager::class);

        Auth::shouldReceive('user')->andReturn($this->actingUser);
        $this->actingUser->shouldReceive('getAttribute')->with('id')->andReturn($this->user->id);
        $this->actingUser->shouldReceive('getAttribute')->with('email')->andReturn('admin@gmail.com');
        $this->actingUser->shouldReceive('getAttribute')->with('name')->andReturn('Administrador');
        $this->actingUser->shouldReceive('getAttribute')->with('store')>andReturn($this->store);
        $this->actingUser->shouldReceive('getAuthIdentifier')->andReturn($this->user->id);
        $this->cache->shouldReceive('flush');
        $this->cache->shouldReceive('getRedis')->andReturn($this->redis);
        $this->redis->shouldReceive('keys')->andReturn([]);
    }

    protected function checkUserPermissionTo(string $permission, bool $shouldReturn)
    {
        Auth::shouldReceive('user')->andReturn($this->actingUser);

        $this->actingUser->shouldReceive('can')
            ->with($permission)
            ->andReturn($shouldReturn);
    }

    protected function loadPartial(string $serviceClass, string $modelClass = '', array $args = [], bool $mockFind = true): MockInterface
    {
        $mock = Mockery::mock($serviceClass, $args)->makePartial();
        $mockFind && $mock->shouldReceive('find')
                    ->andReturn($this->targetModel ?? Mockery::mock($modelClass));
        return $mock;
    }
}
