<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="<?php echo base_url().'public/assets/js/jquery-1.9.1.min.js'?>"></script>
</head>
<body>
    <?php if(isset($view_file)){
        $this->load->view($view_module.'/'.$view_file);
    }?>
</body>
</html>