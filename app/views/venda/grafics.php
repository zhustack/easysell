<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>
    <html>
    <script type="text/javascript" src="\mvcaplicado\public\assets\chart.js\dist\Chart.js"></script>

	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-ow">
			<?php 
				if($_SESSION['dados']['idTipoFunc'] == 1) {
                    require_once "../app/views/common/navLateralG.php"; 			
				} else {
                    require_once "../app/views/common/navLateralF.php"; 			
				}
                ?>
			<div class="general d-flex justify-content-center align-items-center flex-row h-100 p-0">
                <div id="paiGrafico">
                    <!-- <canvas id="grafico" width="400" height="400"></canvas> -->
                </div>
                    <div id="sisGrafico" >
                        <button onclick="fnConsultaGrafico()">Ranking Geral</button>
                        <button onclick="fnConsultaGrafico('pessoal')">Ranking Pessoal</button>
                        <button onclick="fnConsultaGrafico('hoje')">Ranking Diário</button>
                        <button onclick="fnConsultaGrafico('mes')">Ranking Mensal</button>
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
            eGrafico.width = "400";
            eGrafico.height = "400";
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

                        label = 'Total de Vendas por Mês';
                
                        labels.push(dados[i].vndData);
                        
                        valores.push(parseFloat(dados[i].totVenda));
                
                        bgColor.push('rgba(' + parseInt((Math.random() * 255) + 1) + ',0,' + parseInt((Math.random() * 255) + 1) + ',1)');
                }
                
            } else {
                for( i = 0 ; i < dados.length; i++){

                        label = 'Total de Vendas';

                        if(dados[i].fCodigo != null) {
                            labels.push(dados[i].fCodigo + ' - ' + dados[i].fNome);
                        }
                        labels.push(dados[i].fNome);
                        
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
                        backgroundColor: bgColor,
                        borderColor: [
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    tooltips: {
                        mode: 'nearest'
                    },
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