const REGISTRO_HEADER_BRADESCO = "0";
const REGISTRO_DETALHE_BRADESCO = "1";

class Bradesco {
    constructor(fileContent) {
        this.linhas = fileContent.split('\n');
        this.campos = [];
        this.header = new Header();
        this.detalhes = [];
        this.deserialize();
    }

    deserialize() {
        this.linhas.forEach(function(linha) {
            let tipoDeRegistro = linha.substring(0,1);
            switch (tipoDeRegistro) {
                case REGISTRO_HEADER_BRADESCO:
                    let posicao = linha.substring(394, 400);
                    this.header.campos.push(new Campo("Identificação do Registro", linha.substring(0, 1)));
                    //this.header.campos.push(new Campo("Identificação do Arquivo Retorno", linha.substring(1, 2)));
                    //this.header.campos.push(new Campo("Literal Retorno", linha.substring(2, 9)));
                    //this.header.campos.push(new Campo("Código do Serviço", linha.substring(9, 11)));
                    //this.header.campos.push(new Campo("Literal Serviço", linha.substring(11, 26)));
                    this.header.campos.push(new Campo("Código da Empresa", linha.substring(26, 46)));
                    this.header.campos.push(new Campo("Nome da Empresa por Extenso", linha.substring(46, 76)));
                    this.header.campos.push(new Campo("Nº do Bradesco na Câmara Compensação", linha.substring(76, 79)));
                    this.header.campos.push(new Campo("Nome do Banco por Extenso", linha.substring(79, 94)));
                    this.header.campos.push(new Campo("Data da Gravação do Arquivo", linha.substring(94, 100)));
                    //this.header.campos.push(new Campo("Densidade de Gravação", linha.substring(100, 108)));
                    this.header.campos.push(new Campo("Nº Aviso Bancário", linha.substring(108, 113)));
                    //this.header.campos.push(new Campo("Branco", linha.substring(113, 379)));
                    this.header.campos.push(new Campo("Data do Crédito", linha.substring(379, 385)));
                    //this.header.campos.push(new Campo("Branco", linha.substring(385, 394)));
                    //this.header.campos.push(new Campo("Nr. Seqüencial do registro", posicao));
                    break;
                case REGISTRO_DETALHE_BRADESCO:
                    this.detalhes.push(new Detalhe(linha));
                    break;
                default:
                    break;
            }
        }, this);
    }
}

class Campo {
    constructor(nome, conteudo) {
        this.nome = nome;
        this.conteudo = conteudo;
    }
}

class Header {
    constructor() {
        this.campos = [];
    }
}

class Detalhe {
    constructor(linha) {
        this.campos = [];
        //this.campos.push(new Campo("Identificação do Registro", linha.substring(0, 1)));
        //this.campos.push(new Campo("Tipo de Inscrição Empresa", linha.substring(1, 3)));
        //this.campos.push(new Campo("Nº Inscrição da Empresa", linha.substring(3, 17)));
        //this.campos.push(new Campo("Zeros", linha.substring(17, 20)));
        //this.campos.push(new Campo("Identificação da Empresa Beneficiário no Banco", linha.substring(20, 37)));
        //this.campos.push(new Campo("Nº Controle do Participante", linha.substring(37, 62)));
        //this.campos.push(new Campo("Zeros", linha.substring(62, 70)));
        this.campos.push(new Campo("Identificação do Título no Banco", linha.substring(70, 82)));
        //this.campos.push(new Campo("Uso do Banco", linha.substring(82, 92)));
        //this.campos.push(new Campo("Uso do Banco", linha.substring(92, 104)));
        //this.campos.push(new Campo("Indicador de Rateio Crédito", linha.substring(104, 105)));
        //this.campos.push(new Campo("Pagamento parcial", linha.substring(105, 107)));
        this.campos.push(new Campo("Carteira", linha.substring(107, 108)));
        this.campos.push(new Campo("Identificação de Ocorrência", linha.substring(108, 110)));
        this.campos.push(new Campo("Data Ocorrência no Banco", linha.substring(110, 116)));
        this.campos.push(new Campo("Número do Documento", linha.substring(116, 126)));
        this.campos.push(new Campo("Identificação do Título no Banco", linha.substring(126, 146)));
        this.campos.push(new Campo("Data Vencimento do Título", linha.substring(146, 152)));
        this.campos.push(new Campo("Valor do Título", linha.substring(152, 165)));
        this.campos.push(new Campo("Banco Cobrador", linha.substring(165, 168)));
        this.campos.push(new Campo("Agência Cobradora", linha.substring(168, 173)));
        //this.campos.push(new Campo("Espécie do Título", linha.substring(173, 175)));
        this.campos.push(new Campo("Despesas de cobrança para os Códigos de Ocorrência | 02 - Entradas Confirmadas | 28 - Débitos de Tarifas", linha.substring(175, 188)));
        //this.campos.push(new Campo("Outras despesas Custas de Protesto", linha.substring(188, 201)));
        //this.campos.push(new Campo("Juros Operação em Atraso", linha.substring(201, 214)));
        //this.campos.push(new Campo("IOF Devido", linha.substring(214, 227)));
        //this.campos.push(new Campo("Abatimento Concedido sobre o Título", linha.substring(227, 240)));
        //this.campos.push(new Campo("Desconto Concedido", linha.substring(240, 253)));
        this.campos.push(new Campo("Valor Pago", linha.substring(254, 266)));
        //this.campos.push(new Campo("Juros de Mora", linha.substring(266, 279)));
        //this.campos.push(new Campo("Outros Créditos", linha.substring(279, 292)));
        //this.campos.push(new Campo("Brancos", linha.substring(292, 294)));
        //this.campos.push(new Campo("Motivo do Código de Ocorrência 25 (Confirmação de Instrução de Protesto Falimentar e (Do Código de Ocorrência 19 Confirmação de Instrução de Protesto)", linha.substring(294, 295)));
        this.campos.push(new Campo("Data do Crédito", linha.substring(295, 301)));
        this.campos.push(new Campo("Origem Pagamento", linha.substring(301, 304)));
        //this.campos.push(new Campo("Brancos", linha.substring(304, 314)));
        //this.campos.push(new Campo("Quando cheque Bradesco informe 0237", linha.substring(314, 318)));
        this.campos.push(new Campo("Motivos das Rejeições para os Códigos de Ocorrência da Posição 109 a 110", linha.substring(318, 328)));
        //this.campos.push(new Campo("Brancos", linha.substring(328, 368)));
        //this.campos.push(new Campo("Número do Cartório", linha.substring(368, 370)));
        this.campos.push(new Campo("Número do Protocolo", linha.substring(370, 380)));
        //this.campos.push(new Campo("Brancos", linha.substring(380, 394)));
        //this.campos.push(new Campo("Nº Seqüencial de Registro", linha.substring(394, 400)));
        
    }
}
