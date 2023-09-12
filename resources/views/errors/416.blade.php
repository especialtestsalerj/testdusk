<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="shortcut icon" href="{{ url('img/favicon.ico') }}">

    <title>{{ config('app.name') }} - ERRO 416</title>

    <style type="text/css">
        html, body{
            height:100%;
            width:100%;
            font-family: "Open Sans", sans-serif;
        }
        body{
            background: rgb(20,43,83);
            background: linear-gradient(0deg, rgba(20,43,83,1) 0%, rgba(37,78,151,1) 100%);
            /*background: #1a6d62;
            background: radial-gradient(ellipse at center,  #2d9c8e 0%,#1d4641 100%);*/
            /*background: #b7c0c9;
            background: linear-gradient(315deg,#b7c0c9,#f1f3f5);*/
        }
        .error-container{
            width:100%;
            text-align:center;
            position:absolute;
            top: 0;
            bottom: 0;
            height:550px;
            margin:auto;
        }
        .error{
            display:inline-block;
            max-width: 450px;
        }

        .logo img{
            width: 90%;
        }
        .number{
            font-size:160px;
            color:#eef7f5;
            text-shadow: 1px 1px 10px #2f3841;
            font-weight: 700;
        }
        .title{
            color:#eef7f5;
            font-size:28px;
            text-shadow: 1px 1px 5px #20272e;
            margin-bottom: 20px;
        }
        .message{
            font-size:20px;
            color:#eef7f5;
            /*text-shadow: 1px 1px 10px #4b5a69;*/
        }
        .cog-faint{
            /*position:absolute;*/
            font-size:120px !important;
            color:#eef7f5;
            text-shadow: 1px 1px 10px #2f3841;
            /*opacity:0.1;*/
        }
        .row {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .column-1 {
            float: left;
            width: 35%;
        }
        .column {
            float: left;
            width: 65%;
        }
        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
<script src="https://use.fontawesome.com/87f6f824d6.js"></script>
<!-- erro 416 -->
<div class="error-container">
    <div class="error">
        <div class="logo">
            <img src="{{ asset('img/logo-alerj-grande-branco-90.png') }}">
        </div>
        <div class="row">
            <div class="column-1"><i class="fa fa-exclamation-triangle cog-faint" aria-hidden="true"></i></div>
            <div class="column"><div class="number">416</div></div>
        </div>
        <div class="title">
            Solicitação rejeitada
        </div>
        <div class="message">
            Atualize a página e tente novamente.
        </div>
    </div>
</div>
<!-- erro 416 - end -->
</body>
</html>





