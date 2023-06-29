<div x-data="{ showButton: false }" @scroll.window="showButton = (window.pageYOffset > 100)" class="text-center pb-5 py-4"
    style="position: fixed; bottom: 10px; right: 10px;" x-show="showButton">
    <a href="#" @click.prevent="window.scrollTo({ top: 0, behavior: 'smooth' })" class="btn btn-primary text-white"
        title="Voltar para o topo">
        <i class="fa-solid fa-arrow-up"></i>
    </a>
</div>
