<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>ALERJ - ERRO 403</title>
    <style type="text/css">
        html, body{
            height:100%;
            width:100%;
            font-family: "Open Sans", sans-serif;
        }
        body{
            /*background: #1a6d62;
            background: radial-gradient(ellipse at center,  #2d9c8e 0%,#1d4641 100%);*/

            background: #b7c0c9;
            background: linear-gradient(315deg,#b7c0c9,#f1f3f5);
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
            max-width: 400px;
        }

        .logo img{
            width: 100%;
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
<script src="https://use.fontawesome.com/87f6f824d6.js"></script>
<!-- erro 403 -->
<i class="fa fa-ban cog-faint" aria-hidden="true"></i>
<div class="error-container">
    <div class="error">
        <div class="logo">
            <img src="img/logo-alerj-grande.png">
        </div>
        <div class="number">403</div>
        <div class="title">Você não tem permissão para acessar a página solicitada.</div>
     </div>
</div>
<!-- erro 403 - end -->
</body>
</html>
