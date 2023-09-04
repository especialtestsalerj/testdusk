<div x-data="{ showButton: false }" @scroll.window="showButton = (window.scrollY > 100)"
    style="z-index: 9999; position: fixed; bottom: 10px; right: 10px;" x-show="showButton">
    <a href="#" @click.prevent="window.scrollTo({ top: 0, behavior: 'smooth' })" class="btn btn-primary text-white"
        title="Voltar para o topo">
        <i class="fa-solid fa-arrow-up"></i>
    </a>
</div>
