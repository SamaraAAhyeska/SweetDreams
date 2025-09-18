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
  
    salvar() {
      const produtos = JSON.parse(localStorage.getItem('produtos')) || [];
  
      // Verifica se o ID já existe
      const existe = produtos.some(p => p.id === this.id);
      if (existe) {
        console.warn("Já existe um produto com este ID.");
        return false;
      }
  
      produtos.push({
        id: this.id,
        nome: this.nome,
        descricao: this.descricao,
        preco: this.preco
      });
  
      localStorage.setItem('produtos', JSON.stringify(produtos));
      console.log("Produto salvo com sucesso.");
      return true;
    }
  
    static listarTodos() {
      return JSON.parse(localStorage.getItem('produtos')) || [];
    }
  
    static editar(id, novosDados) {
      const produtos = JSON.parse(localStorage.getItem('produtos')) || [];
      const index = produtos.findIndex(p => p.id === id);
  
      if (index === -1) {
        console.warn("Produto não encontrado.");
        return false;
      }
  
      produtos[index] = { ...produtos[index], ...novosDados };
      localStorage.setItem('produtos', JSON.stringify(produtos));
      console.log("Produto editado com sucesso.");
      return true;
    }
  
    static excluir(id) {
      let produtos = JSON.parse(localStorage.getItem('produtos')) || [];
      const novoArray = produtos.filter(p => p.id !== id);
  
      if (produtos.length === novoArray.length) {
        console.warn("Produto não encontrado para exclusão.");
        return false;
      }
  
      localStorage.setItem('produtos', JSON.stringify(novoArray));
      console.log("Produto excluído com sucesso.");
      return true;
    }
  }
  