<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <nav class="menu">
        <input type="checkbox" class="menu-faketrigger"/>
        <div class="menu_lines">
            <!-- span é a linha que fica dentro da nave (itens) -->
            <span></span> 
            <span></span>
            <span></span>
        </div>
        <ul>
            <li><a href="#"><i class="material-symbols-outlined" >home</i>  Início</a></li>
            <li><a href="#"><i class="material-symbols-outlined">groups</i>  Sobre</a></li>
            <li><a href="#"><i class="material-symbols-outlined">restaurant</i>  Menu</a></li>
            <li><a href="#"><i class="material-symbols-outlined">call</i>  Contatos</a></li>
            <li><a href="#"><i class="material-symbols-outlined">shopping_cart</i>  Carrinho</a></li>
        </ul>
    </nav>
   
</body>
</html>

<style>


*{
    margin: 0;
    padding: 0;
    list-style: none;
}

body{
    font-family: Arial, Helvetica, sans-serif;
    background-color: black;
    color: white;
}

.menu .menu_lines{
    position: absolute;
    z-index: 999;
    width: 35px;
    height: 35px;

}

.menu .menu_lines span{
    display: block;
    width: 35px;
    height: 5px;
    margin-bottom: 10px;
    background-color: rgb(255, 255, 255);
    border-radius: 3px;
    transition: all ease.2s;

}

.menu .menu-faketrigger{
    position: absolute;
    z-index: 1000;
    width: 35px;
    height: 35px;
    opacity: 0;
    cursor: pointer;
}

.menu .menu-faketrigger:checked ~ .menu_lines span{
    background-color: black;

}

.menu .menu-faketrigger:checked~.menu_lines span:nth-child(1){
    transform-origin: 0% 0%;
    transform: rotate(45deg) scaleX(1.25);
} 

.menu .menu-faketrigger:checked~.menu_lines span:nth-child(2){
    opacity: 0;
}

.menu .menu-faketrigger:checked~.menu_lines span:nth-child(3){
    transform-origin: 0% 100%;
    transform: rotate(-45deg) scaleX(1.25);
}
.menu ul{
    position: absolute;
    z-index: 998;
    left: 0;
    top: 0;
    width: 300px;
    height: calc(100vh - 100px);
    padding-top: 100px;
    background-color: white;
    margin-left: -300px;
    transition: all ease.2s;
}
.menu .menu-faketrigger:checked ~ ul{
    margin-left: 0;

}
.menu ul li{
    padding: 10px 30px;
}
.menu ul li a{
    text-decoration: none;
    color: black;
    font-size: 22px;
    transition: all ease.3s;
}
.menu ul li a:hover{
    color: #999;
}
.menu{
    margin-left: 30px;
    margin-top: 30px;

}

.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 700,
  'GRAD' 0,
  'opsz' 48
}
</style>
