<?php

namespace App\Providers;

use App\Repositories\SupportEloquentORM;
use App\Repositories\SupportRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(SupportRepositoryInterface::class, SupportEloquentORM::class); // onde estiver injetando a interface, injeta a classe SupportEloquentORM ( o objeto que implementa a interface);
        # vantagem de usar o bind é que se mudar a classe que implementa a interface, não precisa mudar em todos os lugares que injeta a interface
        # pois no final das contas a interface é so o contrato de o que deve ser recebido e o que é retornado
        # entretanto quem o executa é a classe ORM
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
