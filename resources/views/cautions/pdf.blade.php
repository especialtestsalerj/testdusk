<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>ALERJ - Ocorrências - Comprovante de Cautela de Arma(s)</title>

    <style>
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

        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #333;
        }

        img {
            width: 100px;
            height: 100px;
        }

        p {
            padding-top: 10px;
        }

        ul {
            list-style: none;
        }

        ul li {
            padding-bottom: 5px;
        }

        .left {
            text-align: left;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        table.table {
            width: 100%;
        }

        table.table tr td {
            padding: 5px;
        }

        .table .header td {
            vertical-align: top;
            padding-bottom: 0;
        }

        .table .header td p:first-child {
            padding-top: 15px;
        }

        .table .header td p {
            line-height: 10px;
        }

        .table .header .logo {
            width: 80px;
        }

        .table .header .logo img {
            width: 80px;
            height: 80px;
        }

        .table .header td.left, .table .footer td.left {
            padding-left: 25px;
        }

        .table .header td.right, .table .footer td.right {
            padding-right: 25px;
        }

        .table .subject {
            font-size: 110%;
            background-color: #CCC;
        }

        .table .subject td {
            padding: 5px 0;
        }

        .table .content td table {
            margin: 5px 20px;
        }

        .table .content td {
            padding: 2px;
            position: relative;
        }

        .table .signature td {
            font-size: 95%;
            padding-top: 0;
            padding-bottom: 5px;
        }

        .table .signature td p {
            padding-top: 0;
            padding-bottom: 2px;
        }

        .table .footer {
            font-size: 90%;
            border-top: 1px solid #DDD;
            border-bottom: 1px dashed #333;
        }

        .table .footer td {
            padding-bottom: 10px;
        }

        .table .footer p {
            padding-top: 0;
            font-style: italic;
        }

        @if (config('app.draft_document'))
            .watermark {
                position: absolute;
                display: inline-block;
                width: 100%;
                top: 0;
                left: 0;
                opacity: 0.1;
                text-align: center;
                font-size: 120px;
            }
        @endif
    </style>
</head>
<body>
    @for($i = 0; $i < 2; $i++)
    <table class="table">
        <tr class="header">
            <td class="left logo">
                <img alt="Logo Alerj" src="data:image/png;base64,{{ $logoBlob }}" />
            </td>
            <td class="bold">
                <p>ASSEMBLEIA LEGISLATIVA DO ESTADO DO RIO DE JANEIRO</p>
                <p>DEPARTAMENTO DE SEGURANÇA</p>
                <p>ÓRGÃO DA PRESIDÊNCIA</p>
            </td>
            <td class="right">
                <p>{{ $caution?->started_at?->format('d/m/Y') ?? '-'}}</p>
                <p>{{ $caution?->started_at?->format('H:i') ?? '-'}}</p>
            </td>
        </tr>
        <tr class="subject subject2">
            <td class="center bold" colspan="3">CAUTELA DE ARMA Nº {{ $caution?->protocol_number_formatted ?? '' }}</td>
        </tr>
        <tr class="content">
            <td colspan="3">
                <table>
                    <tr>
                        <td class="bold">NOME: </td>
                        <td>{{ $caution->visitor->person->full_name }} - {{ $caution->visitor->person->cpf_formatted }}</td>
                    </tr>
                    <tr>
                        <td class="bold">DESTINO: </td>
                        <td>{{ $caution->visitor?->sector?->name }}</td>
                    </tr>
                    <tr>
                        <td class="bold">ARMA(S): </td>
                        <td>
                            <?php
                            $j = 0;
                            ?>
                            <ul>
                                @foreach($cautionWeapons as $cautionWeapon)
                                    <?php
                                    $j++;
                                    ?>
                                    <li>
                                        {{ str_pad($j, 2, '0', STR_PAD_LEFT) }}) {{ $cautionWeapon->weaponType->name }} {{ $cautionWeapon->weapon_description }}
                                        {{ (strlen($cautionWeapon->weapon_number) > 0) ? ' NÚM. '.$cautionWeapon->weapon_number : '' }}
                                        {{ (strlen($cautionWeapon->register_number) > 0) ? ' (Nº REG. SINARM '.$cautionWeapon->register_number.')' : '' }}
                                        {{ ' '.$cautionWeapon->cabinet->name }} {{ '/ BOX '.$cautionWeapon->shelf->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                </table>
                @if (config('app.draft_document'))
                    <div class="watermark">RASCUNHO</div>
                @endif
            </td>
        </tr>
        <tr class="content signature">
            <td class="center" colspan="3">
                <p>________________________________________________</p>
                <p>ASSINATURA DO/A RESPONSÁVEL PELA(S) ARMA(S)</p>
            </td>
        </tr>
        <tr class="footer">
            <td class="left">
                <p>© {{ mb_strtoupper(env('APP_OWNER', 'Laravel')) }}</p>
            </td>
            <td class="right" colspan="2">
                <p>{{ mb_strtoupper(env('APP_NAME', 'Laravel')) }}</p>
            </td>
        </tr>
    </table>
    @endfor
</body>
</html>
