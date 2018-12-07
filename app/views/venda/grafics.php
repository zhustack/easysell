<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>
    <html>
    <script type="text/javascript" src="\mvcaplicado\public\assets\chart.js\dist\Chart.js"></script>
    <style>
        .graficos .btn-defaultOur {
            height: 2.5em;
            width: 8.5em;
        }
    </style>
	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-ow">
			<?php 
				if($_SESSION['dados']['idTipoFunc'] == 1) {
                    require_once "../app/views/common/navLateralG.php"; 			
				} else {
                    require_once "../app/views/common/navLateralF.php"; 			
				}
                ?>
			<div class="general graficos d-flex justify-content-center align-items-center flex-column h-100 p-0">
                <div id="sisGrafico" class="mb-3" >
                <?php 
                    if($_SESSION['dados']['idTipoFunc'] == 1) {
                        ?>
                        <button class="btn-defaultOur" onclick="fnConsultaGrafico()">Ranking Geral</button>
                        <button class="btn-defaultOur" onclick="fnConsultaGrafico('pessoal')">Ranking Pessoal</button>
                        <button class="btn-defaultOur" onclick="fnConsultaGrafico('hoje')">Ranking Diário</button>
                        <button class="btn-defaultOur" onclick="fnConsultaGrafico('mes')">Ranking Mensal</button>
                <?php 			
                    } else {
                        ?>
                        <button class="btn-defaultOur" onclick="fnConsultaGrafico()">Ranking Geral</button>
                        <button class="btn-defaultOur" onclick="fnConsultaGrafico('mesF')">Ranking Mensal</button>
                        <button class="btn-defaultOur" onclick="fnConsultaGrafico('hoje')">Ranking Diário</button>

                <?php
                    }
                ?>
                    
                </div>
                <div id="paiGrafico">
                    <!-- <canvas id="grafico" width="400" height="400"></canvas> -->
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript">
        document.body.onload = fnConsultaGrafico();

        function fnConsultaGrafico(params = '') {
            const conn = new XMLHttpRequest();
            conn.open('GET', '/mvcaplicado/public/Venda/listarVendas/'+params);
            conn.send();
            conn.onload = () => {
                fnMostrarGrafico(conn.responseText, params);
            }

        }

        
        function fnMostrarGrafico(dados,type) {
            if(document.getElementById('grafico') != null) {
                while(document.all.paiGrafico.hasChildNodes()) {
                    document.all.paiGrafico.removeChild(document.all.paiGrafico.firstChild);
                }
            }
            var eGrafico = document.createElement("CANVAS");
            eGrafico.width = "600";
            eGrafico.height = "550";
            eGrafico.id = "grafico";
            document.all.paiGrafico.appendChild(eGrafico);


            var grafico = "";
            dados = JSON.parse(dados);
            labels = [];
            label = '';
            valores = [];
            bgColor = [];

            if(type == 'pessoal') {
                for( i = 0 ; i < dados.length; i++){

                        label = 'Seu ranking pessoal por dia';
                
                        labels.push(dados[i].vndData);
                        
                        valores.push(parseFloat(dados[i].totVenda));
                
                        bgColor.push('rgba(' + parseInt((Math.random() * 255) + 1) + ',0,' + parseInt((Math.random() * 100) + 1) + ',1)');
                }
                
            } else if (type == 'mesF') {
                for( i = 0 ; i < dados.length; i++){

                    label = 'Seu ranking este mês';

                    labels.push(dados[i].vndData);

                    valores.push(parseFloat(dados[i].totVenda));

                    bgColor.push('rgba(' + parseInt((Math.random() * 255) + 1) + ',0,' + parseInt((Math.random() * 255) + 1) + ',1)');
                }
            } else {
                for( i = 0 ; i < dados.length; i++){

                        label = 'Total de Vendas';

                        if(dados[i].fCodigo != null) {
                            labels.push(dados[i].fCodigo + ' - ' + dados[i].fNome);
                        } else {
                            labels.push(dados[i].fNome);
                        }
                        
                        valores.push(parseFloat(dados[i].totVenda));
    
                        bgColor.push('rgba(' + parseInt((Math.random() * 255) + 1) + ',0,' + parseInt((Math.random() * 255) + 1) + ',1)');
                }

            }

            // eGrafico = document.getElementById('grafico').getContext('2d');

            grafico = new Chart(eGrafico.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: valores,
                        backgroundColor: bgColor
                    }]
                },
                options: {
                    
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }

    </script>
</html>