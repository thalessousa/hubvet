<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Mockery;
use Psy\Readline\Userland;

class UserServiceTest extends ServiceTestCase
{
    /** @var mixed mock */
    protected $mock;
    /** @var mixed user */
    protected $user;
    /** @var mixed $data */
    protected $data;

    /**
     * setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->mock = Mockery::mock(UserRepository::class);
        $this->mock->shouldReceive('model')->andReturn(User::class);

        $this->user = $this->loadPartial(UserService::class, User::class, [$this->mock]);

        $this->data = [
            "name" => "Mercado1",
            "description" => "admin@gmail.com",
            "password" => "123456",
            "email_verified_at" => null,
            "store_id" => 1,
        ];
    }
    /**
     * test user index service
     *
     * @return void
     */
    public function test_user_index_service()
    {
        $this->mock->shouldReceive('with')->andReturn($this->mock);
        $this->mock->shouldReceive('paginate')->andReturn(Mockery::mock(Paginator::class));

        $result = $this->user->paginate([]);
        $this->assertInstanceOf(Paginator::class, $result);
    }


    /**
     * test user create service
     *
     * @return void
     */
    public function test_user_create()
    {
        $data = [
            "name" => "Mercado1",
            "description" => "admin@gmail.com",
            "password" => "123456",
            "email_verified_at" => null,
            "store_id" => 1,
        ];
        $this->mock->shouldReceive('create')
            ->with($data)
            ->andReturn(Mockery::mock(Model::class));

            $response = $this->user->store($data);
            $this->assertInstanceOf(User::class, $response);
    }
    

    /**
     * test user update service
     *
     * @return void
     */
    public function test_user_update_service()
    {
        $data = [
            "name" => "Mercado1",
            "description" => "admin@gmail.com",
            "password" => "123456",
            "email_verified_at" => null,
            "store_id" => 1,
        ];

        $model = Mockery::mock(User::class);
        $model->shouldReceive('getAttribute')
            ->with('id')
            ->andReturn(1);

        $this->mock->shouldReceive('update')
            ->once()
            ->with($data, 1)
            ->andReturn($model);

        $response = $this->user->update($data, $model);
        $this->assertIsObject($response);
        $this->assertInstanceOf(User::class, $response);
    }
    

    /**
     * test user delete service
     *
     * @return void
     */
    public function test_user_delete_service()
    {

        $model = Mockery::mock(Model::class);
        $model->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $this->mock->shouldReceive('delete')
            ->with($model->id)
            ->andReturn(Mockery::mock(Model::class));

        $this->user->delete($model);
        $this->assertTrue(true);
    }
}
