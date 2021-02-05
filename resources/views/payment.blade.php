@auth

    Va a pagar {{ Cart::getTotal() }}€

    <h1>DATOS EN LA SESION:</h1>
    <?php
    echo '
    <pre>';
    print_r(Session::all());
    echo '</pre>';
    ?>

@endauth
