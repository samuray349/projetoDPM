<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Animal em Perigo</title>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
    .container { max-width: 1200px; margin: auto; padding: 20px; }
    .animal { background: #fff; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    h2 { color: #2c3e50; }
    .ameaca { display: flex; align-items: center; margin-bottom: 10px; }
    .ameaca i { margin-right: 10px; color: #e74c3c; }
  </style>
</head>
<body>
  <div class="container" id="listaAnimais"></div>

  <script>
    function getAnimalIdFromURL() {
      const params = new URLSearchParams(window.location.search);
      return params.get("id"); // exemplo: ?id=animal1
    }

    const animalId = getAnimalIdFromURL();

    if (animalId) {
      fetch(`https://projetodpm-2d4ee-default-rtdb.firebaseio.com/animais/${animalId}.json`)
        .then(response => response.json())
        .then(animal => {
          const container = document.getElementById("listaAnimais");
          if (!animal) {
            container.innerHTML = "<p>Animal não encontrado.</p>";
            return;
          }

          const div = document.createElement("div");
          div.className = "animal";

          div.innerHTML = `
            <h2>${animal.nome}</h2>
            <p><strong>Comprimento:</strong> ${animal.comprimento}</p>
            <p><strong>Expectativa de vida:</strong> ${animal.expectativa}</p>
            <p><strong>Dieta:</strong> ${animal.dieta}</p>
            <p><strong>Localização:</strong> ${animal.area_ocorrencia.localizacao}</p>
            <p><strong>Habitat:</strong> ${animal.area_ocorrencia.habitat}</p>
            <p><strong>Peso:</strong> Machos: ${animal.peso.machos}, Fêmeas: ${animal.peso.femeas}</p>
            <p><strong>Descrição:</strong> ${animal.descricao.desc_basica}</p>
            <p><strong>Características Físicas:</strong> ${animal.descricao.caracteristicas_fisicas}</p>
            <p><strong>Comportamento:</strong> ${animal.descricao.comportamento}</p>
            <h3>Ameaças à Sobrevivência</h3>
            ${animal.ameacas_sobrevivencia.map(a => `
              <div class="ameaca">
                <i class="fas ${a.icone}"></i><span><strong>${a.titulo}:</strong> ${a.descricao}</span>
              </div>
            `).join('')}
            <h3>Esforços de Conservação</h3>
            <p><strong>Proteção do Habitat:</strong> ${animal.esforcos_conservacao.protecao_habitat}</p>
            <p><strong>Combate à Caça:</strong> ${animal.esforcos_conservacao.combate_caca}</p>
          `;

          container.appendChild(div);
        })
        .catch(error => {
          console.error("Erro ao buscar dados:", error);
          document.getElementById("listaAnimais").innerHTML = "<p>Erro ao carregar os dados.</p>";
        });
    } else {
      document.getElementById("listaAnimais").innerHTML = "<p>ID do animal não fornecido na URL.</p>";
    }
  </script>
</body>
</html>