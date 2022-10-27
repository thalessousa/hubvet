<?php

namespace Tests\Unit\Services;

use App\Models\Store;
use App\Repositories\StoreRepository;
use App\Services\StoreService;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Mockery;

class StoreServiceTest extends ServiceTestCase
{
    /** @var mixed mock */
    protected $mock;
    /** @var mixed store */
    protected $store;
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
        $this->mock = Mockery::mock(StoreRepository::class);
        $this->mock->shouldReceive('model')->andReturn(Store::class);

        $this->store = $this->loadPartial(StoreService::class, Store::class, [$this->mock]);

        $this->data = [
            "name" => "Padaria",
            "description" => "Padaria e Salgados",
            "type" => "Supercenter",
        ];
    }

    /**
     * test store create service
     *
     * @return void
     */
    public function test_store_create()
    {
        $data = [
            "name" => "Padaria",
            "description" => "Padaria e Salgados",
            "type" => "Supercenter",
        ];
        $this->mock->shouldReceive('create')
            ->with($data)
            ->andReturn(Mockery::mock(Model::class));

            $response = $this->store->store($data);
            $this->assertInstanceOf(Store::class, $response);
    }
    
    /**
     * test store delete service
     *
     * @return void
     */
    public function test_store_delete_service()
    {
        $model = Mockery::mock(Model::class);
        $model->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $this->mock->shouldReceive('delete')
            ->with($model->id)
            ->andReturn(Mockery::mock(Model::class));

        $this->store->delete($model);
        $this->assertTrue(true);
    }
}
