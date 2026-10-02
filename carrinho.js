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
  const total = lerCarrinho().reduce((soma, i) => soma + i.qtd, 0);
  const el = document.getElementById('contador-carrinho');
  if (el) el.textContent = total;
}

function renderizarCarrinho() {
  const lista = document.getElementById('lista-carrinho');
  const totalEl = document.getElementById('total');
  if (!lista) return;

  const carrinho = lerCarrinho();
  if (carrinho.length === 0) {
    lista.innerHTML = '<p class="vazio">Seu carrinho está vazio.</p>';
    totalEl.textContent = 'R$ 0,00';
    return;
  }

  let total = 0;
  lista.innerHTML = carrinho.map(item => {
    const jogo = jogos.find(j => j.id === item.id);
    if (!jogo) return '';
    const subtotal = jogo.preco * item.qtd;
    total += subtotal;
    return `
      <div class="item">
        <img src="${jogo.img}" alt="${jogo.nome}">
        <div class="info">
          <h3>${jogo.nome}</h3>
          <p>R$ ${jogo.preco.toFixed(2).replace('.', ',')}</p>
        </div>
        <div class="qtd">
          <button onclick="alterarQtd(${jogo.id}, -1)">-</button>
          <span>${item.qtd}</span>
          <button onclick="alterarQtd(${jogo.id}, 1)">+</button>
        </div>
        <strong>R$ ${subtotal.toFixed(2).replace('.', ',')}</strong>
        <button class="remover" onclick="removerDoCarrinho(${jogo.id})">Remover</button>
      </div>`;
  }).join('');

  totalEl.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
}

document.addEventListener('DOMContentLoaded', function () {
  atualizarContador();
  renderizarCarrinho();
});