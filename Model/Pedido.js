class Pedido extends Cliente {
    constructor(
      clienteInfo, // objeto com dados do cliente
      idPedido,
      produtos, // array de objetos Produto
      previsaoRetirada,
      vereditoConfeiteira = "Aguardando",
      statusPedido = "Pendente"
    ) {
      super(
        clienteInfo.nome,
        clienteInfo.endereco,
        clienteInfo.idade,
        clienteInfo.cidade,
        clienteInfo.telefone,
        clienteInfo.cpf,
        clienteInfo.senha
      );
  
      this.id = idPedido;
      this.produtos = produtos;
      this.previsaoRetirada = previsaoRetirada;
      this.vereditoConfeiteira = vereditoConfeiteira;
      this.statusPedido = statusPedido;
    }
  
    calcularTotal() {
      return this.produtos.reduce((total, prod) => total + prod.preco, 0);
    }
  
    atualizarStatus(novoStatus) {
      const validos = ["Pendente", "Em produção", "Pronto", "Cancelado", "Entregue"];
      if (!validos.includes(novoStatus)) {
        throw new Error("Status inválido.");
      }
      this.statusPedido = novoStatus;
    }
  
    exibirResumo() {
      console.log(`Pedido: ${this.id}`);
      console.log(`Cliente: ${this.nome}`);
      console.log("Produtos:");
      this.produtos.forEach((p) => {
        console.log(`- ${p.nome} (R$ ${p.preco.toFixed(2)})`);
      });
      console.log(`Total: R$ ${this.calcularTotal().toFixed(2)}`);
      console.log(`Previsão de retirada: ${this.previsaoRetirada}`);
      console.log(`Veredito da confeiteira: ${this.vereditoConfeiteira}`);
      console.log(`Status do pedido: ${this.statusPedido}`);
    }
  }