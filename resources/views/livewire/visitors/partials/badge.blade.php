<style type="text/css" media="screen">
    #badge {
        background-color: #FFFFFF;
        display: block;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #000;
        width: 72mm;
        height: 40mm;

        margin-right: 4mm;
        margin-left: 5mm;
        /*margin-top: 2mm;*/
        /*margin-bottom: 4mm;*/
        /*padding-top: 4mm;*/
        padding-right: -8mm;
        padding-bottom: 0;
        padding-left: -6mm;
    }

    #badge table {
        width: 100%;
    }

    #badge table td {
        padding: 2px 0;
        vertical-align: middle;
        line-height: 9px;
    }

    .photo {
        width: 20mm;
        height: 20mm;
    }

    .badge-bg-title {
        background-color: #000;
        color: #000;
        font-weight: bold;
    }

    .badge-border-title {
        border: 1px solid #000;
    }

    .badge-text {
        padding-right: 6mm;
    }

    .badge-text-sm {
        font-size: 9px;
    }

    .badge-font-size-11 {
        font-size: 11px;
    }

    .badge-font-size-10 {
        font-size: 10px;
    }

    .badge-font-size-9 {
        font-size: 9px;
    }

    .zoom {
        background-color: #d3d3d3;
        z-index: 9999;
        zoom: 2; /* Adjust the zoom value as per your requirement */
    }
</style>

<div class="zoom sticky-top d-flex justify-content-center"

>
<div id="badge" x-init="

window.debounce = function (func, timeout = 1000){
  let timer;
  return (...args) => {
    clearTimeout(timer);
    timer = setTimeout(() => { func.apply(this, args); }, timeout);
  };
}

const update = window.debounce(() => window.print());

document.addEventListener('printBadge', update)">
    <table


    >
        <tr>
            <td colspan="3" class="text-center badge-text-sm">{{ mb_strtoupper(env('APP_COMPANY', 'Laravel')) }}</td>
        </tr>
        <tr>
            <td class="badge-bg-title text-center badge-border-title"></td>
            <td class="text-center badge-border-title">VISITANTE</td>
            <td class="badge-bg-title text-center badge-border-title"></td>
        </tr>
        <tr>
            <td class="text-left photo">
{{--                <img class="photo" src="{{$printVisitor->photo ?? ''}}" />--}}
                <canvas wire:ignore id="canvas-badge" width="75px" height="75px"></canvas>
                <canvas wire:ignore id="canvas" style="display: none;" width="400px" height="400px"></canvas>
            </td>
            <td class="text-center">ENTRADA<br /><br />{{ $printVisitor?->entranced_at?->format('d/m/Y \À\S H:i') }}</td>
            <td class="text-center photo"><img src="{{$printVisitor->qr_code_uri ?? ''}}" class="qr" /></td>
        </tr>
        <tr>
            <td colspan="3" class="badge-text text-center {{ mount_css_text(mount_text($printVisitor?->person?->name)) }}">{{ mount_text($printVisitor?->person?->name) }}</td>
        </tr>
        <tr>
            <td colspan="3" class="badge-text text-center {{ mount_css_text(mount_text($printVisitor?->sector?->name)) }}">{{ mount_text($printVisitor?->sector?->name) }}</td>
        </tr>
    </table>
</div>
</div>
