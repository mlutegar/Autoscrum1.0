<?php
    date_default_timezone_set('America/Sao_Paulo');

    function uploadImg($file) {
        switch($file['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo 'arquivo excedeu o tamanho limite';
                exit;
            case UPLOAD_ERR_NO_FILE:
                echo 'arquivo não enviado (upload)';
                exit;
            default: 
                echo 'erro desconhecido';
                exit;
        }

        if($file['size'] > 10000000) {
            echo 'tamanho superior a 10mb';
        }

        $tipoValidos = array(
            'jpg' => 'upload/jpg',
            'jpeg' => 'upload/jpeg',
            'png' => 'upload/png',
            'zip' => 'upload/zip'
        );
            
        
        if(!$ext = array_search($file['type'], $tipoValidos, true)) {
            echo 'não é valido uppar'; 
        }

        $localSalvar = sprintf('.' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . '%s.%s', md5(date('Y.m.d-H.i.s.ms')), $ext);

        if(move_uploaded_file($file['tmp_name'], $localSalvar)) {
            return substr($localSalvar, 2);
        }
        
        echo 'ocorreu um erro ao tentar efetuar o upload';
    }
