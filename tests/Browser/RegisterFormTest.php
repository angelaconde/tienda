<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterFormTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegisterForm()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee('Registro')
                ->type('name', 'NombreTest')
                ->type('surname', 'ApellidoTest')
                ->type('email', 'emailtest@email.com')
                ->type('telefono', '777777777')
                ->type('nif', '12345678Z')
                ->type('direccion', 'Calle Test, 33')
                ->type('cp', '11111')
                ->type('poblacion', 'Huelva')
                ->type('provincia', 'Huelva')
                ->type('password', '12345678')
                ->type('password_confirmation', '12345678')
                ->pause(2000)
                ->press('Registrarse')
                ->pause(1000)
                ->assertSee('correctamente');
        });
    }
}
