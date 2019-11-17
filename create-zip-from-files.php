<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      Simple Drag-and-drop upload Demo
    </title>
    <style>
        body {
            display: grid;
            grid-template-columns: 350px 400px;
            grid-template-rows: 100px 300px;
        }
      #uploader {
        width: 300px; 
        height: 200px; 
        background: #ecf0f1;
        padding: 10px;
      }
      #uploader.highlight {
        background:#ff0;
      }
      #uploader.disabled {
        background:#aaa;
      }
      section {
          grid-column: 3; grid-row: 1;
      }
    </style>
    <script src="drag-drop-upload.js"></script>
  </head>
  <body>
  <nav>
      <div>
          <label>Nom de l'archive</label>

      </div>
      <form action="create-zip.php" method="post" enctype="multipart/form-data">
          <input type="text" name="zipname">
          <input type="submit" value="Create zip" id="create-zip" name="submit">
      </form>
      <br>


  </nav>

  <aside>Fichiers ajoutées
  <ul>
      <?php
      if (isset($_SESSION['files'])){
          $array = $_SESSION['files'];
      }
      if (isset($array)){


      foreach ($array as $value){ ?>
          <li><?php
                  echo $value;
              ?></li>
      <?php  }} ?>

  </ul>
  </aside>
  <article>
      <!-- DROP ZONE -->
      <div id="uploader">
          Drop Files Here
      </div>
      <div id="upstat"></div>

      <!-- FALLBACK -->
      <form action="simple-upload.php" method="post" enctype="multipart/form-data">
          <input type="file" name="file-upload" id="file-upload" accept="image/*">
          <input type="submit" value="Upload File" name="submit">
      </form>

  </article>
    <!-- STATUS -->


  </body>
</html>
