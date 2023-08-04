<div>
    <div class="row">
    @forelse ($visitors as $visitor)
        <div class="col-md-6 col-lg-4 col-xxl-3 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 col-lg-4" data-label="Foto">
                            <img class="w-100" src="{{$visitor->photo}}">
                        </div>
                        <div class="col-8 col-lg-7">
                            <div class="row">
                                <div class="col-12">
                                    <div data-label="Entrada">
                                        Entrada: {!! $visitor?->entranced_at?->format('d/m/Y  H:i') ?? '-' !!}
                                    </div>
                                    <div data-label="Saída">
                                        Saida: @if(isset($visitor?->exited_at)) {!! $visitor?->exited_at?->format('d/m/Y  H:i') !!} @else <span class="badge bg-warning text-black">EM ABERTO</span> @endif</div>
                                    <div data-label="Visitante">
                                        {{ $visitor->person->name }}
                                    </div>
                                    <div data-label="Documento">
                                        {{$visitor->document?->documentType?->name}}: {{$visitor?->document?->number}}</div>
                                    <div data-label="Setor de Destino">
                                        {{ $visitor?->sector?->name ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-1 actions px-0">
                            <div class="row">
                                <div class="col-12">
                                      <span class="btn btn-link px-0 pt-0 pb-1" wire:click="generateBadge({{ $visitor->id }})" title="Imprimir Etiqueta">
                                            <i class="fa fa-lg fa-print"></i>
                                        </span>
                                </div>
                                <div class="col-12">
                                    @can('visitors:show')
                                        <a href="{{ route('visitors.show', ['visitor' => $visitor->id, 'redirect' => $redirect, 'disabled' => true]) }}" class="btn btn-link px-0 pt-0 pb-1" title="Detalhar"><i class="fa fa-lg fa-search"></i></a>
                                    @endCan
                                </div>
                                <div class="col-12">
                                    @can('visitors:update')
                                        <a href="{{ route('visitors.show', ['visitor' => $visitor->id, 'redirect' => $redirect, 'disabled' => false]) }}" class="btn btn-link px-0 pt-0 pb-1" title="Alterar"><i class="fa fa-lg fa-pencil"></i></a>
                                    @endCan
                                </div>
                                <div class="col-12">
                                    @if(!$visitor->exited_at)
                                        @can('visitors:checkout')
                                            <span class="btn btn-link px-0 pt-0 pb-1" wire:click="prepareForCheckout({{$visitor->id}})" title="Registrar Saída">
                                                    <i class="fa fa-lg fa-arrow-up-right-from-square"></i>
                                                </span>
                                        @endCan
                                    @endIf
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning mt-2">
            <i class="fa fa-exclamation-triangle"></i> Nenhuma Visita encontrada.
        </div>
    @endforelse
</div>


<div class="row">
    <div class="col-md-12">
        @if(!empty($visitors))
            <table class="table-dynamic table table-striped">
                <thead>
                <tr>
                    <td class="col-md-1">Foto</td>
                    <td class="col-md-1">Entrada</td>
                    <td class="col-md-1">Saída</td>
                    <td class="col-md-3">Visitante</td>
                    <td class="col-md-2">Documento</td>
                    <td class="col-md-2">Destino</td>
                    <td class="col-md-2"></td>
                </tr>
                </thead>
                <tbody>
                @endif
                @forelse ($visitors as $visitor)
                    <tr class="align-middle">
                        <td data-label="Foto">
                            <img class="w-75" src="{{$visitor->photo}}">
                        </td>
                        <td data-label="Entrada">{!! $visitor?->entranced_at?->format('d/m/Y \<\b\r\> H:i') ?? '-' !!}</td>
                        <td data-label="Saída">@if(isset($visitor?->exited_at)) {!! $visitor?->exited_at?->format('d/m/Y \<\b\r\> H:i') !!} @else <span class="badge bg-warning text-black">EM ABERTO</span> @endif</td>
                        <td data-label="Visitante">{{ $visitor->person->name }}</td>
                        <td data-label="Documento">{{$visitor->document?->documentType?->name}}: {{$visitor?->document?->number}}</td>
                        <td data-label="Setor de Destino">{{ $visitor?->sector?->name ?? '-' }}</td>
                        <td class="actions">
                        <span class="btn btn-link" wire:click="generateBadge({{ $visitor->id }})" title="Imprimir Etiqueta">
                            <i class="fa fa-lg fa-print"></i>
                        </span>
                            @can('visitors:show')
                                <a href="{{ route('visitors.show', ['visitor' => $visitor->id, 'redirect' => $redirect, 'disabled' => true]) }}" class="btn btn-link" title="Detalhar"><i class="fa fa-lg fa-search"></i></a>
                            @endCan
                            @can('visitors:update')
                                <a href="{{ route('visitors.show', ['visitor' => $visitor->id, 'redirect' => $redirect, 'disabled' => false]) }}" class="btn btn-link" title="Alterar"><i class="fa fa-lg fa-pencil"></i></a>

                            @endCan
                            @if(!$visitor->exited_at)
                                @can('visitors:checkout')
                                    <span class="btn btn-link" wire:click="prepareForCheckout({{$visitor->id}})" title="Registrar Saída">
                                        <i class="fa fa-lg fa-arrow-up-right-from-square"></i>
                                </span>
                                @endCan
                            @endIf
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="visitor-delete-modal{{ $visitor->id }}" tabindex="-1" aria-labelledby="deleteModalLabelVisitor" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabelVisitor"><i class="fas fa-trash"></i> Remoção de Visitante</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form" action="{{ route('visitors.destroy', ['routine_id' => $routine_id, 'id' => $visitor->id]) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="redirect" value="{{ $redirect }}">
                                        <div class="form-group">
                                            <label for="entranced_at">Entrada</label>
                                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="entranced_at" id="entranced_at" value="{{ $visitor->entranced_at }}" disabled/>
                                        </div>
                                        <div class="form-group">
                                            <label for="exited_at">Saída</label>
                                            <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="exited_at" id="exited_at" value="{{ $visitor->exited_at }}" disabled/>
                                        </div>
                                        {{--                                @livewire('people.people', ['person' => $visitor->person, 'routineStatus' => $routine->status, 'mode' => formMode(), 'modal' => true])--}}
                                        <div class="form-group">
                                            <label for="sector_id">Setor</label>
                                            <select class="form-select form-control" name="sector_id" id="sector_id" disabled>
                                                <option value="{{ $visitor->sector?->id }}" selected="selected">{{ $visitor->sector?->name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="duty_user_id">Plantonista</label>
                                            <select class="form-select form-control" name="duty_user_id" id="duty_user_id" disabled>
                                                <option value="{{ $visitor->dutyUser?->id }}" selected="selected">{{ $visitor->dutyUser?->name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Observações</label>
                                            <textarea class="form-control" name="description" id="description" disabled>{{ $visitor->description }}</textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success btn-sm text-white close-modal"><i class="fa fa-check"></i> Remover</button>
                                            <button type="button" class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning mt-2">
                        <i class="fa fa-exclamation-triangle"></i> Nenhuma Visita encontrada.
                    </div>
                @endforelse
                @if(!empty($visitors))
                </tbody>
            </table>
        @endif
        <div class="d-flex justify-content-center mt-2">
            {{ $visitors->links() }}
        </div>


    </div>
</div>
</div>
