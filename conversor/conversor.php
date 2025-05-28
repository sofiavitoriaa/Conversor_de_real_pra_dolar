<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Conversor de Moedas </title>
    <style>
    body{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        text-align: center;
        margin: 0;
        padding: 0;
        background: linear-gradient(to right, #000000, #22223B);
        color: #F2E9E4; 
        }
    main{
        background-color: #4A4E69; 
        padding: 50px;
        margin: 15vh auto;
        max-width: 500px;
        border-radius: 15px;
        box-shadow: 0 0 10px #9A8C98; 
        }
    h1{
    color: #F2E9E4;
    margin-bottom: 30px;
        }
    label{
        display: block;
        margin-bottom: 10px;
        font-size: 1.2em;
        }
    input[type="number"] {
        padding: 10px;
        width: 80%;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        font-size: 1em;
        }
    input[type="submit"] {
        background-color: #9A8C98;
        color: black;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 1em;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }
    input[type="submit"]:hover{
        background-color: #C9ADA7;
        }
    button{
        background-color: #9A8C98; 
        color: black; 
        padding: 10px 20px; 
        border: none; 
        border-radius: 8px; 
        font-size: 1em; 
        cursor: pointer; 
        transition: background-color 0.3s ease; 
    } 
    button:hover{
        background-color: #C9ADA7; 
    }
    </style>
</head>
<body>
    <main>
        <h1> Conversor de Moedas </h1>
        <?php 
            $inicio = date("m-d-Y", strtotime("-7 days"));
            $fim = date("m-d-Y");
            $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $inicio .'\'&@dataFinalCotacao=\''. $fim . '\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

            $dados = json_decode(file_get_contents($url), true);
            //var_dump($dados);

            $cotação = $dados["value"][0]["cotacaoCompra"];
            $real = $_REQUEST["din"] ?? 0;
            $dólar = $real / $cotação;
            $padrão = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
            echo "<p>  Seus " . numfmt_format_currency($padrão, $real, "BRL") . " equivalem a <strong>" . numfmt_format_currency($padrão, $dólar, "USD") . "</strong> </p>"; 
        ?>
        <button onclick="javascript:history.go(-1)"> Voltar </button>
    </main>
</body>
</html>