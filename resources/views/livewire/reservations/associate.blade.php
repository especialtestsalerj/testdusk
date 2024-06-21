<div class="py-4 px-4 conteudo">

    <div class="row mb-4 d-flex align-items-center">

        <div class="col-8 col-md-8 d-flex align-items-center">
            <h3><i class="fa-solid fa-calendar-days"></i> Setor: </h3>
            <div wire:ignore>
                <select class="select2 form-control text-uppercase"
                        name="sector_id" id="sector_id"
                        wire:model="sector_id" x-ref="sector_id" wire:change="loadReservations" >

                    <option value="">SELECIONE</option>
                    @foreach ($sectors as $sector)
                        <option value="{{ $sector->id ?? $sector['id']}}">
                            {{ convert_case($sector->nickname ?? $sector['nickname'], MB_CASE_UPPER) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
