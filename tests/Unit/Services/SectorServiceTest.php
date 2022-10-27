<?php

namespace Tests\Unit\Services;

use App\Models\Sector;
use App\Repositories\SectorRepository;
use App\Services\SectorService;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Mockery;

class SectorServiceTest extends ServiceTestCase
{
    /** @var mixed mock */
    protected $mock;
    /** @var mixed sector */
    protected $sector;
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
        $this->mock = Mockery::mock(SectorRepository::class);
        $this->mock->shouldReceive('model')->andReturn(sector::class);

        $this->sector = $this->loadPartial(SectorService::class, Sector::class, [$this->mock]);

        $this->data = [
            "name" => "Padaria",
            "description" => "Padaria e Salgados",
            "aisle" => "A",
            "store_id" => 1,
        ];
    }
    /**
     * test sector index service
     *
     * @return void
     */
    public function test_sector_index_service()
    {
        $this->mock->shouldReceive('with')->andReturn($this->mock);
        $this->mock->shouldReceive('paginate')->andReturn(Mockery::mock(Paginator::class));

        $result = $this->sector->paginate([]);
        $this->assertInstanceOf(Paginator::class, $result);
    }


    /**
     * test sector create service
     *
     * @return void
     */
    public function test_sector_create()
    {
        $data = [
            "name" => "Padaria",
            "description" => "Padaria e Salgados",
            "aisle" => "A",
            "store_id" => 1,
        ];
        $this->mock->shouldReceive('create')
            ->with($data)
            ->andReturn(Mockery::mock(Model::class));

            $response = $this->sector->store($data);
            $this->assertInstanceOf(Sector::class, $response);
    }
    

    /**
     * test sector update service
     *
     * @return void
     */
    public function test_sector_update_service()
    {
        $data = [
            "name" => "Padaria",
            "description" => "Padaria e Salgados",
            "aisle" => "A",
            "store_id" => 1,
        ];

        $model = Mockery::mock(sector::class);
        $model->shouldReceive('getAttribute')
            ->with('id')
            ->andReturn(1);

        $this->mock->shouldReceive('update')
            ->once()
            ->with($data, 1)
            ->andReturn($model);

        $response = $this->sector->update($data, $model);
        $this->assertIsObject($response);
        $this->assertInstanceOf(sector::class, $response);
    }
    

    

    /**
     * test sector delete service
     *
     * @return void
     */
    public function test_sector_delete_service()
    {
        $model = Mockery::mock(Model::class);
        $model->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $this->mock->shouldReceive('delete')
            ->with($model->id)
            ->andReturn(Mockery::mock(Model::class));

        $this->sector->delete($model);
        $this->assertTrue(true);
    }
}
