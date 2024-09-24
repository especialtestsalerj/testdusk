<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationModalLabel">Reservas de {{ $personName }}</h5>
                    <button type="button" class="btn-close text-white" wire:click="clearModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($reservations && !empty($reservations))
                        <div class="row">
                            @foreach($reservations as $reservation)
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 shadow-sm h-100 position-relative">
                                        <div class="card-body">
                                            <h6 class="card-title text-primary">{{ $reservation['code'] }}</h6>
                                            <p class="card-text mb-1">
                                                <strong>Data:</strong> {{ \Carbon\Carbon::parse($reservation['reservation_date'])->format('d/m/Y') }}
                                            </p>
                                            <p class="card-text mb-1">
                                                <strong>Hora:</strong> {{ $reservation['capacity']['hour'] }}
                                            </p>
                                            <p class="card-text mb-1">
                                                <strong>Setor:</strong> {{ $reservation['sector']['name'] }}
                                            </p>
                                            <!-- Checkbox para seleção -->
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="checkbox"
                                                       wire:model="selectedReservations"
                                                       value="{{ $reservation['id'] }}"
                                                       id="reservationCheckbox{{ $reservation['id'] }}">
                                                <label class="form-check-label"
                                                       for="reservationCheckbox{{ $reservation['id'] }}">
                                                    Selecionar para registrar entrada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                            wire:click="confirmSelectedEntries" {{ empty($selectedReservations) ? 'disabled' : '' }}>
                        Confirmar Entradas Selecionadas
                    </button>
                    <button type="button" class="btn btn-secondary" wire:click="clearModal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>
