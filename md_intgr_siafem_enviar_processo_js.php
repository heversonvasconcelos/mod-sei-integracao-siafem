<?php
?>
<script type="text/javascript">
    let formData = null;

    function inicializar() {
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
            alert('Informe o Usuário SIAFEM.');
            document.getElementById('strUsuarioSiafem').focus();
            return false;
        }
        if (getPswSenhaSiafem() === '') {
            alert('Informe a senha SIAFEM.');
            document.getElementById('pswSenhaSiafem').focus();
            return false;
        }
        if (getPswSenhaSiafem() === '') {
            alert('Informe a senha SIAFEM.');
            document.getElementById('pswSenhaSiafem').focus();
            return false;
        }
        if (getHdnSiafDoc() === '') {
            alert('Não foi possível obter SIAFDOC a partir da Ficha de Integração SIAFEM.');
            return false;
        }

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
        enviarProcessoSiafemPostAjax();
    }
</script>