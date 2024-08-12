<div class="bg-white p-6 rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">O que deseja realizar?</h2>
    <ul class="space-y-4 text-gray-700 dark:text-gray-300">
        <li>
            <a href="{{ route('agendamento.form-tailwind') }}"
               class="flex items-center p-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600 rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12l2 2 4-4m5 2a9 9 0 11-9-9 9 9 0 019 9z"></path>
                </svg>
                Realizar um agendamento
            </a>
        </li>
        <li>
            <a href="{{ route('agendamento.form-group') }}"
               class="flex items-center p-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600 rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7M9 17l3 3m0 0l3-3m-3 3V10"></path>
                </svg>
                Realizar um agendamento em grupo
            </a>
        </li>
        <li class="flex items-center p-2 text-gray-800 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 rounded-lg transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-8v10a1 1 0 01-1 1H6a1 1 0 01-1-1V7a1 1 0 011-1h9l2-2h2a1 1 0 011 1v2z"></path>
            </svg>
            <form method="post" action="{{ route('agendamento.recover')}}">
                @csrf
                Documento: <input type="text" name="documentNumber" />

                E-mail: <input type="email" name="email" />

                <input type="submit" value="consultar">

            </form>
        </li>
    </ul>
</div>
