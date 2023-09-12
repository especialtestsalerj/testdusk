<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>CodePen - 503 error page</title>


    <style type="text/css">

        html, body{
            height:100%;
            width:100%;
            font-family: "Open Sans", sans-serif;
        }
        body{
            /*background: #1a6d62;
            background: radial-gradient(ellipse at center,  #2d9c8e 0%,#1d4641 100%);*/

            background: rgb(183, 192, 201);
            background: linear-gradient(315deg, rgb(183, 192, 201) 0%, rgb(241, 243, 245) 100%);
        }
        .error-container{
            width:100%;
            text-align:center;
            position:absolute;
            top: 0;
            bottom: 0;
            height:365px;
            margin:auto;
        }
        .error{
            display:inline-block;
            max-width: 360px;
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
            margin-bottom: 50px;
        }
        .message{
            font-size:20px;
            /*text-shadow: 1px 1px 10px #4b5a69;*/
        }

        .cog-faint{
            position:absolute;
            font-size:400px!important;
            color:#4b5a69;
            opacity:0.1;
        }

    </style>


</head>
<body>
<!-- partial:index.partial.html -->
<script src="https://use.fontawesome.com/87f6f824d6.js"></script>

<i class="fa fa-cogs cog-faint" aria-hidden="true"></i>
<div class="error-container">
    <div class="error">
        <div class="number">404</div>
        <div class="title">Página não encontrada</div>
        <div class="message">A URL requisitada /fimdaURL não foi encontrada no servidor. É tudo que sabemos até agora.</div>
    </div>
</div>
<!-- partial -->

</body>
</html>
