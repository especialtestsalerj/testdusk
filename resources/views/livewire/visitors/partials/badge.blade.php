@if($forPrinter)
    <style type="text/css" media="screen">
        .conteudo {
            display: block !important;
        }

        #badge {
            display: none;
        }
    </style>
    <style type="text/css" media="print">
        /* reset.css */
        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed,
        figure, figcaption, footer, header, hgroup,
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure,
        footer, header, hgroup, menu, nav, section {
            display: block;
        }
        body {
            line-height: 1;
        }
        ol, ul {
            list-style: none;
        }
        blockquote, q {
            quotes: none;
        }
        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        /* reset.css */

        .bg-danger, .navbar, .conteudo, .conteudo-rodape {
            display: none !important;
        }

        body {
            background: white !important;
        }

        #badge {
            display: block;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #000;
            width: 72mm;
            height: 40mm;
            margin-top: 2mm;
            margin-right: 4mm;
            margin-bottom: 4mm;
            margin-left: 5mm;
            padding-top: 4mm;
            padding-right: -8mm;
            padding-bottom: 0;
            padding-left: -6mm;
        }

        body.bg-light, #badge {
            background-color: #FFFFFF !important;
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

        .entranced {
            line-height: 15px !important;
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
    </style>
@else
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

        .entranced {
            line-height: 15px !important;
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
            /*background-color: #E6E9ED;*/
            z-index: 1;
            zoom: 2; /* Adjust the zoom value as per your requirement */
        }
    </style>
@endIf

        <div id="badge"
             @if($forPrinter)
             x-init="
            window.debounce = function (func, timeout = 1000){
              let timer;
              return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => { func.apply(this, args); }, timeout);
              };
            }

            const update = window.debounce(() => window.print());

            document.addEventListener('printBadge', update)
            "
             @endIf
        >
            <table>
                <tr>
                    <td colspan="3" class="text-center">{{ config('app.company_abbreviation') }}</td>
                </tr>
                <tr>
                    <td class="badge-bg-title text-center badge-border-title"></td>
                    <td class="text-center badge-border-title">VISITANTE</td>
                    <td class="badge-bg-title text-center badge-border-title"></td>
                </tr>
                <tr>
                    <td class="text-right photo">
                        @if($forPrinter)
                            <img class="photo" src="{{$printVisitor->photo ?? ''}}" />
                        @else
                            <canvas wire:ignore id="canvas-visible-badge" width="75px" height="75px"></canvas>
                            <canvas wire:ignore id="canvas" style="display: none;" width="400px" height="400px"></canvas>
                        @endIf
                    </td>
                    <td class="text-center entranced">ENTRADA<br />{{ $printVisitor?->entranced_at?->format('d/m/Y') }}<br />{{ $printVisitor?->entranced_at?->format('H:i') }}</td>
                    <td class="text-left photo"><img src="{{$printVisitor->qr_code_uri ?? ''}}" class="qr" /></td>
                </tr>
                <tr>
                    <td colspan="3" class="badge-text text-center {{ mount_css_text(mount_text($printVisitor?->person?->name)) }}">{{ mount_text($printVisitor?->person?->name) }}</td>
                </tr>
                <tr>
{{--                    {{dump($printVisitor?->sectors)}}--}}
                    <td colspan="3" class="badge-text text-center {{ mount_css_text(mount_text($printVisitor?->sectors?->first()?->name)) }}">
                        {{ mount_text($printVisitor?->sectors?->first()?->name) }}
                        @if(!is_null($printVisitor?->sectors) &&  count($printVisitor?->sectors) > 1)&nbsp;+{{count($printVisitor?->sectors) - 1}}@endif
                    </td>
                </tr>
            </table>
        </div>

