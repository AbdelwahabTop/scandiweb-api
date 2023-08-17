<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Exceptions\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private Router $router;

    protected function setUp(): void
    {
        parent::setUp();

        $this->router = new Router();
    }

    /** @test */
    public function it_registers_a_route(): void
    {

        $this->router->register('get', '/products', ['ProductController', 'getAll']);

        $expected = [
            'get' => [
                '/products' => ['ProductController', 'getAll'],
            ],
        ];

        $this->assertSame($expected, $this->router->routes());
    }

    /** @test */
    public function it_registers_a_get_route(): void
    {
        $this->router->get('/products', ['ProductController', 'getAll']);

        $expected = [
            'get' => [
                '/products' => ['ProductController', 'getAll'],
            ],
        ];

        $this->assertSame($expected, $this->router->routes());
    }

    /** @test */
    public function it_registers_a_post_route(): void
    {
        $this->router->post('/products', ['ProductController', 'create']);

        $expected = [
            'post' => [
                '/products' => ['ProductController', 'create'],
            ],
        ];

        $this->assertSame($expected, $this->router->routes());
    }

    /** @test */
    public function it_registers_a_delete_route(): void
    {
        $this->router->delete('/products', ['ProductController', 'delete']);

        $expected = [
            'delete' => [
                '/products' => ['ProductController', 'delete'],
            ],
        ];

        $this->assertSame($expected, $this->router->routes());
    }

    /**
     * @test
     * @dataProvider \Tests\DataProviders\RouterDataProvider::routeNotFoundCases
     */
    public function it_throws_route_not_found_exception(
        string $requestUri,
        string $requestMethod
    ): void {
        $products = new class()
        {
            public function fetch(): bool
            {
                return true;
            }
        };

        $this->router->post('/products', [$products::class, 'create']);
        $this->router->get('/products', ['ProductController', 'getAll']);
        $this->router->delete('/products', ['ProductController', 'delete']);

        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestUri, $requestMethod);
    }

    /** @test */
    public function it_resolves_route_from_a_closure(): void
    {
        $this->router->get('/products', fn () => [1, 2, 3]);

        $this->assertSame(
            [1, 2, 3],
            $this->router->resolve('/products', 'get')
        );
    }

    /** @test */
    public function it_resolves_route(): void
    {
        $products = new class()
        {
            public function index(): array
            {
                return [1, 2, 3];
            }
        };

        $this->router->get('/products', [$products::class, 'index']);

        $this->assertSame(
            [1, 2, 3],
            $this->router->resolve('/products', 'get')
        );
    }
}
