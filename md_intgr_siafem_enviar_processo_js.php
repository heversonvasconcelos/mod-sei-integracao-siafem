<?php
?>
<script type="text/javascript">
    let formData = null;

    function inicializar() {
        <? if ($strLinkRetorno != null) { ?>
            alert('Processo enviado ao SIAFEM. CodUnico: ' + <?= $codUnico ?>);
            parent.document.getElementById('ifrArvore').src = '<?= $strLinkRetorno ?>';
            return;
        <? } ?>

        formData = JSON.stringify($("#frmFormularioArvore").serializeArray());
        document.getElementById('strUsuarioSiafem').focus();
    }

    function getStrUsuarioSiafem() {
        return infraTrim(document.getElementById('strUsuarioSiafem').value);
    }

    function getPswSenhaSiafem() {
        return infraTrim(document.getElementById('pswSenhaSiafem').value);
    }

    function getHdnSiafDoc() {
        return decodeURIComponent(document.getElementById('hdnSiafDoc').value);
    }

    function validarFormulario() {
        if (getStrUsuarioSiafem() === '') {
            alert('Informe o Usu�rio SIAFEM.');
            document.getElementById('strUsuarioSiafem').focus();
            return false;
        }
        if (getPswSenhaSiafem() === '') {
            alert('Informe a senha SIAFEM.');
            document.getElementById('pswSenhaSiafem').focus();
            return false;
        }
        // if (getHdnSiafDoc() === '') {
        //     alert('N�o foi poss�vel obter SIAFDOC a partir da Ficha de Integra��o SIAFEM.');
        //     return false;
        // }

        return true;
    }

    function enviarProcessoSiafemPostAjax() {
        let usuarioSiafem = getStrUsuarioSiafem();
        let senhaSiafem = getPswSenhaSiafem();
        let documento = getHdnSiafDoc();
        let anoBase = new Date().getFullYear();

        let jsonData = {
            'Usuario': usuarioSiafem,
            'Senha': senhaSiafem,
            'AnoBase': anoBase,
        };

        jsonData.Documento = JSON.parse(documento);

        $.ajax({
            url: 'http://localhost:3080/siafem/enviar-processo',
            type: 'POST',
            async: false,
            processData: false,
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify(jsonData),
            success: function () {
            },
            error: function (response) {
                alert(response.responseJSON.erro);
            }
        });
    }

    function OnSubmitForm() {
        validarFormulario();
        // enviarProcessoSiafemPostAjax();
    }
</script>