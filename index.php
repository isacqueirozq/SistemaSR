<?php
require_once("src/Comandos.php");

//Configurando a data do Calendário
//Somente Quintas ou Sábados.
function quinta()
{
    // coloque no input: min="<?php sabado(); step="7"
    echo date('Y-m-d', strtotime("next Thursday"));
}
function sabado()
{
    // coloque no input: min="<?php sabado(); step="7"
    echo date('Y-m-d', strtotime("next Saturday"));
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Work+Sans:400,600" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="css/botoes_Menu.css"> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="Terno.ico" type="image/x-icon">
    <title>Sistema SR</title>
</head>

<body>
    <!-- Assitência -->
    <section id="1" hidden>
        <h3>Assistência das Reuniões</h3>
        <form action="?act=Salvar_ASSISTENCIA" method="POST" name="Assitencia">
            <input type="date" name="data" id="data" required>
            <input type="number" name="qtd" id="qtd">
            <input type="submit" value="Salvar">
        </form>
        <br>
    </section>
    <!-- Designações -->
    <section id="2" hidden>
        <script>
            // Script que esconde ou mostra DIV de acordo 
            // com o que foi selecionado no SELECT
            $(document).ready(function() {
                $('#reuniao').on('change', function() {
                    var selectValor = '#' + $(this).val();
                    $('#opcoes').children('div').hide();
                    $('#opcoes').children(selectValor).show();

                    var tipo = $("#reuniao option:selected").text();
                    if (tipo == 'Fim de Semana') {
                        $('#dataSab').attr('disabled', false);
                        $('#dataQui').attr('disabled', true);
                        $('#presidenteSab').attr('disabled', false);
                        $('#presidenteQui').attr('disabled', true);
                    } else if (tipo == 'Meio de Semana') {
                        $('#dataSab').attr('disabled', true);
                        $('#dataQui').attr('disabled', false);
                        $('#presidenteSab').attr('disabled', true);
                        $('#presidenteQui').attr('disabled', false);
                    }
                });
            });
        </script>

        <h3>Designações das Reuniões</h3>
        <form action="?act=Salvar_DESIGNACOES" method="POST" name="Designacoes">
            <select name="reuniao" id="reuniao" required>
                <option value="" selected>Escolha uma Reunião</option>
                <option value="0">Meio de Semana</option>
                <option value="1">Fim de Semana</option>
            </select>
            <div id="opcoes">
                <div id="1" hidden>
                    <!-- Fim de Semana -->
                    <h4>Programação: Fim de Semana</h4>
                    <input type="date" min="<?php sabado() ?>" step="7" name="data" id="dataSab" required>
                    <input type="text" name="presidente" id="presidenteSab" placeholder="Presidente" required>
                    <input type="text" name="orador" id="orador" placeholder="Nome do Orador">
                    <input type="text" name="t_discurso" id="t_discurso" placeholder="Tema do Discurso">
                    <input type="text" name="leitor_revista" id="leitor_revista" placeholder="Leitor de A Sentinela">
                </div>
                <div id="0" hidden>
                    <!-- Meio de Semana -->
                    <h4>Programação: Meio de Semana</h4>
                    <input type="date" min="<?php quinta() ?>" step="7" name="data" id="dataQui" required>
                    <input type="text" name="presidente" id="presidenteQui" placeholder="Presidente" required>
                    <input type="text" name="tesouros" id="tesouros" placeholder="Tesouros: Orador">
                    <input type="text" name="joias" id="joias" placeholder="Encontre Jóias: Orador">
                    <input type="text" name="l_biblia" id="l_biblia" placeholder="Leitura da Bíblia">
                    <input type="text" name="faca_01" id="faca_01" placeholder="Faça: 1° Participante">
                    <input type="text" name="faca_02" id="faca_02" placeholder="Faça: 2° Participante">
                    <input type="text" name="faca_03" id="faca_03" placeholder="Faça: 3° Participante">
                    <input type="text" name="faca_04" id="faca_04" placeholder="Faça: 4° Participante">
                    <input type="text" name="vida_01" id="vida_01" placeholder="Vida: 1° Participante">
                    <input type="text" name="vida_02" id="vida_02" placeholder="Vida: 2° Participante">
                    <input type="text" name="vida_03" id="vida_03" placeholder="Vida: 3° Participante">
                    <input type="text" name="dirigente_ebc" id="dirigente_ebc" placeholder="Estudo Bíblico de Congregação">
                    <input type="text" name="leitor_ebc" id="leitor_ebc" placeholder="Leitor do EBC">
                    <input type="text" name="oracao" id="oracao" placeholder="Oração Final">
                </div>
            </div>
            <input type="submit" value="Gravar Programação">
        </form>
        <br>
    </section>
    <!-- Noticias -->
    <section id="3" hidden>
        <h3>Notícias Locais e Anúncios</h3>
        <form action="?act=Salvar_NOTICIAS" method="POST" name="Noticias">
            <input type="text" name="titulo" id="titulo" placeholder="Título" required>
            <input type="text" name="subtitulo" id="subtitulo" placeholder="Subtítulo">
            <input type="date" name="postagem" id="postagem" required>
            <input type="date" name="retirada" id="retirada" required>
            <textarea name="texto" id="texto" cols="30" rows="10" placeholder="Conteúdo" required></textarea>
            <input type="submit" value="Salvar">
        </form>
        <br>
    </section>
    <!-- Petição de Auxiliar -->
    <section id="4" hidden>
        <h3>Petição de Pioneiro Auxiliar</h3>
        <form action="?act=Salvar_PETICAO_AUXILIAR" method="POST" name="Pioneiro_Auxiliar">
            <input type="text" name="nome" id="nome" placeholder="Nome Completo" required>
            <input type="hidden" name="ano" id="ano" placeholder="Ano" value="<?php echo date('Y') ?>">
            <select name="mes" id="mes" required>
                <option value="">Selecione o mês</option>
                <option value="0">Tempo Indeterminado</option>
                <option value="1">Janeiro</option>
                <option value="2">Fevereiro</option>
                <option value="3">Março</option>
                <option value="4">Abril</option>
                <option value="5">Maio</option>
                <option value="6">Junho</option>
                <option value="7">Julho</option>
                <option value="8">Agosto</option>
                <option value="9">Setembro</option>
                <option value="10">Outubro</option>
                <option value="11">Novembro</option>
                <option value="12">Dezembro</option>
            </select>
            <p>Requisito de Horas:</p>
            <input type="radio" name="requisito" id="requisito30" value="30">30 Horas
            <input type="radio" name="requisito" id="requisito50" value="50" checked>50 Horas
            <input type="submit" value="Enviar Petição para os Anciãos">
        </form>
        <br>
    </section>
    <!-- Relatório de Serviço de Campo -->
    <section id="5" hidden>
        <h3>Relatório de Seviço de Campo</h3>
        <form action="?act=Salvar_RELATORIO_CAMPO" method="POST" name="Relatorio_Campo">
            <input type="text" name="nome" id="nome" placeholder="Nome Completo" required>
            <select name="mes" id="mesdoano" required>
                <option selected value="0">Escolha o mês</option>
                <option value="1">Janeiro</option>
                <option value="2">Fevereiro</option>
                <option value="3">Março</option>
                <option value="4">Abril</option>
                <option value="5">Maio</option>
                <option value="6">Junho</option>
                <option value="7">Julho</option>
                <option value="8">Agosto</option>
                <option value="9">Setembro</option>
                <option value="10">Outubro</option>
                <option value="11">Novembro</option>
                <option value="12">Dezembro</option>
            </select>
            <!-- Script que corrige o ano do relatorio no ano novo -->
            <script type="text/javascript">
                var hoje = new Date();
                var ano = hoje.getFullYear();
                var anoNovo = ano - 1;
                $(document).ready(function() {
                    $("#mesdoano").change(function() {
                        var mes = $("#anorel").val($("#mesdoano").val());
                        if (mes.val() == 12 & hoje.getMonth() == 1) {
                            $("#anorel").val(anoNovo);
                        } else if (mes.val() == 12 & hoje.getMonth() == 12) {
                            $("#anorel").val(ano);
                        } else {
                            $("#anorel").val(ano);
                        }
                    });
                });
            </script>
            <input type="text" name="ano" id="anorel" placeholder="Ano" hidden>
            <input type="radio" name="pioneiro" id="pioneiro0" value="0" checked>Publicador
            <input type="radio" name="pioneiro" id="pioneiro1" value="1">Pioneiro Auxiliar
            <input type="radio" name="pioneiro" id="pioneiro2" value="2">Pioneiro Regular
            <input type="radio" name="pioneiro" id="pioneiro3" value="3">Pioneiro Especial

            Publicações:<input type="number" name="publicacoes" id="publicacoes">
            Vídeos:<input type="number" name="videos" id="videos">
            Horas:<input type="number" name="horas" id="hora">
            Revisitas: <input type="number" name="revisitas" id="revisitas">
            Estudos:<input type="number" name="estudos" id="estudos">
            Obs:<textarea name="obs" id="obs" cols="30" rows="10"></textarea>
            <input type="submit" value="Enviar meu Relatório">
        </form>
        <br>
    </section>
    <!-- SAIDAS DE CAMPO -->
    <section id="6" hidden>
        <h3>Saídas de Campo</h3>
        <form action="?act=Salvar_SAIDA_CAMPO" method="POST" name="Saida_Campo">
            <select name="dia_Semana" id="dia_Semana" required>
                <option value="0" selected>Escolha o Dia</option>
                <option value="1">Domingo</option>
                <option value="2">Segunda</option>
                <option value="3">Terça</option>
                <option value="4">Quarta</option>
                <option value="5">Quinta</option>
                <option value="6">Sexta</option>
                <option value="7">Sábado</option>
            </select>
            <input type="text" name="grupo" id="grupo" placeholder="Nome do Grupo">
            <input type="text" name="dirigente" id="dirigente" placeholder="Nome do Dirigente" required>
            <input type="text" name="local_saida" id="local_saida" placeholder="Local da Saída" required>
            <input type="time" name="hora" id="hora" required>
            <input type="text" name="detalhes" id="detalhes" placeholder="Detalhes Adicionais">
            <input type="submit" value="Gravar e Fixar no Quadro">
        </form>
        <br>
    </section>
    <!-- USUARIOS -->
    <section id="7" hidden>
        <h3>Usuários</h3>
        <form action="?act=Salvar_USUARIOS" method="POST" name="Usuarios">
            Usuário:<input type="text" name="user" id="user" placeholder="Nome de Acesso" required>
            Senha:<input type="password" name="senha" id="senha" placeholder="Digite a senha" required>
            <select name="nivel" id="nivel" required>
                <option selected value="0">Selecione a função</option>
                <option value="1">Coordenador</option>
                <option value="2">Secretário</option>
                <option value="3">Supte. de Serviço</option>
                <option value="41">Ajudante - Coordenador</option>
                <option value="42">Ajudante - Secretário</option>
                <option value="43">Ajudante - Serviço</option>
                <option value="99">Super Usuário</option>
            </select>
            <input type="submit" value="Cadastrar">
        </form>
        <br>
    </section>
    <!-- Menu -->
    <section id="8" hidden>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

        <a href="#" class="card education">
            <div class="overlay"></div>
            <div class="circle">

                <svg width="71px" height="76px" viewBox="29 14 71 76" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- Generator: Sketch 42 (36781) - http://www.bohemiancoding.com/sketch -->
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Group" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(30.000000, 14.000000)">
                        <g id="Group-8" fill="#D98A19">
                            <g id="Group-7">
                                <g id="Group-6">
                                    <path d="M0,0 L0,75.9204805 L69.1511499,75.9204805 L0,0 Z M14.0563973,32.2825679 L42.9457663,63.9991501 L14.2315268,63.9991501 L14.0563973,32.2825679 Z" id="Fill-1"></path>
                                </g>
                            </g>
                        </g>
                        <g id="Group-20" transform="translate(0.000000, 14.114286)" stroke="#FFFFFF" stroke-linecap="square">
                            <path d="M0.419998734,54.9642857 L4.70316223,54.9642857" id="Line"></path>
                            <path d="M0.419998734,50.4404762 L4.70316223,50.4404762" id="Line"></path>
                            <path d="M0.419998734,45.9166667 L4.70316223,45.9166667" id="Line"></path>
                            <path d="M0.419998734,41.3928571 L2.93999114,41.3928571" id="Line"></path>
                            <path d="M0.419998734,36.8690476 L4.70316223,36.8690476" id="Line"></path>
                            <path d="M0.419998734,32.3452381 L4.70316223,32.3452381" id="Line"></path>
                            <path d="M0.419998734,27.8214286 L4.70316223,27.8214286" id="Line"></path>
                            <path d="M0.419998734,23.297619 L2.93999114,23.297619" id="Line"></path>
                            <path d="M0.419998734,18.7738095 L4.70316223,18.7738095" id="Line"></path>
                            <path d="M0.419998734,14.25 L4.70316223,14.25" id="Line"></path>
                            <path d="M0.419998734,9.72619048 L4.70316223,9.72619048" id="Line"></path>
                            <path d="M0.419998734,5.20238095 L2.93999114,5.20238095" id="Line"></path>
                            <path d="M0.419998734,0.678571429 L4.70316223,0.678571429" id="Line"></path>
                        </g>
                    </g>
                </svg>
            </div>
            <p>Education</p>
        </a>

        <a href="#" class="card credentialing">
            <div class="overlay"></div>
            <div class="circle">

                <svg width="64px" height="72px" viewBox="27 21 64 72" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- Generator: Sketch 42 (36781) - http://www.bohemiancoding.com/sketch -->
                    <desc>Created with Sketch.</desc>
                    <defs>
                        <polygon id="path-1" points="60.9784821 18.4748913 60.9784821 0.0299638385 0.538377293 0.0299638385 0.538377293 18.4748913"></polygon>
                    </defs>
                    <g id="Group-12" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(27.000000, 21.000000)">
                        <g id="Group-5">
                            <g id="Group-3" transform="translate(2.262327, 21.615176)">
                                <mask id="mask-2" fill="white">
                                    <use xlink:href="#path-1"></use>
                                </mask>
                                <g id="Clip-2"></g>
                                <path d="M7.17774177,18.4748913 L54.3387782,18.4748913 C57.9910226,18.4748913 60.9789911,15.7266455 60.9789911,12.3681986 L60.9789911,6.13665655 C60.9789911,2.77820965 57.9910226,0.0299638385 54.3387782,0.0299638385 L7.17774177,0.0299638385 C3.52634582,0.0299638385 0.538377293,2.77820965 0.538377293,6.13665655 L0.538377293,12.3681986 C0.538377293,15.7266455 3.52634582,18.4748913 7.17774177,18.4748913" id="Fill-1" fill="#59A785" mask="url(#mask-2)"></path>
                            </g>
                            <polygon id="Fill-4" fill="#FFFFFF" transform="translate(31.785111, 30.877531) rotate(-2.000000) translate(-31.785111, -30.877531) " points="62.0618351 55.9613216 7.2111488 60.3692832 1.50838775 5.79374073 56.3582257 1.38577917"></polygon>
                            <ellipse id="Oval-3" fill="#25D48A" opacity="0.216243004" cx="30.0584472" cy="21.7657707" rx="9.95169733" ry="9.17325562"></ellipse>
                            <g id="Group-4" transform="translate(16.959615, 6.479082)" fill="#54C796">
                                <polygon id="Fill-6" points="10.7955395 21.7823628 0.11873799 11.3001058 4.25482787 7.73131106 11.0226557 14.3753897 27.414824 1.77635684e-15 31.3261391 3.77891399"></polygon>
                            </g>
                            <path d="M4.82347935,67.4368303 L61.2182039,67.4368303 C62.3304205,67.4368303 63.2407243,66.5995595 63.2407243,65.5765753 L63.2407243,31.3865871 C63.2407243,30.3636029 62.3304205,29.5263321 61.2182039,29.5263321 L4.82347935,29.5263321 C3.71126278,29.5263321 2.80095891,30.3636029 2.80095891,31.3865871 L2.80095891,65.5765753 C2.80095891,66.5995595 3.71126278,67.4368303 4.82347935,67.4368303" id="Fill-8" fill="#59B08B"></path>
                            <path d="M33.3338063,67.4368303 L61.2181191,67.4368303 C62.3303356,67.4368303 63.2406395,66.5995595 63.2406395,65.5765753 L63.2406395,31.3865871 C63.2406395,30.3636029 62.3303356,29.5263321 61.2181191,29.5263321 L33.3338063,29.5263321 C32.2215897,29.5263321 31.3112859,30.3636029 31.3112859,31.3865871 L31.3112859,65.5765753 C31.3112859,66.5995595 32.2215897,67.4368303 33.3338063,67.4368303" id="Fill-10" fill="#4FC391"></path>
                            <path d="M29.4284029,33.2640869 C29.4284029,34.2202068 30.2712569,34.9954393 31.3107768,34.9954393 C32.3502968,34.9954393 33.1931508,34.2202068 33.1931508,33.2640869 C33.1931508,32.3079669 32.3502968,31.5327345 31.3107768,31.5327345 C30.2712569,31.5327345 29.4284029,32.3079669 29.4284029,33.2640869" id="Fill-15" fill="#FEFEFE"></path>
                            <path d="M8.45417501,71.5549073 L57.5876779,71.5549073 C60.6969637,71.5549073 63.2412334,69.2147627 63.2412334,66.3549328 L63.2412334,66.3549328 C63.2412334,63.4951029 60.6969637,61.1549584 57.5876779,61.1549584 L8.45417501,61.1549584 C5.34488919,61.1549584 2.80061956,63.4951029 2.80061956,66.3549328 L2.80061956,66.3549328 C2.80061956,69.2147627 5.34488919,71.5549073 8.45417501,71.5549073" id="Fill-12" fill="#5BD6A2"></path>
                        </g>
                    </g>
                </svg>

            </div>
            <p>Credentialing</p>
        </a>

        <a href="#" class="card wallet">
            <div class="overlay"></div>
            <div class="circle">

                <svg width="78px" height="60px" viewBox="23 29 78 60" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- Generator: Sketch 42 (36781) - http://www.bohemiancoding.com/sketch -->
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="icon" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(23.000000, 29.500000)">
                        <rect id="Rectangle-3" fill="#AC8BE9" x="67.8357511" y="26.0333433" width="9.40495664" height="21.8788565" rx="4.70247832"></rect>
                        <rect id="Rectangle-3" fill="#6A5297" x="67.8357511" y="38.776399" width="9.40495664" height="10.962961" rx="4.70247832"></rect>
                        <polygon id="Rectangle-2" fill="#6A5297" points="57.3086772 0 67.1649301 26.3776902 14.4413177 45.0699507 4.58506484 18.6922605"></polygon>
                        <path d="M0,19.6104296 C0,16.2921718 2.68622235,13.6021923 5.99495032,13.6021923 L67.6438591,13.6021923 C70.9547788,13.6021923 73.6388095,16.2865506 73.6388095,19.6104296 L73.6388095,52.6639057 C73.6388095,55.9821635 70.9525871,58.672143 67.6438591,58.672143 L5.99495032,58.672143 C2.68403068,58.672143 0,55.9877847 0,52.6639057 L0,19.6104296 Z" id="Rectangle" fill="#8B6FC0"></path>
                        <path d="M47.5173769,27.0835169 C45.0052827,24.5377699 40.9347162,24.5377699 38.422622,27.0835169 L36.9065677,28.6198808 L35.3905134,27.0835169 C32.8799903,24.5377699 28.8078527,24.5377699 26.2957585,27.0835169 C23.7852354,29.6292639 23.7852354,33.7559532 26.2957585,36.3001081 L36.9065677,47.0530632 L47.5173769,36.3001081 C50.029471,33.7559532 50.029471,29.6292639 47.5173769,27.0835169" id="Fill-12" fill="#F6F1FF"></path>
                        <rect id="Rectangle-4" fill="#AC8BE9" x="58.0305835" y="26.1162588" width="15.6082259" height="12.863158"></rect>
                        <ellipse id="Oval" fill="#FFFFFF" cx="65.8346965" cy="33.0919007" rx="2.20116007" ry="2.23319575"></ellipse>
                    </g>
                </svg>

            </div>
            <p>Wallet</p>
        </a>

        <a href="#" class="card human-resources">
            <div class="overlay"></div>
            <div class="circle">

                <svg width="66px" height="77px" viewBox="1855 26 66 77" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- Generator: Sketch 42 (36781) - http://www.bohemiancoding.com/sketch -->
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(1855.000000, 26.000000)">
                        <path d="M4.28872448,42.7464904 C4.28872448,39.3309774 5.4159227,33.7621426 6.40576697,30.4912557 C10.5920767,32.1098991 14.3021264,35.1207513 18.69596,35.1207513 C30.993618,35.1207513 42.5761396,28.7162991 49.9992251,17.9014817 C56.8027248,23.8881252 60.8188351,33.0463165 60.8188351,42.7464904 C60.8188351,60.817447 47.6104607,76.6693426 32.5537798,76.6693426 C17.4970989,76.6693426 4.28872448,60.817447 4.28872448,42.7464904" id="Fill-8" fill="#AFCEFF"></path>
                        <path d="M64.3368879,31.1832696 L62.8424171,46.6027478 L60.6432609,46.7824348 L59.8340669,34.6791304 L47.6573402,25.3339478 C44.2906753,34.068487 34.3459503,40.2903304 24.4684093,40.2903304 C17.7559812,40.2903304 10.046244,37.4168 5.80469412,32.8004522 L5.80469412,34.6791304 L5.80469412,46.6027478 L4.28932167,46.6027478 L1.30187314,27.8802435 C1.30187314,20.9790957 3.52342407,15.5432 7.27229127,11.3578087 C13.132229,4.79558261 21.8124018,0.0492173913 30.5672235,0.342852174 C37.4603019,0.569286957 42.6678084,2.72991304 50.8299179,0.342852174 C51.4629405,1.44434783 51.8615656,3.00455652 51.5868577,5.22507826 C51.4629405,6.88316522 51.2106273,7.52302609 50.8299179,8.45067826 C58.685967,14.1977391 64.3368879,20.7073739 64.3368879,31.1832696" id="Fill-10" fill="#3B6CB7"></path>
                        <path d="M58.9405197,54.5582052 C62.0742801,54.8270052 65.3603242,52.60064 65.6350321,49.5386574 C65.772386,48.009127 65.2617876,46.5570226 64.3182257,45.4584487 C63.3761567,44.3613357 62.0205329,43.6162922 60.4529062,43.4818922 L58.9405197,54.5582052 Z" id="Fill-13" fill="#568ADC"></path>
                        <path d="M6.32350389,54.675367 C3.18227865,54.8492104 0.484467804,52.4957496 0.306803449,49.4264626 C0.217224782,47.8925496 0.775598471,46.4579757 1.75200594,45.3886191 C2.7284134,44.3192626 4.10792487,43.6165843 5.67853749,43.530393 L6.32350389,54.675367 Z" id="Fill-15" fill="#568ADC"></path>
                    </g>
                </svg>

            </div>
            <p>Human Resources</p>
        </a>
    </section>



    <!-- ############################################################################ -->

    <link rel="stylesheet" href="css/Mobile_menu.css">
    <div class="page">
        <header tabindex="0">Seja Bem Vindo</header>
        <div id="nav-container">
            <div class="bg"></div>
            <div class="button" tabindex="0">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <div id="nav-content" tabindex="0">
                <ul>
                    <li><a href="#0">Início</a></li>
                    <li><a href="designacoes.php">Designações das Reuniões</a></li>
                    <li><a href="relatorio_enviar.php">Relatório de Serviço de Campo</a></li>
                    <li><a href="saidas_campo_lista.php">Saídas de Campo</a></li>
                    <li><a href="#0">Enviar Petição de P. Auxiliar </a></li>
                    <li class="small"><a href="gerenciamento.html">Entrar</a><a href="#0">Anúncios</a></li>
                </ul>
            </div>
        </div>

        <main>
            <div class="content">
                <h2>Quadro de Anúncios <span><br> Cong. Santo Antônio dos Lopes</span></h2>
                <p>Para uso da congregação durante o período da Pandemia de Covid-19.
                <p>Envie seu Relatório, petição de Pioneiro Auxiliar. Veja as designações das reuniões, dirigentes e horários das saídas de campo.</p>
                <small><strong>Importante!</strong> Nenhuma informação pessoal é armazenada nese site.</small></p>
            </div>
        </main>
    </div>
</body>

</html>