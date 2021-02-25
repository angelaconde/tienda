<!-- FOOTER -->
<div class="container-fluid p-0 pt-5">
    <div class="navbar navbar-dark bg-primary">
        <div class="container justify-content-space-between">
            <img src="{{ asset('/img/envio_gratis.png') }}" style="width: 200px">
            <div class="text-center">
                <a href="{{ route('legal') }}" class="navbar-text text-white h5">TÉRMINOS DE USO</a>
                <br>
                <a href="{{ route('excel-articulos') }}" class="navbar-text text-white">[ EXPORTAR ARTÍCULOS ] </a>
                <a href="{{ route('excel-categorias') }}" class="navbar-text text-white"> [ EXPORTAR CATEGORÍAS ]</a>
                <br>
                <p class="navbar-text">© {{ now()->year }} Angela Conde</p>
            </div>
            <img src="{{ asset('/img/paypal_footer.jpg') }}" class="rounded" style="width: 319px">
        </div>
    </div>
</div>
<!-- FIN DE FOOTER -->
