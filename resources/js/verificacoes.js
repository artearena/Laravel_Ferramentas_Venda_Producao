function verificarExcecao(altura, largura, face) {
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
      return null; // Nenhuma correspondência encontrada
    }
  }