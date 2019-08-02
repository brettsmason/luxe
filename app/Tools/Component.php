<?php
namespace Luxe\Tools;

use Hybrid\Contracts\Core\Application;

trait Component {

    protected $app;

    public function __construct( Application $app ) {
        $this->app = $app;
    }

    public function register() {
        $this->app->singleton( static::class );
    }
}
