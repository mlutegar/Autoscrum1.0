<?php
    date_default_timezone_set('America/Sao_Paulo');

    function uploadArquivo($file){        
        
        switch($file['error']){
            case UPLOAD_ERR_OK;
                break;
            case UPLOAD_ERR_INI_SIZE;
            case UPLOAD_ERR_FORM_SIZE;
                echo 'arquivo exedeu o tamanho limite';
                exit;
            case UPLOAD_ERR_NO_FILE;
                echo 'arquivo não enviado';
                exit;
            default:
                echo 'erro desconhecido'; 
                exit;
        }

        if($file['size'] > 10000000){
            echo 'tamanho superior a 10mb';
        }

        $tiposValidos = array(
            'zip' => 'application/x-zip-compressed',
            'rar' => 'application/octet-stream',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'doc' => 'application/msword',
            'pdf' => 'application/pdf'
        );

        if(!$ext = array_search($file['type'], $tiposValidos, true)){
            echo 'não é valido ';
        }
        
        $localSalvar = sprintf('.' . DIRECTORY_SEPARATOR . 'arquivos' . DIRECTORY_SEPARATOR . '%s.%s', 'download', $ext);

        if(move_uploaded_file($file['tmp_name'], $localSalvar)){
            return substr($localSalvar, 2);
        
        }
        
        echo 'não foi possivel fazer o upload';
    }
