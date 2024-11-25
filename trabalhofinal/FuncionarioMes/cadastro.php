<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/estilo.css">
 
        
        <script>

          function Carrega(campo) {
            if (campo.files && campo.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("ganhador").src = e.target.result;
                };       
                file.readAsDataURL(campo.files[0]);
            }
            document.getElementById("foto").addEventListener("change", readImage, false);
        }

        function selecao(frm){
                    var func = document.getElementById("func").value;
                    var valor = document.getElementById("valor").value;
                    var foto = document.getElementById("foto").value

                              
                    if(func == "Escolha um Funcionário")
                    {
                        alert('Escolha o Funcionário');
                        document.getElementById("func").focus();
                        return false;
                    }
                    if(valor == "")
                    {
                        alert('Escolha o valor');
                         return false;
                    }

                     if (foto  == "")
                    {
                        alert("É Obrigatório Anexar uma Foto!" ); 
                        return false;
                    }
                    



                    frm.submit();
          }

          function mascara(o,f){
                v_obj=o
                v_fun=f
                setTimeout("execmascara()",1)
                }

                function execmascara(){
                v_obj.value=v_fun(v_obj.value)
                }


                function moeda(v){
                v=v.replace(/\D/g,"") // permite digitar apenas numero
                //  v=v.replace(/(\d{1})(\d{10})$/,"$1.$2") // coloca ponto antes dos ultimos 13 digitos
                //v=v.replace(/(\d{1})(\d{8})$/,"$1.$2") // coloca ponto antes dos ultimos 10 digitos
                //v=v.replace(/(\d{1})(\d{5})$/,"$1.$2") // coloca ponto antes dos ultimos 7 digitos
                v=v.replace(/(\d{1})(\d{1,2})$/,"$1.$2") // coloca virgula antes dos ultimos 2 digitos
                return v;
          }


          function Sortear()
            {
                var sorteio = 0;
                var pessoas = document.getElementById("func");    
                var quant = pessoas.options.length;
                quant = quant -1;
              
                min = Math.ceil(1);
                max = Math.floor(quant);
                sorteio = Math.floor(Math.random() * (max - min + 1 )) + min;
                var func = document.getElementById("func");
                func.selectedIndex = sorteio;
                                        
            }
            
        </script>

    </head>
        <body>
        <div class="container">
          <br>
         <button> <a href="javascript: history.back()">Voltar </a> </button>
         <h2>CADASTRO</h2>
         <br>
        
          <form method="POST" id="form1" name="form1" action="cadastraganhador.php" enctype="multipart/form-data" onSubmit="selecao(this); return false;" >  

        <div class="row"> 
            <div class="col-lg-5 mx-auto">
                                               
               <center> <img src="img/moldura.png"  name="ganhador" id="ganhador" class="img-fluid" class="rounded float-left" alt="Ganhador" width="60%" height="60%"> <br> <br> 
                                                            
               <div class="file-field input-field col s8">
                    <div class="btn btn-primary btn-sm">
                        <input type="file" name="foto" id="foto" accept=".png,.jpg " class="form-control" onchange="Carrega(this)">
                    </div>     
               </div>
               </center>
               <br>
                                  
                                                  
           </div>
                                                    
                                              
           <div class="col-lg-7 mx-auto">
           <div class="form-group">
              <b>Escolha o Funcionário do Mês:</b> 
              <select class="form-control w-50" id="func" name="func"  placeholder="Funcionario Mês:" required="required" data-validation-required-message="Por favor escolha uma opção">
                <option value="Escolha um Funcionário"><<< Escolha um Funcionário >>></option>
                <option value="Ana Andrade">Ana Andrade</option>
                <option value="Bruna Costa">Bruna Costa</option>
                <option value="Carlos Montreal">Carlos Montreal</option>
                <option value="João Freitas">João Freitas</option>
                <option value="Paulo Santos">Paulo Santos</option>
                <option value="Rita Passaros">Rita Passaros</option>
              </select>
           <br><br>

           <button class="btn btn-primary btn-sm" id="sortear" name="sortear" onclick="Sortear()"  type="button">SORTEAR FUNCIONÁRIO </button>
           <br><br>

           <div class="form-text">
            <b>Digite o valor de Vendas do Mês:</b>
            <input type="text" class="form-control w-25" id="valor" name="valor"  placeholder="Valor Vendas" required="required" data-validation-required-message="Por favor digite o valor de venda"  onkeypress="mascara(this, moeda)" maxlength="10">
         </div>

         <br><br>

         <button class="btn btn-primary btn-xl" id="enviar" name="enviar" type="submit">Cadastrar</button>

           </div>
           </div>
          </form>
          </div>
                        
    </body>
                
   
</html>




    
</body>
</html>