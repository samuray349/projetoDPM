function carregarMenu() {
		fetch('header.html')
			.then(response => {
			if (!response.ok) {
				throw new Error('Não foi possível carregar o ficheiro: ' + response.status);
			}
			return response.text();
			})
			.then(html => {
			const container = document.getElementById('header1');
			container.innerHTML = html;
			})
			.catch(error => {
			const container = document.getElementById('header1');
			container.innerHTML = `<p style="color: red;">Erro ao carregar conteúdo: ${error.message}</p>`;
			console.error(error);
			});
}

function carregarFooter() {
		fetch('footer.html')
			.then(response => {
			if (!response.ok) {
				throw new Error('Não foi possível carregar o ficheiro: ' + response.status);
			}
			return response.text();
			})
			.then(html => {
			const container = document.getElementById('footer1');
			container.innerHTML = html;
			})
			.catch(error => {
			const container = document.getElementById('footer1');
			container.innerHTML = `<p style="color: red;">Erro ao carregar conteúdo: ${error.message}</p>`;
			console.error(error);
			});
}