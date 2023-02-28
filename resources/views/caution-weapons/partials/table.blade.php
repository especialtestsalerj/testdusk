<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 align-self-center">
                <h4 class="mb-0">
                    <i class="fas fa-gun"></i> Armas
                </h4>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                @if ($routine->status)
                    <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" dusk='newWeapon' data-bs-target="#weapon-modal" title="Nova Arma">
                        <i class="fa fa-plus"></i>
                    </button>
                @endif
            </div>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="weapon-modal" tabindex="-1" role="dialog" aria-labelledby="weaponModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="weaponModalLabel"><i class="fas fa-gun"></i> Nova Arma</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <livewire:caution-weapons.create-form :caution_id="$caution->id" />
                    </div>
                </div>
            </div>
        </div>

        <table id="cautionWeaponTable" class="table table-striped table-bordered mt-2">
            <thead>
            <tr>
                <th class="col-md-6">Descrição</th>
                <th class="col-md-2">Numeração</th>
                <th class="col-md-2">Localização</th>
                <th class="col-md-2"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($cautionWeapons as $weapon)
                <tr>
                    <td>
                        {{$weapon?->weaponType?->name}} {{$weapon?->weapon_description}}
                    </td>
                    <td>
                        {{$weapon->weapon_number}}
                    </td>
                    <td>
                        {{$weapon?->cabinet?->name}} / BOX {{$weapon?->shelf?->name}}
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#weapon-modal-detail" title="Detalhar Arma">
                            <i class="fa fa-search"></i>
                        </button>
                        @if($routine->status)
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#weapon-modal-edit" title="Alterar Arma">
                                <i class="fa fa-pencil"></i>
                            </button>

                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#weapon-modal-delete" title="Remover Arma">
                                <i class="fa fa-trash"></i>
                            </button>
                        @endif
                    </td>
                    <!-- Modal -->
                    <div wire:ignore.self class="modal fade" id="weapon-modal-detail" tabindex="-1" role="dialog" aria-labelledby="weaponModalLabelDetail" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="weaponModalLabelDetail"><i class="fas fa-gun"></i> Arma</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <livewire:caution-weapons.create-form :caution_id="$caution->id" :caution_weapon_id="$weapon->id" :mode="'show'" />
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div wire:ignore.self class="modal fade" id="weapon-modal-edit" tabindex="-1" role="dialog" aria-labelledby="weaponModalLabelEdit" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="weaponModalLabelEdit"><i class="fas fa-gun"></i> Alteração de Arma</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <livewire:caution-weapons.create-form :caution_id="$caution->id" :caution_weapon_id="$weapon->id" :mode="'show'" />
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div wire:ignore.self class="modal fade" id="weapon-modal-delete" tabindex="-1" role="dialog" aria-labelledby="weaponModalLabelDelete" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="weaponModalLabelDelete"><i class="fas fa-gun"></i> Remoção de Arma</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <livewire:caution-weapons.create-form :caution_id="$caution->id" :caution_weapon_id="$weapon->id" :mode="'show'" />
                            </div>
                        </div>
                    </div>
                </tr>
            @empty
                <div class="alert alert-warning mt-2">
                    <i class="fa fa-exclamation-triangle"></i> Nenhuma Arma encontrada.
                </div>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
