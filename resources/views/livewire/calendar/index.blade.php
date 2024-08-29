<div class="container mx-auto mt-8 p-8 bg-white shadow-lg rounded-lg">

    <!-- Título do Mês -->
    <div class="flex justify-center mb-8">
        <span class="text-2xl font-semibold text-gray-800">
            {{ $currentMonth->translatedFormat('F Y') }}
        </span>
    </div>

    <!-- Calendário -->
    <div class="mb-8">
        <livewire:calendar.appointments-calendar />
    </div>

    <!-- Botões de Navegação -->
    <div class="flex justify-between items-center">
        <button wire:click="previousMonth" class="bg-blue-600 text-white px-6 py-2 rounded-full shadow-md hover:bg-blue-700 transition-all duration-300 ease-in-out">
            &larr; Anterior
        </button>

        <button wire:click="nextMonth" class="bg-blue-600 text-white px-6 py-2 rounded-full shadow-md hover:bg-blue-700 transition-all duration-300 ease-in-out">
            Próximo &rarr;
        </button>
    </div>

</div>
