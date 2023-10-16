<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            $maxSector = DB::select('SELECT MAX(id) FROM sectors');

            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 1,
                'SUBSOLO 3 - SUBESTAÇÃO',
                true,
                -3,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 2,
                'SUBSOLO 3 - DEPÓSITO 1',
                true,
                -3,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 3,
                'SUBSOLO 3 - DEPÓSITO 2',
                true,
                -3,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'SUBSOLO 2 - DEPÓSITO 1',
                -2,
                113,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'SUBSOLO 2 - OFICINAS / ATENDIMENTO',
                -2,
                117,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'SUBSOLO 2 - ALMOXARIFADO / ATENDIMENTO',
                -2,
                129,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'SUBSOLO 2 - SEGURANÇA',
                -2,
                119,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'SUBSOLO 2 - ELÉTRICO',
                -2,
                115,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'SUBSOLO 2 - HIDRÁULICO',
                -2,
                116,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'ASSEIO E CONSERVAÇÃO',
                -2,
                118,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 4,
                'SUBSOLO 1 - ASSUNTOS LEGISLATIVOS E TV ALERJ',
                true,
                -1,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 5,
                'SUBSOLO 1 - DEPARTAMENTO MÉDICO',
                true,
                -1,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 6,
                'SUBSOLO 1 - CENTRAL DE ÁUDIO E CONTROLE DE PAINEL',
                true,
                -1,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 7,
                'SUBSOLO 1 - IMPRENSA',
                true,
                -1,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 8,
                'TÉRREO - PORTARIA',
                true,
                1,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 9,
                'TÉRREO - PORTARIA RUA MÉXICO',
                true,
                1,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'TÉRREO - HALL DE ELEVADORES A, B, C',
                1,
                3,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'TÉRREO - HALL DE ELEVADORES D, E, F',
                1,
                4,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'TÉRREO - HALL DE ELEVADORES G, H, I, J, K, L',
                1,
                5,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'TÉRREO - HALL DE ELEVADORES SERVIÇO',
                1,
                6,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'TÉRREO - HALL DE ELEVADORES PORTARIA RUA DA AJUDA',
                1,
                8,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'TÉRREO - HALL DE ELEVADORES PORTARIA RUA MEXICO',
                1,
                7,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'TÉRREO - PLENÁRIO',
                1,
                114,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'TÉRREO - GALERIA',
                1,
                120,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 10,
                'TÉRREO - MONITORAMENTO PREDIAL',
                true,
                1,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 11,
                'TÉRREO - SEGURANÇA',
                true,
                1,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 12,
                '2º ANDAR - 201 - DEFESA DO CONSUMIDOR / CONCILIAÇÃO',
                true,
                2,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 13,
                '2º ANDAR - 202 - APOIO',
                true,
                2,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 14,
                '2º ANDAR - 203 - PROTOCOLO GERAL',
                true,
                2,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 15,
                '2º ANDAR - 204 - ELERJ / AUDITÓRIO',
                true,
                2,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 16,
                '2º ANDAR - 205 - ELERJ / DIRETORIA',
                true,
                2,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '2º ANDAR - 206 - ELERJ',
                2,
                11,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '3º ANDAR - 301 - LIDERANÇA DO GOVERNO',
                3,
                12,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '3º ANDAR - 302 - SECRETARIA DA MESA DIRETORA',
                3,
                13,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '3º ANDAR - 303 - TAQUIGRAFIA E DEBATES',
                3,
                14,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 17,
                '3º ANDAR - 304 - ATAS E PUBLICAÇÕES',
                true,
                3,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 18,
                '3º ANDAR - 305',
                true,
                3,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 19,
                '3º ANDAR - 306 - ESTUDOS, PESQUISAS E INFORMAÇÕES LEGISLATIVAS',
                true,
                3,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 20,
                '3º ANDAR - 307 - COLÉGIO DE LÍDERES',
                true,
                3,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 21,
                '3º ANDAR - 308 - REUNIÃO / MESA DIRETORA',
                true,
                3,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '4º ANDAR - 401 - GAB. DEP. RODRIGO BACELLAR',
                4,
                15,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '4º ANDAR - 402 - GAB. DEP. VITOR JUNIOR',
                4,
                16,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '4º ANDAR - 403 - GAB. DEP. ARTHUR MONTEIRO',
                4,
                17,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '4º ANDAR - 404 - GAB. DEP. CHICO MACHADO',
                4,
                18,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '4º ANDAR - 405 - GAB. DEP. MÁRCIO GUALBERTO',
                4,
                19,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '4º ANDAR - 406 - GAB. DEP. THIAGO RANGEL',
                4,
                20,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '5º ANDAR - 501 - GAB. DEP. DANI MONTEIRO',
                5,
                26,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '5º ANDAR - 502 - GAB. DEP. FLAVIO SERAFINI',
                5,
                25,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '5º ANDAR - 503 - GAB. DEP. YURI',
                5,
                24,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '5º ANDAR - 504 - GAB. DEP. RENATA SOUZA',
                5,
                23,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '5º ANDAR - 505 - GAB. DEP. VAL CEASA',
                5,
                22,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '5º ANDAR - 506 - GAB. DEP. PROFESSOR JOSEMAR',
                5,
                21,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '6º ANDAR - 601 - GAB. DEP. FÁBIO SILVA',
                6,
                28,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '6º ANDAR - 602 - GAB. DEP. CARLOS MACEDO',
                6,
                29,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '6º ANDAR - 603 - GAB. DEP. LÉO VIEIRA',
                6,
                27,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '6º ANDAR - 604 - GAB. DEP. RODRIGO AMORIM',
                6,
                30,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '6º ANDAR - 605 - GAB. DEP. GIOVANI RATINHO',
                6,
                31,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '6º ANDAR - 606 - GAB. DEP. MUNIR NETO',
                6,
                32,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '7º ANDAR - 701 - GAB. DEP. TANDE VIEIRA',
                7,
                33,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '7º ANDAR - 702 - GAB. DEP. SÉRGIO FERNANDES',
                7,
                34,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '7º ANDAR - 703 - GAB. DEP. ROSENVERG REIS',
                7,
                35,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '7º ANDAR - 704 - GAB. DEP. TIA JU',
                7,
                36,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '7º ANDAR - 705 - GAB. DEP. JARI OLIVEIRA',
                7,
                37,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '7º ANDAR - 706 - GAB. DEP. LUIZ CLÁUDIO RIBEIRO',
                7,
                38,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '8º ANDAR - 801 - GAB. DEP. RODRIGO BACELLAR',
                8,
                40,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 22,
                '8º ANDAR - 802 - GAB. DEP. RODRIGO BACELLAR',
                true,
                8,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 23,
                '8º ANDAR - 803 - GAB. DEP. RODRIGO BACELLAR',
                true,
                8,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 24,
                '8º ANDAR - 804 - GAB. DEP. RODRIGO BACELLAR',
                true,
                8,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 25,
                '8º ANDAR - 805 - GAB. DEP. RODRIGO BACELLAR',
                true,
                8,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 26,
                '8º ANDAR - 806 - GAB. DEP. RODRIGO BACELLAR',
                true,
                8,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '9º ANDAR - 901 - GAB. DEP. CÉLIA JORDÃO',
                9,
                46,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '9º ANDAR - 902 - GAB. DEP. CARLOS MINC',
                9,
                45,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '9º ANDAR - 903 - GAB. DEP. VINICIUS COZZOLINO',
                9,
                44,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '9º ANDAR - 904 - GAB. DEP. RENATO MIRANDA',
                9,
                43,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '9º ANDAR - 905 - GAB. DEP. DR. SERGINHO',
                9,
                42,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '9º ANDAR - 906 - GAB. DEP. DANIEL LIBRELON',
                9,
                41,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '10º ANDAR - 1001 - GAB. DEP. BRAZÃO',
                10,
                48,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '10º ANDAR - 1002 - GAB. DEP. DANI BALBI',
                10,
                49,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '10º ANDAR - 1003 - GAB. DEP. JORGE FELIPPE NETO',
                10,
                50,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '10º ANDAR - 1004 - GAB. DEP. DOUGLAS RUAS',
                10,
                51,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '10º ANDAR - 1005 - GAB. DEP. JÚLIO ROCHA',
                10,
                52,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '10º ANDAR - 1006 - GAB. DEP. ANDERSON MORAES',
                10,
                53,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '11º ANDAR - 1101 - GAB. DEP. JAIR BITTENCOURT',
                11,
                54,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '11º ANDAR - 1102 - GAB. DEP. ELTON CRISTO',
                11,
                55,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '11º ANDAR - 1103 - GAB. DEP. ELIKA TAKIMOTO',
                11,
                56,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '11º ANDAR - 1104 - GAB. DEP. ALAN LOPES',
                11,
                57,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '11º ANDAR - 1105 - GAB. DEP. CLÁDIO CRIADO',
                11,
                58,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '11º ANDAR - 1106 - GAB. DEP. FELIPPE POUBEL',
                11,
                59,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '12º ANDAR - 1201 - GAB. DEP. MÁRCIO CANELA',
                12,
                65,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '12º ANDAR - 1202 - GAB. DEP. LUIZ PAULO',
                12,
                64,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '12º ANDAR - 1203 - GAB. DEP. LUCINHA',
                12,
                63,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '12º ANDAR - 1204 - GAB. DEP. MARTHA ROCHA',
                12,
                62,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '12º ANDAR - 1205 - GAB. DEP. GUILHERME DELAROLI',
                12,
                61,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '12º ANDAR - 1206 - GAB. DEP. RAFAEL NOBRE',
                12,
                60,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '13º ANDAR - 1301 - GAB. DEP. ANDREZINHO CECILIANO',
                13,
                66,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '13º ANDAR - 1302 - GAB. DEP. DIONÍSIO LINS',
                13,
                67,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '13º ANDAR - 1303 - GAB. DEP. VERÔNICA LIMA',
                13,
                68,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '13º ANDAR - 1304 - GAB. DEP. ZEIDAN',
                13,
                70,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '13º ANDAR - 1305 - GAB. DEP. MARINA DO MST',
                13,
                69,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '13º ANDAR - 1306 - GAB. DEP. CARLA MACHADO',
                13,
                71,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '14º ANDAR - 1401 - GAB. DEP. SAMUEL MALAFAIA',
                14,
                72,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '14º ANDAR - 1402 - GAB. DEP. FRED PACHECO',
                14,
                73,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '14º ANDAR - 1403 - GAB. DEP. CARLINHOS BNH',
                14,
                74,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '14º ANDAR - 1404 - GAB. DEP. MARCELO DINO',
                14,
                75,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '14º ANDAR - 1405 - GAB. DEP. FELIPINHO RAVIS',
                14,
                76,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '14º ANDAR - 1406 - GAB. DEP. PEDRO RICARDO',
                14,
                77,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '15º ANDAR - 1501 - GAB. DEP. FRANCINE MOTTA',
                15,
                78,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '15º ANDAR - 1502 - GAB. DEP. INDIA ARMELAU',
                15,
                79,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '15º ANDAR - 1503 - GAB. DEP. THIAGO GAGLIASSO',
                15,
                80,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '15º ANDAR - 1504 - GAB. DEP. ANDÉ CORREA',
                15,
                81,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '15º ANDAR - 1505 - GABINETE / 1ª SECRETARIA',
                15,
                82,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '15º ANDAR - 1506 - 1ª SECRETARIA',
                15,
                83,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '16º ANDAR - 1601 - GAB. DEP. DEODALTO',
                16,
                84,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '16º ANDAR - 1602 - GAB. DEP. VALDECY',
                16,
                85,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '16º ANDAR - 1603 - GAB. DEP. FILIPES SOARES',
                16,
                86,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '16º ANDAR - 1604 - GAB. DEP. GISELLE MONTEIRO',
                16,
                87,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '16º ANDAR - 1605 - GAB. DEP. RENATO MACHADO',
                16,
                88,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '16º ANDAR - 1606 - GAB. DEP. OTONI DE PAULA',
                16,
                89,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '17º ANDAR - 1701 - CERIMONIAL',
                17,
                90,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '17º ANDAR - 1702 - CERIMONIAL',
                17,
                91,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '17º ANDAR - 1703 - VICE-PRESIDÊNCIA',
                17,
                92,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '17º ANDAR - 1704 - VICE-PRESIDÊNCIA',
                17,
                93,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '17º ANDAR - 1705 - REUNIÃO / COMISSÕES',
                17,
                94,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '17º ANDAR - 1706 - ASSESSORIA PRESIDÊNCIA',
                17,
                95,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 27,
                '17º ANDAR - 1707 - COMISSÃO DE CONSTITUIÇÃO E JUSTIÇA CCJ',
                true,
                17,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 28,
                '17º ANDAR - 1708 - COMISSÃO DE CONSTITUIÇÃO E JUSTIÇA CCJ',
                true,
                17,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '18º ANDAR - 1801 - PLENÁRIO / COMISSÕES',
                18,
                101,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '18º ANDAR - 1802 - APOIO ÀS COMISSÕES PERMANENTES',
                18,
                100,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '18º ANDAR - 1803 - COMISSÃO DE ORÇAMENTO E FINANÇAS',
                18,
                99,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '18º ANDAR - 1804 - COMISSÃO DE ORÇAMENTO E FINANÇAS',
                18,
                98,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '18º ANDAR - 1805 - DIRETORIA',
                18,
                97,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '18º ANDAR - 1806 - APOIO ÀS COMISSÕES PERMANENTES',
                18,
                96,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 29,
                '18º ANDAR - 1807 - APOIO ÀS COMISSÕES PERMANENTES',
                true,
                18,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '18º ANDAR - 1808 - COMISSÕES / REUNIÃO',
                18,
                176,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 30,
                '18º ANDAR - 1809 - COMISSÕES / REUNIÃO',
                true,
                18,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 31,
                '18º ANDAR - 1810 - LEGISLAQUI',
                true,
                18,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 32,
                '18º ANDAR - 1811 - COMISSÃO DE CONSTITUIÇÃO E JUSTIÇA CCJ',
                true,
                18,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 33,
                '18º ANDAR - 1812 - EDIÇÃO E CORTE',
                true,
                18,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 34,
                '18º ANDAR - 1813 - EDIÇÃO E CORTE',
                true,
                18,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '18º ANDAR - DEPÓSITO',
                18,
                123,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '19º ANDAR - 1901 - REUNIÃO',
                19,
                47,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '19º ANDAR - 1902 - ASSESSORIA PLENÁRIO',
                19,
                102,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '19º ANDAR - 1903 - ASSESSORIA PRESIDÊNCIA',
                19,
                103,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '19º ANDAR - 1904 - ASSUNTOS LEGISLATIVOS',
                19,
                104,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '19º ANDAR - 1905 - GRÁFICA',
                19,
                105,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '19º ANDAR - 1906 - ARQUIVO',
                19,
                106,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 35,
                '20º ANDAR - 2001 - COORDENAÇÃO DE PORTARIA',
                true,
                20,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '20º ANDAR - 2002 - COORDENAÇÃO DE PORTARIA',
                20,
                109,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 36,
                '20º ANDAR - 2003 - ENGENHARIA MANUTENÇÃO',
                true,
                20,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '20º ANDAR - ITAÚ',
                20,
                108,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '20º ANDAR - MEGAMATE',
                20,
                107,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 37,
                '21º ANDAR - 2101 - PREVENÇÃO E COMBATE À TORTURA',
                true,
                21,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 38,
                '21º ANDAR - 2102 - PROTEÇÃO E DEFESA CIVIL',
                true,
                21,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 39,
                '21º ANDAR - 2103 - PROTEÇÃO E DEFESA CIVIL',
                true,
                21,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '21º ANDAR - 2104 - PROTEÇÃO E DEFESA CIVIL',
                21,
                111,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '21º ANDAR - 2105 - AUDITÓRIO',
                21,
                110,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 40,
                '21º ANDAR - 2106 - ASSESSORIA FISCAL',
                true,
                21,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 41,
                '21º ANDAR - 2107 - ASSESSORIA FISCAL',
                true,
                21,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 42,
                '21º ANDAR - 2108 - ASSESSORIA FISCAL',
                true,
                21,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '21º ANDAR - 2109 - REUNIÃO',
                21,
                112,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '22º ANDAR - 2201 - DIRETORIA MÉDICA',
                22,
                172,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 43,
                '22º ANDAR - 2202 - REUNIÃO',
                true,
                22,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 44,
                '22º ANDAR - 2203 - DIRETORIA DE ENFERMAGEM',
                true,
                22,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 45,
                '22º ANDAR - 2204 - ENFERMAGEM',
                true,
                22,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '22º ANDAR - 2205 - EMERGÊNCIA',
                22,
                171,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '22º ANDAR - 2206 - RECEPÇÃO / ODONTOLOGIA',
                22,
                173,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '22º ANDAR - 2207 - IPALERJ',
                22,
                121,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 46,
                '23º ANDAR - 2301 - LIDERANÇA PARTIDÁRIA PSOL',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 47,
                '23º ANDAR - 2302 - LIDERANÇA PARTIDÁRIA PDT',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 48,
                '23º ANDAR - 2303 - LIDERANÇA PARTIDÁRIA PP',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 49,
                '23º ANDAR - 2304 - LIDERANÇA PARTIDÁRIA PT',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 50,
                '23º ANDAR - 2305 - LIDERANÇA PARTIDÁRIA PSB',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 51,
                '23º ANDAR - 2306 - IMPRENSA',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 52,
                '23º ANDAR - 2307 - LIDERANÇA PARTIDÁRIA PODEMOS',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 53,
                '23º ANDAR - 2308 - LIDERANÇA PARTIDÁRIA PL',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 54,
                '23º ANDAR - 2309 - LIDERANÇA PARTIDÁRIA MDB',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 55,
                '23º ANDAR - 2310 - LIDERANÇA PARTIDÁRIA AVANTE',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 56,
                '23º ANDAR - 2311 - LIDERANÇA PARTIDÁRIA PSD',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 57,
                '23º ANDAR - 2312 - COMUNICAÇÃO STREAMING',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 58,
                '23º ANDAR - 2313 - COMISSÃO DE DIREITOS HUMANOS E CIDADANIA',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 59,
                '23º ANDAR - 2314 - COMISSÃO DE DIREITOS HUMANOS E CIDADANIA',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 60,
                '23º ANDAR - 2315 - PARLAMENTO JUVENIL',
                true,
                23,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '23º ANDAR - 2316 - LIDERANÇA PARTIDÁRIA SOLIDARIEDADE',
                23,
                177,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 61,
                '23º ANDAR - 2317 - LIDERANÇA PARTIDÁRIA UNIÃO',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 62,
                '23º ANDAR - 2318 - LIDERANÇA PARTIDÁRIA REPUBLICANOS',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 63,
                '23º ANDAR - 2319 - TRANSPORTES',
                true,
                23,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 64,
                '23º ANDAR - 2320 - COMISSÃO DE DEFESA DA MULHER (SALA LILÁS)',
                true,
                23,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '24º ANDAR - 2401 - RECURSOS HUMANOS RH',
                24,
                131,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '24º ANDAR - 2402 - ADMINISTRAÇÃO DE PESSOAL',
                24,
                167,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '24º ANDAR - 2403 - LEGISLAÇÃO DE PESSOAL',
                24,
                168,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '24º ANDAR - 2404 - GESTÃO DE BENEFÍCIOS',
                24,
                128,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '24º ANDAR - 2405 - EXPEDIENTE E COMUNICAÇÃO',
                24,
                169,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '24º ANDAR - 2406 - EXPEDIENTE E COMUNICAÇÃO',
                24,
                125,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '24º ANDAR - 2407 - DEFESA DO CONSUMIDOR',
                24,
                170,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '25º ANDAR - 2501 - FINANÇAS',
                25,
                161,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '25º ANDAR - 2502 - CONATBILIDADE',
                25,
                160,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '25º ANDAR - 2503 - FINANCEIRO',
                25,
                124,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '25º ANDAR - 2504 - PREPARO DE PAGAMENTOS',
                25,
                162,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '25º ANDAR - 2505 - TRIBUNAL DE CONTAS DO ESTADO TCE',
                25,
                163,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '25º ANDAR - 2506 - CONTROLE INTERNO',
                25,
                164,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '25º ANDAR - 2507 - COMISSÃO DE LICITAÇÕES',
                25,
                165,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '26º ANDAR - 2601 - DIRETORIA GERAL',
                26,
                153,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 65,
                '26º ANDAR - 2602 - DIRETORIA GERAL / ADMINISTRAÇÃO',
                true,
                26,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '26º ANDAR - 2603 - COMUNICAÇÃO SOCIAL',
                26,
                154,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '26º ANDAR - 2604 - CONSELHO ESPECIAL DE ASSESSORIA ORÇAMENTO E FINANÇAS',
                26,
                155,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '26º ANDAR - 2605 - PLANOS E ORÇAMENTO',
                26,
                157,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '26º ANDAR - 2606 - COORDENADORIA INSTITUCIONAL DE SEGURANÇA',
                26,
                156,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '27º ANDAR - 2702 - PROCURADORIA GERAL / RECEPÇÃO',
                27,
                147,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 66,
                '27º ANDAR - 2703 - 2ª VICE-PRESIDÊNCIA',
                true,
                27,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '27º ANDAR - 2704 - PROCURADORIA GERAL / SECRETARIA',
                27,
                148,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '27º ANDAR - 2705 - FÓRUM PERMANENTE',
                27,
                132,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '27º ANDAR - 2706 - COMISSÃO DA PESSOA COM DEFICIÊNCIA',
                27,
                151,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '27º ANDAR - 2707 - CORREGEDORIA',
                27,
                150,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '27º ANDAR - 2708 - CPPA',
                27,
                152,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '27º ANDAR - 2709 - JURÍDICO CODECON',
                27,
                149,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '28º ANDAR - 2801 - INFORMÁTICA',
                28,
                136,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '28º ANDAR - 2802 - MANUTENÇÃO XEROX',
                28,
                135,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '28º ANDAR - 2803 - ',
                28,
                138,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '28º ANDAR - 2804 - ALÔ ALERJ',
                28,
                137,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '28º ANDAR - 2805 - HELP DESK',
                28,
                134,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '28º ANDAR - 2806 - COMUNICAÇÃO',
                28,
                139,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 67,
                '28º ANDAR - 2807 - DESENVOLVIMENTO',
                true,
                28,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '29º ANDAR - 2901 - ENGENHARIA E ARQUITETURA',
                29,
                140,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '29º ANDAR - 2902 - COORDENADORIA DE BENS PATRIMONIAIS',
                29,
                127,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '29º ANDAR - 2903 - PATRIMÔNIO',
                29,
                133,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '29º ANDAR - 2904 - ADMINISTRAÇÃO',
                29,
                142,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '29º ANDAR - 2905 - MATERIAL',
                29,
                143,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '29º ANDAR - 2906 - SEGURANÇA',
                29,
                144,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '29º ANDAR - 2907 - BRIGADA DE INCÊNDIO',
                29,
                145,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 68,
                '29º ANDAR - 2908 - CONTROLE PREDIAL / ELEVADORES',
                true,
                29,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 69,
                '29º ANDAR - 2909 - APOIO / MANUTENÇÃO',
                true,
                29,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 70,
                '29º ANDAR - 2910 - ADMINISTRAÇÃO DE PESSOAL',
                true,
                29,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                '30º ANDAR - 3001 - TV ALERJ / DIRETORIA',
                30,
                126,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 71,
                '30º ANDAR - 3002 - TV ALERJ / REUNIÃO',
                true,
                30,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 72,
                '30º ANDAR - 3003 - TV ALERJ / SWITCHER / ESTÚDIO',
                true,
                30,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 73,
                '30º ANDAR - 3004 - TV ALERJ / ESTÚDIO',
                true,
                30,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 74,
                '30º ANDAR - 3005 - TV ALERJ / RÁDIO',
                true,
                30,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 75,
                '30º ANDAR - 3006 - TV ALERJ / ARQUIVO',
                true,
                30,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 76,
                '30º ANDAR - 3007 - TV ALERJ / DESCANSO',
                true,
                30,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 77,
                '30º ANDAR - 3008 - TV ALERJ / ÁREA TÉCNICA',
                true,
                30,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 78,
                'ELEVADOR A',
                true,
                null,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 79,
                'ELEVADOR B',
                true,
                null,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 80,
                'ELEVADOR C',
                true,
                null,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 81,
                'ELEVADOR D',
                true,
                null,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 82,
                'ELEVADOR E',
                true,
                null,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 83,
                'ELEVADOR F',
                true,
                null,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 84,
                'ELEVADOR G',
                true,
                null,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 85,
                'ELEVADOR H',
                true,
                null,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 86,
                'ELEVADOR I',
                true,
                null,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 87,
                'ELEVADOR J',
                true,
                null,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 88,
                'ELEVADOR K',
                true,
                null,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 89,
                'ELEVADOR L',
                true,
                null,
            ]);
            DB::insert('INSERT INTO sectors (id, name, status, paviment_id) values (?, ?, ?, ?)', [
                $maxSector + 90,
                'ELEVADOR DE SERVIÇO',
                true,
                null,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'EDIFICIO LUCIO COSTA, INTERNA E EXTERNA',
                null,
                174,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id =  ? WHERE id = ?', [
                'ESTACIONAMENTO RUA MÉXICO',
                null,
                175,
            ]);

            DB::update('UPDATE visitors SET sector_id = ? WHERE sector_id = ?', [136, 1]);
            DB::update('UPDATE events SET sector_id = ? WHERE sector_id = ?', [136, 1]);
            DB::update('UPDATE stuffs SET sector_id = ? WHERE sector_id = ?', [136, 1]);

            DB::update('UPDATE visitors SET sector_id = ? WHERE sector_id = ?', [131, 2]);
            DB::update('UPDATE events SET sector_id = ? WHERE sector_id = ?', [131, 2]);
            DB::update('UPDATE stuffs SET sector_id = ? WHERE sector_id = ?', [131, 2]);

            DB::update(
                'UPDATE sectors SET status = false WHERE id IN (10, 122, 166, 159, 158, 146, 141, 39, 9, 1, 2, 130)'
            );

            DB::update('UPDATE sectors SET status = ? WHERE id = ?', [true, 121]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function () {
            $minSector = DB::select('SELECT id FROM sectors WHERE name LIKE ?', [
                'SUBSOLO 3 - SUBESTAÇÃO',
            ]);
            $maxSector = DB::select('SELECT id FROM sectors WHERE name LIKE ?', [
                'ELEVADOR DE SERVIÇO',
            ]);

            DB::delete('DELETE FROM sectors WHERE id BETWEEN ? AND ?', [$minSector, $maxSector]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'SUBSOLO 2',
                null,
                113,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'SUBSOLO 2 OFICINA',
                null,
                117,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'DIV. DE OFICINAS - SUBSOLO  -2',
                null,
                129,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'SUBSOLO 2 SEGURANÇA',
                null,
                119,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'SUBSOLO 3 ELETRICO',
                null,
                115,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'SUBSOLO 3 HIDRULICO',
                null,
                116,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'SUBSOLO 2 ACEIO E CONSERVAÇÃO',
                null,
                118,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'HALL DE ELEVADORES A,B,C',
                null,
                3,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'HALL DE ELEVADORES D,E,F',
                null,
                4,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'HALL DE ELEVADORES G,H,I,J,K,L',
                null,
                5,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'HALL DE ELEVADORES SERVIÇO',
                null,
                6,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'HALL DE ELEVADORES TORTARIA  AJUDA',
                null,
                8,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'HALL DE ELEVADORES TORTARIA MEXICO',
                null,
                7,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'PLENÁRIO',
                null,
                114,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'GALERIA',
                null,
                120,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '2º ANDAR - ELERJ',
                null,
                11,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '3º ANDAR - 301',
                null,
                12,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '3º ANDAR - 302',
                null,
                13,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '3º ANDAR - 303',
                null,
                14,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '4º ANDAR - 401',
                null,
                15,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '4º ANDAR - 402',
                null,
                16,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '4º ANDAR - 403',
                null,
                17,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '4º ANDAR - 404',
                null,
                18,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '4º ANDAR - 405',
                null,
                19,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '4º ANDAR - 406',
                null,
                20,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '5º ANDAR - 501',
                null,
                26,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '5º ANDAR - 502',
                null,
                25,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '5º ANDAR - 503',
                null,
                24,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '5º ANDAR - 504',
                null,
                23,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '5º ANDAR - 505',
                null,
                22,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '5º ANDAR - 506',
                null,
                21,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '6º ANDAR - 601',
                null,
                28,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '6º ANDAR - 602',
                null,
                29,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '6º ANDAR - 603',
                null,
                27,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '6º ANDAR - 604',
                null,
                30,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '6º ANDAR - 605',
                null,
                31,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '6º ANDAR - 606',
                null,
                32,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '7º ANDAR - 701',
                null,
                33,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '7º ANDAR - 702',
                null,
                34,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '7º ANDAR - 703',
                null,
                35,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '7º ANDAR - 704',
                null,
                36,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '7º ANDAR - 705',
                null,
                37,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '7º ANDAR - 706',
                null,
                38,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '8º ANDAR - GAB PRES',
                null,
                40,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '9º ANDAR - 901',
                null,
                46,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '9º ANDAR - 902',
                null,
                45,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '9º ANDAR - 903',
                null,
                44,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '9º ANDAR - 904',
                null,
                43,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '9º ANDAR - 905',
                null,
                42,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '9º ANDAR - 906',
                null,
                41,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '10º ANDAR - 1001',
                null,
                48,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '10º ANDAR - 1002',
                null,
                49,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '10º ANDAR - 1003',
                null,
                50,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '10º ANDAR - 1004',
                null,
                51,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '10º ANDAR - 1005',
                null,
                52,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '10º ANDAR - 1006',
                null,
                53,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '11º ANDAR - 1101',
                null,
                54,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '11º ANDAR - 1102',
                null,
                55,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '11º ANDAR - 1103',
                null,
                56,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '11º ANDAR - 1104',
                null,
                57,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '11º ANDAR - 1105',
                null,
                58,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '11º ANDAR - 1106',
                null,
                59,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '12º ANDAR - 1201',
                null,
                65,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '12º ANDAR - 1202',
                null,
                64,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '12º ANDAR - 1203',
                null,
                63,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '12º ANDAR - 1204',
                null,
                62,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '12º ANDAR - 1205',
                null,
                61,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '12º ANDAR - 1206',
                null,
                60,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '13º ANDAR - 1301',
                null,
                66,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '13º ANDAR - 1302',
                null,
                67,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '13º ANDAR - 1303',
                null,
                68,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '13º ANDAR - 1304',
                null,
                70,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '13º ANDAR - 1305',
                null,
                69,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '13º ANDAR - 1306',
                null,
                71,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '14º ANDAR - 1401',
                null,
                72,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '14º ANDAR - 1402',
                null,
                73,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '14º ANDAR - 1403',
                null,
                74,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '14º ANDAR - 1404',
                null,
                75,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '14º ANDAR - 1405',
                null,
                76,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '14º ANDAR - 1406',
                null,
                77,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '15º ANDAR - 1501',
                null,
                78,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '15º ANDAR - 1502',
                null,
                79,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '15º ANDAR - 1503',
                null,
                80,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '15º ANDAR - 1504',
                null,
                81,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '15º ANDAR - 1505',
                null,
                82,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '15º ANDAR - 1506',
                null,
                83,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '16º ANDAR - 1601',
                null,
                84,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '16º ANDAR - 1602',
                null,
                85,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '16º ANDAR - 1603',
                null,
                86,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '16º ANDAR - 1604',
                null,
                87,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '16º ANDAR - 1605',
                null,
                88,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '16º ANDAR - 1606',
                null,
                89,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '17º ANDAR - 1701',
                null,
                90,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '17º ANDAR - 1702',
                null,
                91,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '17º ANDAR 1703',
                null,
                92,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '17º ANDAR 1704',
                null,
                93,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '17º ANDAR 1705',
                null,
                94,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '17º ANDAR 1706',
                null,
                95,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '18º ANDAR 1801',
                null,
                101,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '18º ANDAR 1802',
                null,
                100,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '18º ANDAR 1803',
                null,
                99,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '18º ANDAR 1804',
                null,
                98,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '18º ANDAR 1805',
                null,
                97,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '18º ANDAR 1806',
                null,
                96,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '18º ANDAR - 1808 -COMISSÕES',
                null,
                176,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '18º ANDAR DEPOSITO',
                null,
                123,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '19º ANDAR - 901',
                null,
                47,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '19º ANDAR - 1902',
                null,
                102,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '19º ANDAR - 1903',
                null,
                103,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '19º ANDAR - 1904',
                null,
                104,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '19º ANDAR - 1905',
                null,
                105,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '19º ANDAR - 1906',
                null,
                106,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '20º ANDAR - DIV. PORTARIA',
                null,
                109,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '20º ANDAR - ITAÚ',
                null,
                108,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '20º ANDAR - MEGAMATE',
                null,
                107,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '21º ANDAR - 2104 SALA REUNIÃO',
                null,
                111,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '21º ANDAR - AUDITORIO',
                null,
                110,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '21º ANDAR - 2109 SALA REUNIÃO',
                null,
                112,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '22º ANDAR - DIRETORIA MÉDICA - 2202',
                null,
                172,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '22º ANDAR - DEPTO. ASSIT. MÉDICA - 2205',
                null,
                171,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '22º ANDAR - DEPTO. ASSIT. ODONTOLÓGICA - 2206',
                null,
                173,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '22º ANDAR - IPALERJ',
                null,
                121,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '2316',
                null,
                177,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '24º ANDAR - 2401 - RECURSO HUMANOS',
                null,
                131,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '24º ANDAR - DEPTO. ADM. DE PESSOAL - 2402',
                null,
                167,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '24º ANDAR - DEPTO. LEGISLAÇÃO DE PESSOAL - 2403',
                null,
                168,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '24º SETOR DE BENEFIFIO',
                null,
                128,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '24º ANDAR - DEPTO. EXPEDIENTE DE COMUNICAÇÃO - 2406',
                null,
                169,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '24º ANDAR - 2406 - EXPEDIENTE E COMUNICAÇÃO',
                null,
                125,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '24º ANDAR - COMISSÃO DE DEF. CONSUMIDOR 9 JURIDICO) - 2407',
                null,
                170,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '25º ANDAR - DETO. FINANCEIRO - 2501',
                null,
                161,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '25º ANDAR - DEPTO. CONTABILIDADE - 2502',
                null,
                160,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '25º ANDAR - FINANÇAS',
                null,
                124,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '25º ANDAR - DEPTO. PREPARO DE PGTO - 2502',
                null,
                162,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '25º ANDAR - TCE - 2505',
                null,
                163,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '25º ANDAR - SDG CONTROLE INTERNO - 2506',
                null,
                164,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '25º ANDAR - COMISSÃO PREMANENTE DE LICITAÇÃO - 2507',
                null,
                165,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '26º ANDAR - DIRETRIA GERAL - 2601/2602',
                null,
                153,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '26º ANDAR - SDG COMUNICAÇÃO SOCIAL - 2603',
                null,
                154,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '26º ANDAR - CONSULTRIA ESP. DE ASS. ORÇAM. E FINACEIRA - 2604/2605',
                null,
                155,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '26º ANDAR - PLANOS E ORÇAMENTO - 2606',
                null,
                157,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '26º ANDAR - ACESSORIA INST. DE SEGURANÇA - 2608',
                null,
                156,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '27º ANDAR - PROCURADORUA GERAL - 2701',
                null,
                147,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '27º ANDAR - PROCURADORUA  - 2704',
                null,
                148,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '2709 ANDAR - FÓRUN PREMANENTE',
                null,
                132,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '27º ANDAR - COMIS. DEF. PESSOA PORTADORS DE DEFICIENCIA - 2706',
                null,
                151,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '27º ANDAR - CORREGEDORUA DA ALERJ - 2707',
                null,
                150,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '27º ANDAR - CPPA DA ALERJ - 2708',
                null,
                152,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '27º ANDAR -SDG FORUN PERMANETE - 2705',
                null,
                149,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '28º ANDAR - SDG INFORMATICA - 2801',
                null,
                136,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '28º ANDAR - MANUTENÇÃO XEROX - 2802',
                null,
                135,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '28º ANDAR - COORD. COMUNICAÇÃO - 2803',
                null,
                138,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '28º ANDAR - ALO ALERJ - 2804',
                null,
                137,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '28º ANDAR - HELPDESK / TELEFONIA 2805',
                null,
                134,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '28º ANDAR -  COMUNICAÇÃO - 2806',
                null,
                139,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '29º ANDAR - SDG ENG E ARQT - 2901',
                null,
                140,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '29º ANDAR - COOD. BENS PATR. - 2902',
                null,
                127,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '29º ANDAR - COORD. DE BENS PATRIMONIAIS - SALA 2902 -',
                null,
                133,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '29º ANDAR - SDG ADMINISTRAÇÃO - 2904',
                null,
                142,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '29º ANDAR - DEPTO. MATERIAL - 2905',
                null,
                143,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '29º ANDAR - SDG SEGURANÇA - 2906',
                null,
                144,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '29º ANDAR - SDG BRIGADA DE INCENDIO - 2907',
                null,
                145,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                '30º ANDAR - TV ALERJ',
                null,
                126,
            ]);

            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'EDIFICIO LUCIO COSTA, INTERNA E EXTERNA',
                null,
                174,
            ]);
            DB::update('UPDATE sectors SET name = ?, paviment_id = ? WHERE id = ?', [
                'ESTACONAMENTO RUA MEXICO',
                null,
                175,
            ]);

            DB::update('UPDATE visitors SET sector_id = ? WHERE sector_id = ?', [1, 136]);
            DB::update('UPDATE events SET sector_id = ? WHERE sector_id = ?', [1, 136]);
            DB::update('UPDATE stuffs SET sector_id = ? WHERE sector_id = ?', [1, 136]);

            DB::update('UPDATE visitors SET sector_id = ? WHERE sector_id = ?', [2, 131]);
            DB::update('UPDATE events SET sector_id = ? WHERE sector_id = ?', [2, 131]);
            DB::update('UPDATE stuffs SET sector_id = ? WHERE sector_id = ?', [2, 131]);

            DB::update(
                'UPDATE sectors SET status = true WHERE id IN (10, 122, 166, 159, 158, 146, 141, 39, 9, 1, 2, 130)'
            );

            DB::update('UPDATE sectors SET status = ? WHERE id = ?', [false, 121]);
        });
    }
};
