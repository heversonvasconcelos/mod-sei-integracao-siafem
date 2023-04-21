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
        let siafDoc = getHdnSiafDoc();
        let anoBase = new Date().getFullYear();

        $.ajax({
            url: 'http://localhost:3080/siafem/enviar-processo',
            type: 'POST',
            async: false,
            data: JSON.stringify({
                usuario: usuarioSiafem,
                senha: senhaSiafem,
                anoBase: anoBase,
                documento: siafDoc
            }),
            dataType: 'json',
            contentType: 'application/json',
            success: function () {
            },
            error: function (response) {
            }
        });
    }

    function OnSubmitForm() {
        validarFormulario();
        enviarProcessoSiafemPostAjax();
    }
</script>