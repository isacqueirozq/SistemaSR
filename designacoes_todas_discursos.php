<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discursos Públicos</title>

    <link rel="stylesheet" href="css/tabela_designacoes.css">

    <style>
        * {box-sizing: border-box}
        body {font-family: Verdana, sans-serif; margin:0}

        /* Slideshow container */
        .slideshow-container {
        position: relative;
        background: #f1f1f1f1;
        }

        /* Slides */
        .mySlides {
        display: none;
        padding: 25px;
        padding-bottom: 0;
        text-align: left;
        }
        

        /* Next & previous buttons */
        .prev, .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -30px;
        padding: 16px;
        color: #888;
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
        position: absolute;
        right: 0;
        border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
        background-color: rgba(0,0,0,0.8);
        color: white;
        }

        /* The dot/bullet/indicator container */
        .dot-container {
            text-align: center;
            padding: 20px;
            background: #ddd;
            margin-left: 25px;
            margin-right: 25px;
        }

        /* The dots/bullets/indicators */
        .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
        }

        /* Add a background color to the active dot/circle */
        .active, .dot:hover {
        background-color: #717171;
        }

       @media screen and (min-width:500px){
            .mySlides{
                width: 80%;
                margin: auto;
            }
            .dot-container{
                width: 76.5%;
                margin: auto;
            }
        }

    </style>
</head>
<body>
    

<div class="slidesshow-container">

    <section>
            <div class="conteudo">
                <?php
                    require_once("src/ConexaoBD.php");
                    $presidente = "";
                    try {
                        $existe = $conn->query("SELECT * FROM DESIGNACOES WHERE Data >= CURRENT_DATE() AND Reuniao = 1")->rowCount();
                        if ($existe > 0) {
                            //Se tiver uma programação, carregue os dados.
                            $stmt = $conn->prepare("SELECT * FROM DESIGNACOES WHERE Data >= CURRENT_DATE() AND Reuniao = 1");
                            if ($stmt->execute()) {
                                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    $reuniao = $rs->Reuniao;
                                    $data = $rs->Data;
                                        setlocale(LC_ALL,'pt_BR.utf-8');

                                    $presidente = $rs->Presidente;
                                    $orador = $rs->Orador;
                                    $tema = $rs->Tema;
                                    $leitor = $rs->Leitor;
                                    $data = new DateTime($data);
                                    $data->modify('last Monday');
                                    $de = strftime('%d de %B', strtotime($data->format('d-m-Y')));
                                    $data->modify('next Sunday');
                                    $ate = strftime('%d de %B de %Y', strtotime($data->format('d-m-Y')));

                                    echo "
                                    <div class='mySlides'>
                                        <header class='Data'>
                                            ".$de." - ".$ate."
                                        </header>";
                                    echo "
                                        <table class='tabela-cabecalho'>
                                            <tbody>
                                                <tr>
                                                    <td class='cabecalho publica'>Reunião do Fim de Semana</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        <table class='tabela-item-publica'>
                                            <tbody>
                                                <tr>
                                                    <td class='publica-frame'>
                                                        <strong>Presidente: </strong>".$presidente."
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class='caixatema'>
                                                        <strong>Discurso: </strong><span class='tema'>'<span>".$tema."</span>'</span> - <span><i>".$orador."</i></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class='publica-frame'><strong>Leitor de A Sentinela : </strong><span>".$leitor."</span></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    ";
                                }
                            } else {
                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                            }
                        }else {
                            //Se não tiver, coloque tudo em branco.
                                $presidente = "";
                                $orador = "";
                                $tema = "";
                                $leitor = "";
                        }
                    } catch (PDOException $erro) {
                        echo "Erro: " . $erro->getMessage();
                    }
                    // DESIGNÇÕES - FIM
                ?>
            </div>
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

            <div class="dot-container">
                <?php
                try {
                    $qtd = $conn->query("SELECT * FROM DESIGNACOES WHERE Data >= CURRENT_DATE() AND Reuniao = 1")->rowCount();
                    for ($i=1; $i <= $qtd; $i++) { 
                    echo "<span class='dot' onclick='currentSlide(".$i.")'></span>";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: " . $erro->getMessage();
                }
                ?>
            </div>
    </section>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
        showSlides(slideIndex += n);
        }

        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}    
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
        }
    </script>
</div>
</body>
</html>

