<?php

namespace Tests\Unit\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Mockery;

class ProductServiceTest extends ServiceTestCase
{
    /** @var mixed mock */
    protected $mock;
    /** @var mixed product */
    protected $product;
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
        $this->mock = Mockery::mock(ProductRepository::class);
        $this->mock->shouldReceive('model')->andReturn(Product::class);

        $this->product = $this->loadPartial(ProductService::class, Product::class, [$this->mock]);

        $this->data = [
            "name" => "Refrigerante",
            "description" => "test",
            "price" => "2.0",
            "stock" => "100",
            "supplier" => "Coca-Cola",
            "sector_id" => 1,
        ];
    }
    /**
     * test product index service
     *
     * @return void
     */
    public function test_product_index_service()
    {
        $this->mock->shouldReceive('with')->andReturn($this->mock);
        $this->mock->shouldReceive('paginate')->andReturn(Mockery::mock(Paginator::class));

        $result = $this->product->paginate([]);
        $this->assertInstanceOf(Paginator::class, $result);
    }


    /**
     * test product create service
     *
     * @return void
     */
    public function test_product_create()
    {
        $data = [
            "name" => "Refrigerante",
            "description" => "test",
            "price" => "2.0",
            "stock" => "100",
            "supplier" => "Coca-Cola",
            "sector_id" => 1,
        ];
        $this->mock->shouldReceive('create')
            ->with($data)
            ->andReturn(Mockery::mock(Model::class));

            $response = $this->product->store($data);
            $this->assertInstanceOf(Product::class, $response);
    }
    

    /**
     * test product update service
     *
     * @return void
     */
    public function test_product_update_service()
    {
        $data = [
            "name" => "Refrigerante",
            "description" => "test",
            "price" => "2.0",
            "stock" => "100",
            "supplier" => "Coca-Cola",
            "sector_id" => 1,
        ];

        $model = Mockery::mock(Product::class);
        $model->shouldReceive('getAttribute')
            ->with('id')
            ->andReturn(1);

        $this->mock->shouldReceive('update')
            ->once()
            ->with($data, 1)
            ->andReturn($model);

        $response = $this->product->update($data, $model);
        $this->assertIsObject($response);
        $this->assertInstanceOf(Product::class, $response);
    }
    

    

    /**
     * test product delete service
     *
     * @return void
     */
    public function test_product_delete_service()
    {

        $model = Mockery::mock(Model::class);
        $model->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $this->mock->shouldReceive('delete')
            ->with($model->id)
            ->andReturn(Mockery::mock(Model::class));

        $this->product->delete($model);
        $this->assertTrue(true);
    }
}
