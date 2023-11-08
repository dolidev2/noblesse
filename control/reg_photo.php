<head>
    <!-- Sweat alert -->
    <link rel="stylesheet" type="text/css" href="../public/sweat_allert/sweetalert.css" media="screen" />
</head>
<?php
session_start();
include_once '../model/Eleve.class.php';
include_once '../model/Audit.class.php';

if(isset($_FILES)){

    // file upload
    $year = date('Y');

    if (!file_exists('../public/images/'.$year)) {
        mkdir('../public/images/'.$year, 0777, true);
        $target_dir = '../public/images/'.$year.'/';
    }
    $target_dir = '../public/images/'.$year.'/';
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"    && $imageFileType != "gif" )
    {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $img = '';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            $id = $_POST['id'];
            $data = array(
                'image'=>$_FILES["img"]["name"],
                'id'=>$_POST['id']
            );
            Eleve::modifierPhoto($data);
            header('location:../view/index.php?page=up_eleve&id_eleve='.$id);

        } else {
            $img = '';
        }
    }

    $id = $_POST['id'];
    header('location:../view/index.php?page=up_eleve&id_eleve='.$id);

}else{

    header('location:../view/index.php?page=up_eleve&id_eleve='.$id);

}

?>

<script>
    <!-- Sweat alert -->
    <script src="../public/sweat_allert/sweetalert.min.js"></script>
</script>