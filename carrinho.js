function lerCarrinho() {
  try {
    return JSON.parse(localStorage.getItem('carrinho')) || [];
  } catch (e) {
    return [];
  }
}

function salvarCarrinho(carrinho) {
  localStorage.setItem('carrinho', JSON.stringify(carrinho));
}

function adicionarAoCarrinho(id) {
  const carrinho = lerCarrinho();
  const item = carrinho.find(i => i.id === id);
  if (item) item.qtd++;
  else carrinho.push({ id: id, qtd: 1 });
  salvarCarrinho(carrinho);
  atualizarContador();
  alert('Jogo adicionado ao carrinho!');
}

function alterarQtd(id, delta) {
  let carrinho = lerCarrinho();
  const item = carrinho.find(i => i.id === id);
  if (!item) return;
  item.qtd += delta;
  if (item.qtd <= 0) carrinho = carrinho.filter(i => i.id !== id);
  salvarCarrinho(carrinho);
  atualizarContador();
  renderizarCarrinho();
}

function removerDoCarrinho(id) {
  salvarCarrinho(lerCarrinho().filter(i => i.id !== id));
  atualizarContador();
  renderizarCarrinho();
}

function finalizarCompra() {
  alert('Compra finalizada! Obrigado por comprar na Server Player.');
  salvarCarrinho([]);
  atualizarContador();
  renderizarCarrinho();
}

function atualizarContador() {
  const total = lerCarrinho().reduce((soma, i) => soma +