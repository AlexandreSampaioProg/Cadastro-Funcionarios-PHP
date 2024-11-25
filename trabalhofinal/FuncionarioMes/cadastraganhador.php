<?php
//Recebe o metodo phost quando o cliente aperta o botão e o php recebe os valores
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $func = $_POST["func"]; //recebe o funcionario escolhido
    $valor = $_POST["valor"]; //recebe o valor de vendas dele

    

    // Imprime o valor  e o fucionario
    echo "Valor recebido: " . $valor;
    echo "<br><br>"; 
    echo "Funcionario: " . $func;

        // Verifica se um arquivo foi enviado
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

            // Recebe informações do arquivo
            $nomeArquivo = $_FILES['foto']['name'];
            $tipoArquivo = $_FILES['foto']['type'];
            $tamanhoArquivo = $_FILES['foto']['size'];
            $tmpNome = $_FILES['foto']['tmp_name'];
    
            // Definir um diretório temporario para a imgaem
            $diretorio = 'C:/xampp/htdocs/trabalhofinal/FuncionarioMes/img/';
            if (!is_dir($diretorio)) {
                mkdir($diretorio, 0777, true); //permição para evitar erros
            }
    
            // Chama o arquivo salvo para imprimir na tela e salva permanentemente o aquivo na pasta (deixa de ser temporario)
            $caminhoCompleto = $diretorio . basename($nomeArquivo);
            if (move_uploaded_file($tmpNome, $caminhoCompleto)) { 
                echo "<br><br>Imagem enviada com sucesso!<br>";
                echo "Visualizar imagem:<br>";
                echo "<img src='/trabalhofinal/FuncionarioMes/img/" . $nomeArquivo . "' alt='Imagem enviada' style='max-width: 300px;'> <br><br>"; //chamada de caminho para imprimir a img na tela o caminho não é completo para servir no html caminho total da imagem não funciona ao transferir para HTML 
            } else {
                echo "Erro ao mover o arquivo. <br><br>";
            }
        } else {
            echo "Erro ao enviar a imagem. <br><br>";
        }

        //Logica para calcular o bônus
            function calcularBonus($valor) {
            if ($valor < 500) {
                $bonus = $valor * 0.01; // 1%
            } elseif ($valor <= 3000) {
                $bonus = $valor * 0.05; // 5%
            } elseif ($valor <= 10000) {
                $bonus = $valor * 0.10; // 10%
            } else {
                $bonus = $valor * 0.15; // 15%
            }
              return $bonus;
        }
              $bonus = calcularBonus($valor); // definindo a variavel para poder ser impressa na tela  
              echo "Seu bonus: " . $bonus . "<br><br>";  

                $mes = strftime("%B", time()); // Resgata o mes por extenso
                echo "O mês atual é: $mes<br>";

                $ano = date("Y"); // Resgata o ano atual
                echo "O ano atual é: $ano<br>";
            

                // Conexão com o banco de dados
                $servername = "localhost"; // Host do banco
                $username = "root";        // Usuário do banco
                $password = "";            // Senha do banco
                $dbname = "dbempresa";     // Nome do banco de dados    

                // Cria a conexão
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verifica a conexão
                if ($conn->connect_error) {
                    die("Falha na conexão: " . $conn->connect_error . "<br><br>");
                }else {
                    echo("<br><br> conexão bem feita <br><br>");
                }

                // Comando SQL para inserir os dados
                $sql = "INSERT INTO tbfuncmes (nome, vrvenda, vrbonus, caminhoimg, mes, ano)
                VALUES ('$func', $valor, $bonus, '$caminhoCompleto', '$mes', $ano)";

                // Executa o comando SQL
                if ($conn->query($sql) === TRUE) {
                    echo "Novo registro inserido com sucesso!";
                } else {
                    echo "Erro ao inserir o registro: " . $conn->error;
                }

                $conn->close();

                echo "Você será redirecionado em 35 segundos...";
}
?>

<meta http-equiv="refresh" content="35;url=cadastro.php"> //volta para a pagina em 35seg