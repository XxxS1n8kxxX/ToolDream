<!DOCTYPE html>
<html lang="en">
    
<head>
    
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Simple Sidebar - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/estilo_reproductor.css" rel="stylesheet" />
    <script src="jquery-3.4.1.min.js"></script>
    <script src = "javascript_cambios.js"></script>

    

</head>

    <?php

    session_start();

    include_once 'db.php';

    if(!isset($_SESSION['usuario'])){

    header("location: index.php");

    exit();

    $usuario_td = $_SESSION['usuario'];

    }

    conectadb();

    ?>


<body>

    <div class="d-flex" id="wrapper">
    <!-- Sidebar-->
    <div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center encabezado" style="font-size: 25px">ToolDream</div>
        <div class="list-group list-group-flush">
            <a class="text-primary list-group-item list-group-item-action list-group-item-light p-3 boton1" href="#!">Canciones</a>
            <a class="text-primary list-group-item list-group-item-action list-group-item-light p-3 boton2" href="#!">Albumes</a>
            <a class="text-primary list-group-item list-group-item-action list-group-item-light p-3 boton3" href="#!">PlayLists</a>
            <a class="text-primary list-group-item list-group-item-action list-group-item-light p-3 boton4 href="#!">Usuario</a>
            <a class="text-primary list-group-item list-group-item-action list-group-item-light p-3 dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Añadir</a>
                    <div class="dropdown-menu text-center text-white h6">
                        <a class="text-primary list-group-item list-group-item-action list-group-item-light p-3 boton1-1">Canción</a>
                        <a class="text-primary list-group-item list-group-item-action list-group-item-light p-3 boton2-1">Album</a>
                        <a class="text-primary list-group-item list-group-item-action list-group-item-light p-3 boton3-1">Playlist</a>
                    </div>

            

        </div>
    </div>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
        <!-- Top navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-primary" id="sidebarToggle">Menu</button>

                <h5 style = "float: left; margin-left: 15px; margin-top: 12px; margin-right: 10px" class = "text-danger"><?php if(isset($_SESSION['cambios_pass'])){ echo $_SESSION['cambios_pass']; unset($_SESSION['cambios_pass']);}?></h5>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">

                    <li class="nav-item"><a class="nav-link text-primary" href="#!">

                        <?php

                        $user_td = $_SESSION['usuario'];

                        ?>

                        <p class = "color-primary   ">Bienvenido <?php echo $user_td ?>!</p>

                        </a></li>
                        <li class="nav-item active"><a class="nav-link text-danger" href="logout.php">Cerrar Sesión</a></li>

                         

                    </ul>
                </div>
            </div>
        </nav>

        <!-- Playlist-->

        <div id="canciones">

            <?php


            $select_canciones = "SELECT * FROM songs s inner join album a on a.ID_ALBUM = s.ID_ALBUM  WHERE s.OWNER_SONG = '$user_td' order by a.ARTIST asc";

            $result_canciones = mysqli_query($conn, $select_canciones);

            $row_count_canciones = mysqli_num_rows($result_canciones);

            if($row_count_canciones == 0){

            print "<h3 style='color: red; text-align: center; margin-bottom: 25px; margin-top: 25px;'>No hay ninguna canción todavía</h3>";

            }else{

              echo "
              
              <table class='table table-responsive'>
                <thead>
                  <tr class='bg-primary'>
                    <th scope='col'>Nombre</th>
                    <th scope='col'>Banda</th>
                    <th scope='col'>Reproducción</th>
                    <th scope='col'>Descargar</th>
                    <th scope='col'>Eliminar</th>
                  </tr>
                </thead>
              
              ";

              while($row = mysqli_fetch_array($result_canciones, MYSQLI_ASSOC)){

              
              $nombre = "{$row['NAME_SONG']}";
              $url_canciones = "usuarios/$user_td/" . "canciones/";
              

                      echo"
                      <tbody>
                        <tr>
                          <th>{$row['URL_SONG']} </th>
                          <td>{$row['ARTIST']}</td>
                          <td>"; echo '<audio controls source src="' . $url_canciones . $nombre .'" type="audio/mpeg"> No jala la cancion. </audio><br>'; echo "</td>
                          <td><a href=' " . $url_canciones . $nombre ."' download><span class='material-icons'>file_download</span></a></td>
                          <td><form action='eliminar_canciones.php' method='post'><input type='hidden' id='borrar_cancion' name='borrar_cancion' value='{$row['URL_SONG']}'><input class='material-icons' type='submit' value='delete'></form></td>

                        </tr></tbody>";

              }

            }

            ?>

          </table>

        </div>
       
        <!-- Playlist -->
        

        <div id="playlist">
           
           <div style="padding: 10px">
 
           <?php
 
             $select_imagenes = "SELECT * FROM songs s inner join playlist a on a.ID_PLAYLIST = s.ID_PLAYLIST WHERE s.OWNER_SONG = '$user_td' AND NAME_PLAYLIST NOT LIKE 'Ninguna'";
 
             $result_imagenes = mysqli_query($conn, $select_imagenes);
 
             $row_count = mysqli_num_rows($result_imagenes);
             
             if($row_count == 0){
 
             print "<h3 style='color: red; text-align: center;'>No hay ninguna canción en ninguna playlist </h3>";
 
             }else{
 
                 $count = " ";
 
                 while ($row = mysqli_fetch_array($result_imagenes, MYSQLI_ASSOC)){
 
                 $select_canciones_album = "SELECT * FROM songs s inner join playlist a on a.ID_PLAYLIST = s.ID_PLAYLIST WHERE s.OWNER_SONG = '$user_td' AND NAME_PLAYLIST NOT LIKE 'Ninguna'";
 
                 $result_canciones_album = mysqli_query($conn, $select_canciones_album);
 
                 $nombre_artista_bucle_anidado = "{$row['ID_PLAYLIST']}";
 
                 if($count != "{$row['ID_PLAYLIST']}" || $count == " "){
 
                   echo
 
                   "
                   <h3>{$row['NAME_PLAYLIST']}</h3>
 
                   <img style='height:200px; width:300px;' class='img-fluid rounded' src='usuarios/$user_td" . "/playlist/img_playlist/{$row['IMG']}'/><br>
 
                   "; echo "<br>";            
 
                     while ($row = mysqli_fetch_array($result_canciones_album, MYSQLI_ASSOC)){ 
                     
                       if($nombre_artista_bucle_anidado ==  "{$row['ID_PLAYLIST']}"){
                       
                        echo "<h6>{$row['URL_SONG']}</h6>" . '<audio style = "margin-left: 320px; margin-top: -60px;" controls source src="' . $url_canciones . $nombre .'" type="audio/mpeg"> No jala la cancion. </audio><br>';
 
                       $count = "{$row['ID_PLAYLIST']}";
 
                       }
                     
                     }
 
                   }
 
                 }

               }
 
             ?>
 
           </div>
 
         </div>

        <!-- Albumes -->

        <div id="albumes">
           
          <div style="padding: 10px">

          <?php

            $select_imagenes = "SELECT * FROM songs s inner join album a on a.ID_ALBUM = s.ID_ALBUM WHERE s.OWNER_SONG = '$user_td' AND NAME_ALBUM NOT LIKE 'Ninguno'";

            $result_imagenes = mysqli_query($conn, $select_imagenes);

            $row_count = mysqli_num_rows($result_imagenes);
            
            if($row_count == 0){

            print "<h3 style='color: red; text-align: center;'>No hay ninguna canción en ningun album</h3>";

            }else{

                $count = " ";

                while ($row = mysqli_fetch_array($result_imagenes, MYSQLI_ASSOC)){

                $select_canciones_album = "SELECT * FROM songs s inner join album a on a.ID_ALBUM = s.ID_ALBUM WHERE s.OWNER_SONG = '$user_td' AND NAME_ALBUM NOT LIKE 'Ninguno'";

                $result_canciones_album = mysqli_query($conn, $select_canciones_album);

                $nombre_artista_bucle_anidado = "{$row['ARTIST']}";

                if($count != "{$row['ID_ALBUM']}" || $count == " "){

                  echo

                  "
                  <h3>{$row['ARTIST']} - {$row['NAME_ALBUM']}</h3>

                  <img style='height:200px; width:300px;' class='img-fluid rounded' src='usuarios/$user_td" . "/albumes/img_albumes/{$row['IMG']}'/><br>

                  "; echo "<br>";            

                    while ($row = mysqli_fetch_array($result_canciones_album, MYSQLI_ASSOC)){ 
                    
                      if($nombre_artista_bucle_anidado ==  "{$row['ARTIST']}"){
                      
                      echo "<h6>{$row['URL_SONG']}</h6>" . '<audio style = "margin-left: 320px; margin-top: -60px;" controls source src="' . $url_canciones . $nombre .'" type="audio/mpeg"> No jala la cancion. </audio><br>';

                      $count = "{$row['ID_ALBUM']}";

                      }
                    
                    }

                  }

                }
              }

            ?>

          </div>

        </div>


        <!-- Usuarios -->

        <div style='padding: 15px;' id="usuarios">

          <h1 style="padding: 10px">Cambiar Contraseña</h1>

          <form action="cambiar-pass.php" method = "post">

          <h5 class = "text-primary" style = "margin-left: 10px">Contraseña Antigua</h5>

          <input style = "margin-left: 10px" class="border border-primary" type="password" name="old_pass"><br>

          <h5 class = "text-primary" style = "margin-left: 10px">Contraseña Nueva</h5>

          <input style = "margin-left: 10px" class="border border-primary" type="password" name="nueva_pass"><br><br>
          <input style = "margin-left: 10px" class="btn btn-secondary bg-primary text-center" type="submit" value="Cambiar Contraseña">

          </form>

        </div>


        <!-- ################################################################################ -->

        <!-- Subir Playlist -->

        <div id="subir-playlist">
            
            <h1 style="padding: 10px">Inserción de Playlist</h1>
  
            <form action="add_playlist.php" method="post" enctype="multipart/form-data">
  
            <div style="padding: 10px" id="padding-albumes">
  
            <table class="table-playlist">
              <thead class="thead-primary bg-primary text-white rounded">
                <tr>
                  <th scope="col">&nbsp Nombre &nbsp</th>
                  <th scope="col"><input class="border border-primary" type="text" name="nombre"></th>
                </tr>
              </thead>
            </table>
  
            <br>

            <table class="table-playlist">
              <thead class="thead-primary bg-primary text-white rounded">
                <tr>
                  <th scope="col">&nbsp Imagen &nbsp</th>
                  <th scope="col"><input type="file" name="imagen" id="imagen"></th>
                </tr>
              </thead>
            </table>
  
            <br>
  
            </div>
  
            <div id="padding-submit-albumes"><input class="btn btn-secondary bg-primary text-center" type="submit" value="Añadir Playlist"></div>
  
            </form>

            <br>
                  
            </div>

        <!--Subir Albumes-->
            
        <div id="subir-albumes">
            
          <h1 style="padding: 10px">Inserción de Álbumes</h1>

          <form action="add_albumes.php" method="post" enctype="multipart/form-data">

          <div style="padding: 10px" id="padding-albumes">

          <table class="table-albumes">
            <thead class="thead-primary bg-primary text-white rounded">
              <tr>
                <th scope="col">&nbsp Nombre &nbsp</th>
                <th scope="col"><input class="border border-primary" type="text" name="nombre"></th>
              </tr>
            </thead>
          </table>

          <br>

          <table class="table-albumes">
            <thead class="thead-primary bg-primary text-white rounded">
              <tr>
                <th scope="col">&nbsp Artista &nbsp</th>
                <th scope="col"><input class="border border-primary" type="text" name="artista"></th>
              </tr>
            </thead>
          </table>

          <br>

          <table class="table-albumes">
            <thead class="thead-primary bg-primary text-white rounded">
              <tr>
                <th scope="col">&nbsp Genero &nbsp</th>
                <th scope="col"><input class="border border-primary" type="text" name="genero"></th>
              </tr>
            </thead>
          </table>

          <br>

          <table class="table-albumes">
            <thead class="thead-primary bg-primary text-white rounded">
              <tr>
                <th scope="col">&nbsp Discografica &nbsp</th>
                <th scope="col"><input class="border border-primary" type="text" name="discografica"></th>
              </tr>
            </thead>
          </table>

          <br>

          <table class="table-albumes">
            <thead class="thead-primary bg-primary text-white rounded">
              <tr>
                <th scope="col">&nbsp Año &nbsp</th>
                <th scope="col"><input class="border border-primary" type="text" name="ano"></th>
              </tr>
            </thead>
          </table>

          <br>

          <table class="table-albumes">
            <thead class="thead-primary bg-primary text-white rounded">
              <tr>
                <th scope="col">&nbsp Imagen &nbsp</th>
                <th scope="col"><input type="file" name="imagen" id="imagen"></th>
              </tr>
            </thead>
          </table>

          <br>

          </div>

          <div id="padding-submit-albumes" style="padding: 10px"><input class="btn btn-secondary bg-primary text-center" type="submit" value="Añadir Album"></div>


          </form>
                
          </div>


          <!-- Subir temas-->

          <div id="subir_temas">

          <h1 style="padding: 10px">Inserción de Canciones</h1>

          <div style="padding: 10px">

              <form action="subida-temas.php" method="post" enctype="multipart/form-data">
              
              
                  <?php

                    $select_album = "SELECT NAME_ALBUM FROM album WHERE OWNER_ALBUM = '$user_td' ORDER BY NAME_ALBUM DESC";

                    $result_album = mysqli_query($conn, $select_album);

                    echo "<select name='album-lista' class='btn-primary dropdown-toggle'>";

                    while($row_album = mysqli_fetch_array($result_album, MYSQLI_ASSOC)){
                    
                     echo "<option class='dropdown-item text-white' value='{$row_album['NAME_ALBUM']}'>{$row_album['NAME_ALBUM']}</option>";
                    
                     }
                   
                     echo "</select>";
                   
                     echo "<h6 class='text-primary' style='float: left; margin-right: 20px; margin-left: 6px'><strong>Album &nbsp</strong></h6><br>";
                  

                    echo "<br>";
                     

                    $select_playlist = "SELECT NAME_PLAYLIST FROM PLAYLIST WHERE OWNER_PLAYLIST = '$user_td' ORDER BY NAME_PLAYLIST DESC";

                    $result_playlist = mysqli_query($conn, $select_playlist);

                    echo "<select name='playlist-lista' class='btn-primary dropdown-toggle'>";

                    while($row_playlist = mysqli_fetch_array($result_playlist, MYSQLI_ASSOC)){
                    
                     echo "<option class='dropdown-item text-white' value='{$row_playlist['NAME_PLAYLIST']}'>{$row_playlist['NAME_PLAYLIST']}</option>";
                    
                     }
                   
                     echo "</select>";
                   
                     echo "<h6 class='text-primary' style='float: left; margin-right: 20px; margin-left: 6px'><strong>Playlist &nbsp</strong></h6><br>";

                    ?>

                  <br>

                  <table class="table-albumes">
                    <thead class="thead-primary bg-primary text-white rounded">
                      <tr>
                        <th scope="col">&nbsp Pista &nbsp</th>
                        <th scope="col"><input type="file"  name="file"/></th>
                      </tr>
                    </thead>
                  </table>

                  <div id="padding-submit-albumes" style="padding: 10px"><input class="btn btn-secondary bg-primary text-center" type="submit" name="save-media" value="Añadir Canción"></div>
                  

              </form>

            </div>

          </div>

                
    </div>

    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>


</body>

</html>

<?php

closedb();

?>
