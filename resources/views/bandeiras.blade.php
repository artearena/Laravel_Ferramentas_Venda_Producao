<!DOCTYPE html>
<html>
<head>
  <title>Calculadora de Bandeiras</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    #navbar {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="{{ route('bandeiras') }}" class="btn btn-outline-success">Calculadora de Bandeira</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}" class="btn btn-outline-success">Cálculo de Frete</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <h1 class="mt-4">Calculadora de Bandeiras</h1>
    
    <div class="row mt-4">
      <div class="col-md-6">
        <div class="form-group">
          <label for="altura">Altura (cm):</label>
          <input type="text" class="form-control" id="altura" name="altura">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="largura">Largura (cm):</label>
          <input type="text" class="form-control" id="largura" name="largura">
        </div>
      </div>
    </div>
    
    <div class="text-center">
      <button type="button" class="btn btn-primary" onclick="calcular()">Calcular</button>
    </div>
    
    <div class="mt-4">
      <h5>Resultados:</h5>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="valorMinimoPessoalSimples">Valor Mínimo Pessoal Simples:</label>
            <div class="input-group">
              <input type="text" class="form-control" id="valorMinimoPessoalSimples" readonly>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="copiarValor('valorMinimoPessoalSimples')">Copiar</button>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="valorNormalPessoalSimples">Valor Normal Pessoal Simples:</label>
            <div class="input-group">
              <input type="text" class="form-control" id="valorNormalPessoalSimples" readonly>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="copiarValor('valorNormalPessoalSimples')">Copiar</button>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="valorMinimoPessoalDupla">Valor Mínimo Pessoal Dupla:</label>
            <div class="input-group">
              <input type="text" class="form-control" id="valorMinimoPessoalDupla" readonly>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="copiarValor('valorMinimoPessoalDupla')">Copiar</button>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="valorNormalPessoalDupla">Valor Normal Pessoal Dupla:</label>
            <div class="input-group">
              <input type="text" class="form-control" id="valorNormalPessoalDupla" readonly>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="copiarValor('valorNormalPessoalDupla')">Copiar</button>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <label for="valorMinimoEmpresarialSimples">Valor Mínimo Empresarial Simples:</label>
            <div class="input-group">
              <input type="text" class="form-control" id="valorMinimoEmpresarialSimples" readonly>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="copiarValor('valorMinimoEmpresarialSimples')">Copiar</button>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="valorNormalEmpresarialSimples">Valor Normal Empresarial Simples:</label>
            <div class="input-group">
              <input type="text" class="form-control" id="valorNormalEmpresarialSimples" readonly>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="copiarValor('valorNormalEmpresarialSimples')">Copiar</button>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="valorMinimoEmpresarialDupla">Valor Mínimo Empresarial Dupla:</label>
            <div class="input-group">
              <input type="text" class="form-control" id="valorMinimoEmpresarialDupla" readonly>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="copiarValor('valorMinimoEmpresarialDupla')">Copiar</button>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="valorNormalEmpresarialDupla">Valor Normal Empresarial Dupla:</label>
            <div class="input-group">
              <input type="text" class="form-control" id="valorNormalEmpresarialDupla" readonly>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="copiarValor('valorNormalEmpresarialDupla')">Copiar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div id="alerta" style="display: none; background-color: red; color: white;" class="alert">
        <strong>Atenção:</strong> Valor tabelado aplicado!
    </div>
  </div>
  
  <script>
    function copiarValor(inputId) {
      let input = document.getElementById(inputId);
      let valor = input.value;

      // Identificar se é uma face simples ou dupla
      let tipoFace;
      if (inputId.endsWith('Dupla')) {
        tipoFace = 'Faces: Dupla';
      } else {
        tipoFace = 'Faces: Uma';
      }

      // Acrescentar a informação sobre a face no valor copiado
      let valorCopiado = '1 un - Bandeira Personalizada - 1 x 1 - ' + tipoFace + ' - ' + valor;

      // Copiar o valor modificado para a área de transferência
      navigator.clipboard.writeText(valorCopiado);

      // Exibir uma mensagem de sucesso
      alert('Valor copiado com sucesso: ' + valorCopiado);
    }

    function calcular() {
      var altura = parseFloat(document.getElementById('altura').value);
      var largura = parseFloat(document.getElementById('largura').value);
      
      if (isNaN(altura) || isNaN(largura)) {
        alert('Por favor, insira valores numéricos válidos para altura e largura.');
        return;
      }

      var valorNormalPessoalSimples = calcular_valor_bandeira(altura, largura, 'normal', 'pessoal', 'simples');
      var valorNormalEmpresarialSimples = calcular_valor_bandeira(altura, largura, 'normal', 'empresarial', 'simples');
      var valorNormalPessoalDupla = calcular_valor_bandeira(altura, largura, 'normal', 'pessoal', 'dupla');
      var valorNormalEmpresarialDupla = calcular_valor_bandeira(altura, largura, 'normal', 'empresarial', 'dupla');
      
      var valorMinimoPessoalSimples = calcular_valor_bandeira(altura, largura, 'mínimo', 'pessoal', 'simples');
      var valorMinimoEmpresarialSimples = calcular_valor_bandeira(altura, largura, 'mínimo', 'empresarial', 'simples');
      var valorMinimoPessoalDupla = calcular_valor_bandeira(altura, largura, 'mínimo', 'pessoal', 'dupla');
      var valorMinimoEmpresarialDupla = calcular_valor_bandeira(altura, largura, 'mínimo', 'empresarial', 'dupla');
      
      document.getElementById('valorNormalPessoalSimples').value = valorNormalPessoalSimples;
      document.getElementById('valorNormalEmpresarialSimples').value = valorNormalEmpresarialSimples;
      document.getElementById('valorNormalPessoalDupla').value = valorNormalPessoalDupla;
      document.getElementById('valorNormalEmpresarialDupla').value = valorNormalEmpresarialDupla;
      
      document.getElementById('valorMinimoPessoalSimples').value = valorMinimoPessoalSimples;
      document.getElementById('valorMinimoEmpresarialSimples').value = valorMinimoEmpresarialSimples;
      document.getElementById('valorMinimoPessoalDupla').value = valorMinimoPessoalDupla;
      document.getElementById('valorMinimoEmpresarialDupla').value = valorMinimoEmpresarialDupla;
    }
    
    function calcular_valor_bandeira(altura, largura, tipoVenda, tipoCliente, tipoFace) {
      // Legenda:
      // - tipoFace: "simples" (face única), "dupla" (face dupla)
      // - tipoCliente: "pessoal", "empresarial"
      // - tipoVenda: "normal", "mínima"
    
      let resultado;
      let fator;
      let excecao;
      const ALTURA_MAXIMA = 99999;
      const LARGURA_MAXIMA = 99999;
      const FATOR_NORMAL_PESSOAL = 31;
      const FATOR_NORMAL_EMPRESARIAL = 26;
      const FATOR_MINIMO_PESSOAL = 24;
      const FATOR_MINIMO_EMPRESARIAL = 22;
    
      let alturaMetros = altura / 100;
      let larguraMetros = largura / 100;
    
      excecao = verificarExcecao(alturaMetros, larguraMetros, tipoFace === 'simples' ? 1 : 2);
    
      if (excecao === null || tipoCliente === 'empresarial') {
        if (alturaMetros <= 0 || alturaMetros > ALTURA_MAXIMA) {
          return 'Altura inválida';
        }
    
        if (larguraMetros <= 0 || larguraMetros > LARGURA_MAXIMA) {
          return 'Largura inválida';
        }
    
        if (tipoVenda === 'normal') {
          if (tipoCliente === 'pessoal') {
            fator = FATOR_NORMAL_PESSOAL;
          } else {
            fator = FATOR_NORMAL_EMPRESARIAL;
          }
        } else {
          if (tipoCliente === 'pessoal') {
            fator = FATOR_MINIMO_PESSOAL;
          } else {
            fator = FATOR_MINIMO_EMPRESARIAL;
          }
        }
    
        if (tipoFace === 'dupla') {
          fator *= 2;
        } else if (tipoFace !== 'simples' && tipoFace !== null) {
          return 'Face inválida';
        }
    
        try {
          resultado = 'R$ ' + ((alturaMetros * larguraMetros) * fator).toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          });
        } catch (error) {
          resultado = 'Valor inválido';
        }

        return resultado;
      } else {
        let alerta = document.getElementById('alerta');
        alerta.innerHTML = 'Atenção: Valor tabelado aplicado!';
        alerta.style.display = 'block';

        excecao = 'R$ ' + excecao;

        return excecao;
      }
    } 
    
    function verificarExcecao(altura, largura, face) 
    {
      var medidas = altura + "x" + largura;
      
      if (medidas === "1.5x1") {
        return face === 1 ? 80 : 160;
      } else if (medidas === "1.5x2") {
        return face === 1 ? 140 : 280;
      } else if (medidas === "2x2") {
        return face === 1 ? 200 : 400;
      } else if (medidas === "2x3") {
        return face === 1 ? 230 : 460;
      } else if (medidas === "3x3") {
        return face === 1 ? 290 : 580;
      } else if (medidas === "3x4") {
        return face === 1 ? 390 : 780;
      } else if (medidas === "4x4") {
        return face === 1 ? 540 : 1080;
      } else if (medidas === "4.5x5") {
        return face === 1 ? 640 : 1280;
      } else if (medidas === "5x6") {
        return face === 1 ? 890 : 1780;
      }  else if (medidas === "6x6") {
        return face === 1 ? 1080 : 2160;
      } else if (medidas === "6x8") {
        return face === 1 ? 1440 : 2880;
      } else if (medidas === "10x10") {
        return face === 1 ? 3140 : 6280;
      } else if (medidas === "10x12") {
        return face === 1 ? 3780 : 7560;
      } else if (medidas === "1.5x3") {
        return face === 1 ? 170 : 340;
      } else if (medidas === "1.5x4") {
        return face === 1 ? 210 : 420;
      } else if (medidas === "1.5x5") {
        return face === 1 ? 240 : 480;
      } else if (medidas === "1.5x6") {
        return face === 1 ? 280 : 560;
      } else if (medidas === "1.5x8") {
        return face === 1 ? 360 : 720;
      } else if (medidas === "1.5x10") {
        return face === 1 ? 460 : 920;
      } else if (medidas === "1.5x12") {
        return face === 1 ? 540 : 1080;
      } else if (medidas === "1.5x15") {
        return face === 1 ? 680 : 1360;
      } else if (medidas === "1.5x20") {
        return face === 1 ? 890 : 1780;
      } else if (medidas === "3x10") {
        return face === 1 ? 990 : 1980;
      } else if (medidas === "1.5x30") {
        return face === 1 ? 1340 : 2680;
      } else if (medidas === "1.5x40") {
        return face === 1 ? 1790 : 3580;
      } else if (medidas === "1.5x50") {
        return face === 1 ? 2240 : 4480;
      } else {
        alerta.style.display = 'none';
        return null; // Nenhuma correspondência encontrada
      }
    } 
  </script>
</body>
</html>
