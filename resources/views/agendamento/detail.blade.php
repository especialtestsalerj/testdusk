@extends('layouts.booking-talwind')

@section('content')
    <div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white shadow-md rounded-lg p-6">
            <div class="mb-6 text-center">
                <h1 class="text-3xl font-bold text-gray-900">Reserva Solicitada com Sucesso!</h1>
            </div>

            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Olá, {{ $reservation->person['full_name'] }}!</strong>
                <span class="block sm:inline">Sua reserva foi criada com os seguintes detalhes:</span>
            </div>

            <div class="mt-6">
                <ul class="list-disc list-inside text-gray-700">
                    <li><span class="font-semibold">Código da Reserva:</span> {{ $reservation->code }}</li>
                    <li><span class="font-semibold">Data:</span> {{ date_format($reservation->reservation_date,"d/m/Y") }}</li>
                    <li><span class="font-semibold">Setor:</span> {{ $reservation->sector?->nickname }}</li>
                </ul>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('agendamento.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Voltar à Página Inicial
                </a>
            </div>
        </div>
    </div>
@endsection
