$(document).ready(function(){
    
    /*
    *En este apartado del codigo escondemos todos los
    *desplegables para que no colapsen la página
    */

    $("#albumes").hide();
    $("#playlist").hide();
    $("#usuarios").hide();
    $("#subir_temas").hide();
    $("#subir-albumes").hide();
    $("#subir-playlist").hide();
    $("#modificar_canciones").hide();
    
        
    $(".boton1").click(function(){
        $("#canciones").toggle();
        $("#albumes").hide();
        $("#playlist").hide();
        $("#usuarios").hide();
        $("#subir_temas").hide();
        $("#subir-albumes").hide();
        $("#subir-playlist").hide();
    });
    
    $(".boton2").click(function(){
        $("#canciones").hide();
        $("#albumes").toggle();
        $("#playlist").hide();
        $("#usuarios").hide();
        $("#subir_temas").hide();
        $("#subir-albumes").hide();
        $("#subir-playlist").hide();

    });
    
    $(".boton3").click(function(){
        $("#canciones").hide();
        $("#albumes").hide();
        $("#playlist").toggle();
        $("#usuarios").hide();
        $("#subir_temas").hide();
        $("#subir-albumes").hide();
        $("#subir-playlist").hide();

    });
    
    $(".boton4").click(function(){
        $("#canciones").hide();
        $("#albumes").hide();
        $("#playlist").hide();
        $("#usuarios").toggle();
        $("#subir_temas").hide();
        $("#subir-albumes").hide();
        $("#subir-playlist").hide();

    });

    $(".boton1-1").click(function(){
        $("#canciones").hide();
        $("#albumes").hide();
        $("#playlist").hide();
        $("#usuarios").hide();
        $("#subir_temas").toggle();
        $("#subir-albumes").hide();
        $("#subir-playlist").hide();
        
    });

    $(".boton2-1").click(function(){
        $("#canciones").hide();
        $("#albumes").hide();
        $("#playlist").hide();
        $("#usuarios").hide();
        $("#subir_temas").hide();
        $("#subir-albumes").toggle();
        $("#subir-playlist").hide();
        
    });

    $(".boton3-1").click(function(){
        $("#canciones").hide();
        $("#albumes").hide();
        $("#playlist").hide();
        $("#usuarios").hide();
        $("#subir_temas").hide();
        $("#subir-albumes").hide();
        $("#subir-playlist").toggle();
        
    });

    $(".boton1-2").click(function(){
        $("#canciones").hide();
        $("#albumes").hide();
        $("#playlist").hide();
        $("#usuarios").hide();
        $("#subir_temas").hide();
        $("#subir-albumes").hide();
        $("#subir-playlist").hide();
        $("#modificar_canciones").toggle();
        
    });
    
            
});