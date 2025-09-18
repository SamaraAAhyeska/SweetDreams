// Classe abstrata Pessoa
class Pessoa {
    constructor(nome, endereco, idade, cidade, telefone, cpf) {
      if (new.target === Pessoa) {
        throw new Error("Classe abstrata não pode ser instanciada diretamente.");
      }
  
      this.nome = nome;
      this.endereco = endereco;
      this.idade = idade;
      this.cidade = cidade;
      this.telefone = telefone;
      this.cpf = cpf;
    }
  
    // Método para simular login validando no "banco" (localStorage)
    static fazerLogin(nome, cpf) {
      const pessoas = JSON.parse(localStorage.getItem('pessoas')) || [];
      const encontrada = pessoas.find(p => p.nome === nome && p.cpf === cpf);
      
      if (encontrada) {
        console.log("Login bem-sucedido:", encontrada);
        return true;
      } else {
        console.warn("Login inválido.");
        return false;
      }
    }
  
    // Método para editar dados da pessoa (por CPF) e salvar no "banco"
    static editarDados(cpf, novosDados) {
      const pessoas = JSON.parse(localStorage.getItem('pessoas')) || [];
      const index = pessoas.findIndex(p => p.cpf === cpf);
      
      if (index !== -1) {
        pessoas[index] = { ...pessoas[index], ...novosDados };
        localStorage.setItem('pessoas', JSON.stringify(pessoas));
        console.log("Dados atualizados:", pessoas[index]);
        return true;
      } else {
        console.warn("Pessoa não encontrada.");
        return false;
      }
    }
  }
 //o login é uma função baseado no banco de dados como validação, então não terá uma classe login//
  

