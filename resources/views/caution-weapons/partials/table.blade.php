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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#weapon-modal" title="Nova Arma">
                        <i class="fa fa-plus"></i>
                    </button>
                @endif
            </div>
        </div>

        <table id="cautionWeaponTable" class="table table-striped table-bordered mt-2">
            <thead>
            <tr>
                <th class="col-md-2">Data/Hora</th>
                <th class="col-md-3">Tipo</th>
                <th class="col-md-2">Setor</th>
                <th class="col-md-3">Plantonista</th>
                <th class="col-md-2"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($cautionWeapons as $weapon)
                <tr>
                    <td>
                        {{$weapon->id}}
                    </td>
                    <td>
                        {{$weapon->weaponTypes->name}}
                    </td>
                    <td>
                        {{$weapon->weapon_type_id}}
                    </td>
                    <td>

                    </td>
                    <td>

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
