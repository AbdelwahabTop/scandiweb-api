<?php

declare(strict_types=1);

namespace Tests\DataProviders;

class RouterDataProvider
{
    public function routeNotFoundCases(): array
    {
        return [
            ['/products', 'get'],
            ['/products', 'post'],
            ['/products', 'put'],
            ['/users', 'post'],
        ];
    }
}
