<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Teste Retorno</title>
  </head>
  <body>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleFormControlFile1">Selecione um arquivo de retorno CNAB400</label>
            <input type="file" class="form-control-file" id="cnab400File" accept=".ret">
        </div>

        <div id="warningMessage" class="alert alert-warning" role="alert">
            
        </div>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tabHeader" role="tab" aria-controls="tabHeader" aria-expanded="true">Header</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tabDetalhes" role="tab" aria-controls="tabDetalhes">Detalhes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tabConteudo" role="tab" aria-controls="tabConteudo">Conteúdo do arquivo</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="tabHeader" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-sm" id="tableForHeader">
                    <thead>
                        <tr>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="tabDetalhes" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table table-sm" id="tableForDetalhes">
                    <thead>
                        <tr>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="tabConteudo" role="tabpanel" aria-labelledby="dropdown1-tab">
                <div class="form-group">
                    <textarea class="form-control" id="outputConteudo" rows="20"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="Bradesco.js"></script>
    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) {
    const CODIGO_BANCO_BRASIL = "001";
    const CODIGO_BRADESCO = "237";

    let inputFile = document.getElementById('cnab400File');
    let warningMessage = document.getElementById('warningMessage');

    clear();

    inputFile.addEventListener('change', function(event) {
        clear();

        let file = inputFile.files[0];

        let fileReader = new FileReader();
        fileReader.onload = function() {
            let banco = null;
            let text = fileReader.result;
            let node = document.getElementById('outputConteudo');
            node.textContent = text;

            let codigoDoBanco = text.substring(76, 79);
            switch (codigoDoBanco) {
                case CODIGO_BANCO_BRASIL:
                    banco = new BancoDoBrasil(text);
                    break;
                case CODIGO_BRADESCO:
                    banco = new Bradesco(text);
                    break;
                default:
                    showWarning(`Ainda não implementamos o banco ${codigoDoBanco}. :( `);
                    break;
            }

            if (Boolean(banco)) {
                drawTableFor(banco.header.campos, 'tableForHeader', true);
            }

            if (Boolean(banco)) {
                banco.detalhes.forEach(function(detalhe, index) {
                    drawTableFor(detalhe.campos, 'tableForDetalhes', index === 0);
                });
            }

        };

        fileReader.readAsText(file);
    });

    function clear() {
        clearWarningMessage();
        clearTables();
    }

    function clearWarningMessage() {
        warningMessage.style.visibility = "hidden";
        warningMessage.textContent = "";
    }


    function clearTables() {
        let tableForHeader = document.getElementById("tableForHeader");
        tableForHeader.querySelector('thead > tr').innerHTML = "";
        tableForHeader.querySelector('tbody').innerHTML = "";

        let tableForDetalhes = document.getElementById("tableForDetalhes");
        tableForDetalhes.querySelector('thead > tr').innerHTML = "";
        tableForDetalhes.querySelector('tbody').innerHTML = "";
    }

    function showWarning(warningText) {
        warningMessage.textContent = warningText;
        warningMessage.style.visibility = "";
    }


    function drawTableFor(campos, targetTable, drawTh) {
        let target = document.getElementById(targetTable);
        let trThead = target.querySelector('thead > tr');
        let tbody = target.querySelector('tbody');
        let tr = document.createElement("tr");

        campos.forEach(function(campo) {
            if (drawTh) {
                let th = document.createElement("th");
                th.textContent = campo.nome;
                trThead.appendChild(th);
            }

            let td = document.createElement("td");
            let divInputField = document.createElement("div");
            divInputField.classList.add("input-field");
            
            let inputField = document.createElement("input");
            inputField.classList.add("form-control");
            inputField.value = campo.conteudo;

            divInputField.appendChild(inputField);
            td.appendChild(divInputField);
            tr.appendChild(td);
        }, this);

        tbody.appendChild(tr);
    }
});

</script>
  </body>
</html>
















