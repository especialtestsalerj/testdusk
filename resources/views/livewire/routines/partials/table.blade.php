<div class="row">
    <div class="col-md-12">
        @forelse ($routines as $routine)
            <div class="cards-striped mx-lg-0 mt-lg-2 my-2">
                <div class="card">
                    <div class="card-body py-lg-1">
                        <div class="row d-flex align-items-center">
                            <div class="col-12 col-lg-10">
                                <div class="row d-flex align-items-center">
                                    <div class="col-4 col-lg-3 text-center text-lg-start">
                                        <span class="fw-bold">Rotina:</span> {{ $routine->code }}
                                    </div>
                                    <div class="col-5 col-lg-3 text-center text-lg-start">
                                        <span class="fw-bold">Turno:</span> {{ $routine?->shift?->name }}
                                    </div>
                                    <div class="col-3 col-lg-4 text-center text-lg-start">
                                        {{--<span class="fw-bold">Status:</span>--}}
                                        @if ($routine->status)
                                            <label class="badge bg-success"> ABERTA </label>
                                        @else
                                            <label class="badge bg-danger"> FINALIZADA </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row d-flex align-items-center">
                                    <div class="col-12 col-lg-6 text-center text-lg-start">
                                        <span class="fw-bold">Assunção:</span> {{ $routine?->entranced_at?->format('d/m/Y \À\S H:i') ?? '-' }} {{ $routine?->entrancedUser?->name }}
                                    </div>
                                    <div class="col-12 col-lg-6 text-center text-lg-start">
                                        <span class="fw-bold">Passagem:</span> {{ $routine?->exited_at?->format('d/m/Y \À\S H:i') }} {{ $routine?->exitedUser?->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-2 text-center text-lg-end">
                                @if ($routine->status)
                                    <a href="{{ route('routines.show', ['id' => $routine->id, 'redirect' => 'routines.index']) }}" class="btn btn-link btn-sm mx-2" dusk="manageRoutine-{{$routine->id}}" title="Gerenciar Rotina">
                                        <i class="fa fa-lg fa-cog"></i>
                                    </a>
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#finishModal{{$routine->id}}" title="Finalizar Rotina" dusk="finishRoutine">
                                        <i class="fa fa-check-double"></i> Finalizar
                                    </button>
                                @else
                                    <a href="{{ route('routines.show', ['id' => $routine->id, 'redirect' => 'routines.index']) }}" class="btn btn-link btn-sm" title="Detalhar Rotina">
                                        <i class="fa fa-lg fa-search"></i>
                                    </a>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="finishModal{{$routine->id}}" tabindex="-1" aria-labelledby="finishModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form" action="{{ route('routines.finish', ['id' => $routine->id]) }}" method="post">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="finishModalLabel"><i class="fa fa-check-double"></i> Finalização de Rotina</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <span class="badge bg-info text-black required-msg"><i class="fa fa-circle-info"></i> * Campos obrigatórios</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exited_at">Data (Passagem)*</label>
                                    <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="exited_at" id="exited_at" value="{{is_null(old('exited_at')) ? $routine->exited_at?->format('Y-m-d H:i') : old('exited_at')}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="exited_user_id">Responsável (Passagem)*</label>
                                    <select class="form-select form-control" name="exited_user_id" id="exited_user_id">
                                        <option value="">SELECIONE</option>
                                        @foreach ($exitedUsers as $key => $user)
                                            @if(((!is_null($routine->id)) && (!is_null($routine->exited_user_id) && $routine->exited_user_id === $user->id) || (!is_null(old('exited_user_id'))) && old('exited_user_id') == $user->id))
                                                <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                                            @else
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exited_obs">Observações</label>
                                    <textarea class="form-control" name="exited_obs" id="exited_obs" @disabled(!$routine->status || request()->query('disabled'))>{{ is_null(old('exited_obs')) ? $routine->exited_obs: old('exited_obs') }}</textarea>
                                </div>
                                    <?php
                                    $qtdPendingVisitors = count($routine->getPendingVisitors());
                                    $qtdPendingCautions = count($routine->getPendingCautions());
                                    ?>
                                @if($qtdPendingVisitors > 0 || $qtdPendingCautions > 0)
                                    <div class="alert alert-warning" role="alert">
                                        <p><i class="fa fa-triangle-exclamation"></i><strong> Pendências encontradas</strong></p>
                                        <hr>
                                        @if($qtdPendingCautions > 0)
                                            <p>Cautelas de Armas sem encerramento: {{ $qtdPendingCautions }}</p>
                                        @endif
                                        <hr>
                                        <p class="text-justify">Caso deseje finalizar esta rotina, as pendências serão repassadas para a próxima rotina a ser criada, ou seja, serão repassadas as cautelas para serem finalizadas numa rotina seguinte.</p>
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm text-white close-modal" id="submitFinalizarCautela" title="Finalizar Cautela"><i class="fa fa-save" dusk="finishRoutine"></i> Finalizar</button>
                                <button type="button" class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal" title="Fechar Formulário"><i class="fa fa-ban"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning mt-2">
                <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhuma Rotina encontrada.
            </div>
        @endforelse
        <div class="d-flex justify-content-center mt-4">{{ $routines->links() }}
        </div>
    </div>
</div>
