<?php
include_once("connection.php");

if(isset($_POST['btn'])){

  $pic = $_FILES['pic']['name'];
  $name = $_POST['name'];
  $cat = $_POST['cat'] ?? [];
  $rate = $_POST['rate'];

  $convert = implode(" , ", $cat);

  $data_insert = "INSERT INTO movie_upload(image,movie_name,category,rating) 
                  VALUES(?,?,?,?)";

  $stmt = mysqli_prepare($result, $data_insert);

  mysqli_stmt_bind_param($stmt, 'ssss', $pic, $name, $convert, $rate);

  if(mysqli_stmt_execute($stmt)){

    move_uploaded_file(
      $_FILES["pic"]["tmp_name"],
      "upload/" . $_FILES['pic']['name']
    );

    header("LOCATION: movie.php");
    exit;
  }
  else{
    echo "not inserted";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Uploading Movies in Database</title>
  <link rel="stylesheet" href="">
</head>
<body>
  <div class="movie">
    <form action="" method="post"  enctype="multipart/form-data">
      <label for="">Upload Movie Image</label>
      <br>
      <input type="file" name="pic" id="" >
      <br><br>
      <label for="">Enter Movie name</label>
      <br>
      <input type="text" name="name" id="">
      <br>
      <h4>Enter category of the movie</h4>
      <label for="">Comedy</label>
      <input type="checkbox" name="cat[]" id="" value="Comedy">
      <br>
      <label for="">Dark Fantasy</label>
      <input type="checkbox" name="cat[]" id="" value="Dark Fantasy">
      <br>
      <label for="">Horror</label>
      <input type="checkbox" name="cat[]" id="" value="Horror">
      <br>
      <label for="">Drama</label>
      <input type="checkbox" name="cat[]" id="" value="Drama">
      <br>
      <label for="">Period Drama</label>
      <input type="checkbox" name="cat[]" id="" value="Period Drama">
      <br>
      <label for="">Romance</label>
      <input type="checkbox" name="cat[]" id="" value="Romance">
      <br>
      <label for="">Biography</label>
      <input type="checkbox" name="cat[]" id="" value="Biography">
      <br>
      <label for="">Anime Movie</label>
      <input type="checkbox" name="cat[]" id="" value="Anime Movie">
      <br>
      <label for="">Bhakti</label>
      <input type="checkbox" name="cat[]" id="" value="Bhakti">
      <br><br>
      <label for="">Rating</label>
      <br>
      <input type="text" name="rate" id="">
      <br><br>
      <input type="submit" value="Upload" name="btn">
    </form>
  </div>  

</body>
</html>