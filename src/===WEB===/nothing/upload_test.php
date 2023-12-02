<?php
      $sql = "INSERT INTO `files`(`name`, `type`, `path`, `alt`, `superior_section`) VALUES ('$filename','$imageFileType','$newFilePath','$alt','$galery')" ;

 if(isset($_FILES['file']['tmp_name']))
    {
        // Number of uploaded files
        $num_files = count($_FILES['file']['tmp_name']);

        /** loop through the array of files ***/
        for($i=0; $i < $num_files;$i++)
        {
            // check if there is a file in the array
            if(!is_uploaded_file($_FILES['file']['tmp_name'][$i]))
            {
                $messages[] = 'No file uploaded';
            }
            else
            {
                // copy the file to the specified dir 
                if(@copy($_FILES['file']['tmp_name'][$i],$upload_dir.'/'.$_FILES['file']['name'][$i]))
                {
                    /*** give praise and thanks to the php gods ***/
                    $messages[] = $_FILES['file']['name'][$i].' uploaded';
                }
                else
                {
                    /*** an error message ***/
                    $messages[] = 'Uploading '.$_FILES['file']['name'][$i].' Failed';
                }
            }
        }
    }

?>
