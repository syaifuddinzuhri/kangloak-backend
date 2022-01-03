<?php

namespace App\Macros\Response;

use Laravel\Lumen\Http\ResponseFactory;

class ResponseMacros
{
    /**
     * Response macros.
     *
     * @var array
     */
    protected $macros;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->macros = [
            Success::class,
            Error::class,
        ];

        $this->bind($responseFactory);
    }

    /**
     * Bind macros.
     *
     * @param ResponseFactory $factory
     * @return void
     */
    protected function bind($factory)
    {
        foreach ($this->macros as $macro) {
            (new $macro)->run($factory);
        }
    }
}
