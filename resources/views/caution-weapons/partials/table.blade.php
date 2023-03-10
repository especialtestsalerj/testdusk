<div class="row" x-data="{ }">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 align-self-center">
                <h4 class="mb-0">
                    <i class="fas fa-gun"></i> Armas
                </h4>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                @if ($routine->status)
                    <button type="button" class="btn btn-primary" wire:click="prepareForCreate" dusk='newWeapon' title="Nova Arma" data-bs-toggle="modal" data-bs-target="#weapon-modal">
                        <i class="fa fa-plus"></i>
                    </button>
                @endif
            </div>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="weapon-modal" tabindex="-1" role="dialog" aria-labelledby="weaponModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <livewire:caution-weapons.create-form :caution_id="$caution->id"/>
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
                        {{ $weapon?->weaponType?->name }} {{ $weapon?->weapon_description }}
                    </td>
                    <td>
                        {{ $weapon->weapon_number }}
                    </td>
                    <td>
                        {{ $weapon?->cabinet?->name }} / BOX {{ $weapon?->shelf?->name }}
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#weapon-modal" title="Detalhar Arma">
                            <i class="fa fa-search"></i>
                        </button>

                        <button type="button" class="btn btn-link" wire:click="prepareForUpdate({{ $weapon->id }})" title="Detalhar Arma">
                            <i class="fa fa-search"></i>
                        </button>
                        @if ($routine->status && !$edit)
                            <button type="button" class="btn btn-link" wire:click="prepareForUpdate({{ $weapon->id }})" title="Alterar Arma">
                                <i class="fa fa-pencil"></i>
                            </button>

                            <button type="button" class="btn btn-link" wire:click="prepareForDelete({{ $weapon->id }})" title="Remover Arma">
                                <i class="fa fa-trash"></i>
                            </button>
                        @endif
                    </td>
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
