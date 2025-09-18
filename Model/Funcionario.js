class Funcionario extends Pessoa {
    constructor(nome, endereco, idade, cidade, telefone, cpf, codfun) {
      super(nome, endereco, idade, cidade, telefone, cpf);
  
      if (!codfun || typeof codfun !== 'string') {
        throw new Error("O código do funcionário (codfun) deve ser uma string válida.");
      }
  
      this.codfun = codfun;
    }
  
    // Método para salvar funcionário no "banco de dados" localStorage
    salvar() {
      const funcionarios = JSON.parse(localStorage.getItem('funcionarios')) || [];
  
      // Impede duplicidade de CPF ou codfun
      const jaExiste = funcionarios.some(
        f => f.cpf === this.cpf || f.codfun === this.codfun
      );
      if (jaExiste) {
        console.warn("Funcionário com este CPF ou código já cadastrado.");
        return false;
      }
  
      funcionarios.push({
        codfun: this.codfun,
        nome: this.nome,
        endereco: this.endereco,
        idade: this.idade,
        cidade: this.cidade,
        telefone: this.telefone,
        cpf: this.cpf
      });
  
      localStorage.setItem('funcionarios', JSON.stringify(funcionarios));
      console.log("Funcionário salvo com sucesso.");
      return true;
    }
  }
  