<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Finalizar Pedido</title>
</head>
<body>

<h2>Finalizar Pedido</h2>

<form id="formPedido" method="POST" action="../Controller/CadastrarPed.php">

    <!-- Campo oculto que recebe o CARRINHO -->
    <input type="hidden" name="produtos" id="produtos">

    <label>Cliente:</label>
    <input type="text" name="nome_cliente" required><br><br>

    <label>ID do Cliente:</label>
    <input type="number" name="id_cliente" required><br><br>

    <label>Previsão de Retirada:</label>
    <input type="date" name="previsao_retirada" required><br><br>

    <label>Confeiteira:</label>
    <input type="number" name="id_confeiteira"><br><br>

    <label>Veredito da Confeiteira:</label>
    <input type="text" name="veredito_confeiteira"><br><br>

    <label>Status:</label>
    <input type="text" name="status" value="Aguardando" required><br><br>

    <label>Valor Total:</label>
    <input type="text" name="valor" id="valor_total" readonly><br><br>

    <button type="submit" name="enviar">Enviar Pedido</button>
</form>

<script>
// Carrega o carrinho salvo na loja
const carrinho = JSON.parse(localStorage.getItem("carrinho")) || {};

// Calcula o total do pedido
let total = 0;
Object.values(carrinho).forEach(item => {
    total += item.quantidade * item.preco;
});

// Define valor total no input (visível apenas para leitura)
document.getElementById("valor_total").value = total.toFixed(2).replace('.', ',');

// Antes de enviar, joga o carrinho dentro do campo hidden "produtos"
document.getElementById("formPedido").onsubmit = () => {

    // envia como JSON string
    document.getElementById("produtos").value = JSON.stringify(carrinho);

    // limpa carrinho para cliente
    localStorage.removeItem("carrinho");
};
</script>

</body>
</html>
