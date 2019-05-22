<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <title></title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="css/style.css" rel="stylesheet">
   </head>
   <body>
      <form action="" method="get">
      <fieldset>
         
     
      <legend><b>Ordenar números com Radix</b></legend>
         <label for="">Quantos números deseja para ordenar?</label>
         <br>
         <input type="number" name="numeros" id="">
         <br>
         <label for="">Quantos dígitos deseja?</label>
         <br>
         <input type="number" name="digitos" id="">
         <p>Ex para digitos:<br> 1-9 -> números de 1 a 9<br> 999 -> número de digitos<br>Exemplo: 99 -> números com dois digitos de 1 até 9<p>
         <input type="submit">
         </fieldset>
      </form>

      </body>
      <style>
      body{
         padding:5%;
      }
         form{
            padding:2%;
            background-color:#cecece;
            width:20%;
            margin:0 auto;
         }
         input{
            margin:5% 0%;
            width:100%;
            height:40px;
            border:0px solid;
            font-size:20px;
         }
         #tabela{
            background-color:#2e2e2e;
            color:white;
         }
      </style>
</html>
<?php

$dados = $_REQUEST;
$digitos = $dados['digitos'];
$numeros = $dados['numeros'];
if($dados['numeros'] != null && $dados['digitos']!= null){
   function criaBucket(){
      $bucket = array();
      for ($x = 0; $x < 10; $x++){
         $bucket[$x] = array();
      }
      return $bucket;
   }
   
   function criaArray($numeros,$digitos){
      $array = array();
      for($i=0; $i<$numeros; $i++){
         $array[] = rand(0,$digitos);
      }
      return $array;
   }
   
   function imprimirlista($array){
      echo "<br>"; 
      echo '<div id="tabela">Tabela:   ';
      for($x = 0; $x<count($array);$x++){
         
         echo "  ".$array[$x]." ";
      }

      echo "</div> ";
      return $array;
    
   }
   
   
   function imprimirBucket($bucket){
      for($b =0; $b < 10; $b++){
         echo "<br>";
         echo("Fila $b:");
     
          for($f =0; $f <count($bucket[$b]); $f++){
            echo "  "; 
               echo($bucket[$b][$f].",");     
         } 
         echo "<br>"; 
      }
      echo "<br>"; 
   }
   
   function contarDigitos($array){
      $maxDigits = 0;
      foreach($array as $value){
         $numDigits = strlen((string)$value);
         if($numDigits > $maxDigits)
            $maxDigits = $numDigits;
      }
      return $maxDigits;
   }

   function insereValoresArray($bucket){
      $array = array();
         
      for($j=0; $j<count($bucket); $j++){
         foreach($bucket[$j] as $value){
            $array[] = $value;
            
         }
      }
      return $array;
   }
   
   function radixSort($array){
      //Create a bucket of arrays
      $bucket = criaBucket($array);
      imprimirlista($array);
      $maxDigits = contarDigitos($array);
      //Foreach usado para contar quantos digitos possui os n�meros
      foreach($array as $value){
         $numDigits = strlen((string)$value);
         if($numDigits > $maxDigits)
            $maxDigits = $numDigits;
      }
      
      $interecao = 1;
      $maisdigitos = false;
      for($k=0; $k<$maxDigits; $k++){
   
         echo "<br><br><b>Interação [".$interecao."] : $interecao ª distribuição</b><br>";
         $interecao ++;
         for($i=0; $i<count($array); $i++){
           
            if(!$maisdigitos)// caso seja Primeira passada do la�o ent�o � o digito mais a direita
               
               $bucket[$array[$i]%10][] =  $array[$i];//Insere o elemento na posi��o que corresponde o resto da divis�o por 10, que sempre ser� o digito mais a direita;
               
            else
               $bucket[($array[$i]/10**$k)%10][] =  $array[$i];// insere elemento na posi��o que corresponde o resto da divis�o de (elemento /10**n�mero do digito)%10     
            
            
       
         }
         //Impreme o bucket na tela
         imprimirBucket($bucket);

         //Insere os valores do bucket que foram ordenados de volta na tabela
         $array = insereValoresArray($bucket);
         //Limpa e Reseta o bucket
         imprimirlista($array);
         $bucket = criaBucket();
         $maisdigitos= true;//Se tiver mais de 1 digito passar a ser true 
         
      }
      
    
   }
   
   
   $array = radixSort(criaArray($numeros,$digitos));//Chama fun��o que gera o num de array aleatorios
   

}

//Fun��o para criar bucket

?>

