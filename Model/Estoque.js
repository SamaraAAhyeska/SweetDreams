class Produto {
    constructor(id, nome, descricao, preco) {
      if (!id || !nome || !descricao || typeof preco !== "number") {
        throw new Error("Dados inválidos para o produto.");
      }
  
      this.id = id;
      this.nome = nome;
      this.descricao = descricao;
      this.preco = preco;
    }
  }
  
  class Estoque extends Produto {
    constructor(id, nome, descricao, preco, quantidade) {
      super(id, nome, descricao, preco);
      if (typeof quantidade !== "number" || quantidade < 0) {
        throw new Error("Quantidade inválida.");
      }
      this.quantidade = quantidade;
    }
  
    adicionarProduto() {
      const estoque = JSON.parse(localStorage.getItem('estoque')) || [];
  
      const existente = estoque.find(p => p.id === this.id);
  
      if (existente) {
        existente.quantidade += this.quantidade;
      } else {
        estoque.push({
          id: this.id,
          nome: this.nome,
          descricao: this.descricao,
          preco: this.preco,
          quantidade: this.quantidade
        });
      }
  
      localStorage.setItem('estoque', JSON.stringify(estoque));
      console.log("Produto adicionado ao estoque.");
    }
  
    static excluirProduto(id) {
      let estoque = JSON.parse(localStorage.getItem('estoque')) || [];
      const novoEstoque = estoque.filter(p => p.id !== id);
  
      if (novoEstoque.length === estoque.length) {
        console.warn("Produto não encontrado para exclusão.");
        return false;
      }
  
      localStorage.setItem('estoque', JSON.stringify(novoEstoque));
      console.log("Produto excluído do estoque.");
      return true;
    }
  
    static listarProdutos() {
      const estoque = JSON.parse(localStorage.getItem('estoque')) || [];
      console.table(estoque.map(p => ({
        ID: p.id,
        Nome: p.nome,
        Quantidade: p.quantidade
      })));
      return estoque;
    }
  
    static notificarFalta() {
      const estoque = JSON.parse(localStorage.getItem('estoque')) || [];
      const produtosEmFalta = estoque.filter(p => p.quantidade < 3);
  
      if (produtosEmFalta.length === 0) {
        console.log("Todos os produtos estão com estoque adequado.");
      } else {
        console.warn("Produtos com estoque abaixo de 3 unidades:");
        produtosEmFalta.forEach(p => {
          console.warn(`⚠️ ${p.nome} (ID: ${p.id}) - ${p.quantidade} unidades`);
        });
      }
    }
  }
  