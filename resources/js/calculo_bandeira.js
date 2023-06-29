// Função para calcular o valor da bandeira
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
      alert("Valor tabelado aplicado!");
      excecao = 'R$ ' + excecao;
      return excecao;
    }
  }
  