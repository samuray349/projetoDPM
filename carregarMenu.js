function carregarMenu() {
		fetch('header.html')
			.then(response => {
			if (!response.ok) {
				throw new Error('Não foi possível carregar o ficheiro: ' + response.status);
			}
			return response.text();
			})
			.then(html => {
			const container = document.getElementById('header');
			container.innerHTML = html;
			})
			.catch(error => {
			const container = document.getElementById('header');
			container.innerHTML = `<p style="color: red;">Erro ao carregar conteúdo: ${error.message}</p>`;
			console.error(error);
			});
}

  const toggleBtn = document.querySelector('.menu-toggle');
  const navMenu = document.querySelector('.menu-nao-flex');

  toggleBtn.addEventListener('click', () => {
    navMenu.classList.toggle('active');
  });
