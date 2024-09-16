<?php include('../../config/constant.php'); ?>

<?php
if (isset($_POST['download'])) {

    $hw_id = $_POST['hw_id'];

    // create a zip file
    $zip_file = "../homework-files/" . $hw_id . ".zip";
    touch($zip_file);

    // open zip file
    $zip = new ZipArchive;
    $this_zip = $zip->open($zip_file);

    if ($this_zip) {

        $folder = opendir('../homework-files/');

        if ($folder) {
            while (false !== ($file = readdir($folder))) {
                if ($file !== "." && $file !== "..") {
                    $file_with_path = '../homework-files/' . $file;
                    $zip->addFile($file_with_path, $file);
                }
            }
            closedir($folder);
        }

        // download this created zip file
        if (file_exists($zip_file)) {

            //name when download
            $demo_name = $hw_id . ".zip";

            header('Content-type: application/zip');
            header('Content-Disposition: attachment; filename="' . $demo_name . '"');
            readfile($zip_file); // auto download

            //delete this zip file after download
            unlink($zip_file);
        }

    }

}
?>