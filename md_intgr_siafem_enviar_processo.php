<?php


try {
    require_once dirname(__FILE__) . '/../../../SEI.php';

    session_start();

    SessaoSEI::getInstance()->validarLink();

//  SessaoSEI::getInstance()->validarPermissao($_GET['acao']);

    $strParametros = '';
    if (isset($_GET['arvore'])) {
        PaginaSEI::getInstance()->setBolArvore($_GET['arvore']);
        $strParametros .= '&arvore=' . $_GET['arvore'];
    }

    $idProcedimento = null;
    if (isset($_GET['id_procedimento'])) {
        $idProcedimento = $_GET['id_procedimento'];
        $strParametros .= '&id_procedimento=' . $idProcedimento;
    }

    $numeroProtocolo = null;
    if (isset($_GET['nmr_protocolo'])) {
        $numeroProtocolo = $_GET['nmr_protocolo'];
        $strParametros .= '&nmr_protocolo=' . $numeroProtocolo;
    }

    $idDocumento = null;
    if (isset($_GET['id_documento'])) {
        $idDocumento = $_GET['id_documento'];
        $strParametros .= '&id_documento=' . $idDocumento;
    }

    $arrComandos = array();

    $strLinkRetorno = null;

    switch ($_GET['acao']) {

        case 'md_intgr_siafem_enviar_processo':

            $strTitulo = 'Enviar ao SIAFEM';
            $arrComandos[] = '<button type="submit" accesskey="S" name="sbmEnviar" value="Enviar" class="infraButton">Enviar</button>';

            //Algumas variáveis de sessão disponíveis:
            //SessaoSEI::getInstance()->getNumIdUsuario()
            //SessaoSEI::getInstance()->getStrSiglaUsuario()
            //SessaoSEI::getInstance()->getStrNomeUsuario()
            //SessaoSEI::getInstance()->getNumIdOrgaoUsuario()
            //SessaoSEI::getInstance()->getStrSiglaOrgaoUsuario()
            //SessaoSEI::getInstance()->getStrDescricaoOrgaoUsuario()
            //SessaoSEI::getInstance()->getNumIdUnidadeAtual()
            //SessaoSEI::getInstance()->getStrSiglaUnidadeAtual()
            //SessaoSEI::getInstance()->getStrDescricaoUnidadeAtual()

            $strUsuarioSiafem = null;
            if (isset($_POST['strUsuarioSiafem'])) {
                $strUsuarioSiafem = $_POST['strUsuarioSiafem'];
            }

            $pswSenhaSiafem = null;
            if (isset($_POST['pswSenhaSiafem'])) {
                $pswSenhaSiafem = $_POST['pswSenhaSiafem'];
            }

            $siafDocJson = SiafDocAPI::gerarSiafDocAPartirDaFichaDeIntegracao($numeroProtocolo, $idDocumento);
            $strEncodedSiafDoc = rawurlencode($siafDocJson);

            if (isset($_POST['sbmEnviar'])) {
                try {
                    //$strLinkRetorno = SessaoSEI::getInstance()->assinarLink('controlador.php?acao=procedimento_visualizar&acao_origem=' . $_GET['acao'] . '&id_procedimento=' . $_GET['id_procedimento'] . '&id_documento=' . $_GET['id_documento'] . '&montar_visualizacao=1');
                } catch (Exception $e) {
                    PaginaSEI::getInstance()->processarExcecao($e);
                }
            }
            break;

        default:
            throw new InfraException("Ação '" . $_GET['acao'] . "' não reconhecida.");
    }

} catch (Exception $e) {
    PaginaSEI::getInstance()->processarExcecao($e);
}

PaginaSEI::getInstance()->montarDocType();
PaginaSEI::getInstance()->abrirHtml();
PaginaSEI::getInstance()->abrirHead();
PaginaSEI::getInstance()->montarMeta();
PaginaSEI::getInstance()->montarTitle(PaginaSEI::getInstance()->getStrNomeSistema() . ' - ' . $strTitulo);
PaginaSEI::getInstance()->montarStyle();
PaginaSEI::getInstance()->abrirStyle();
?>

    #lblUsuarioSiafem {position:absolute;left:0%;top:0%;width:50%;}
    #strUsuarioSiafem {position:absolute;left:0%;top:6%;width:50%;}

    #lblSenhaSiafem {position:absolute;left:0%;top:16%;width:50%;}
    #pswSenhaSiafem {position:absolute;left:0%;top:22%;width:50%;}

<?php
PaginaSEI::getInstance()->fecharStyle();
PaginaSEI::getInstance()->montarJavaScript();
PaginaSEI::getInstance()->abrirJavaScript();
PaginaSEI::getInstance()->fecharJavaScript();
PaginaSEI::getInstance()->fecharHead();
PaginaSEI::getInstance()->abrirBody($strTitulo, 'onload="inicializar();"');
?>
    <form id="frmFormularioArvore" method="post" onsubmit="return OnSubmitForm();"
          action="<?= PaginaSEI::getInstance()->formatarXHTML(SessaoSEI::getInstance()->assinarLink('controlador.php?acao=' . $_GET['acao'] . '&acao_origem=' . $_GET['acao'] . $strParametros)) ?>">
        <?php
        PaginaSEI::getInstance()->montarBarraComandosSuperior($arrComandos);
        //PaginaSEI::getInstance()->montarAreaValidacao();
        PaginaSEI::getInstance()->abrirAreaDados('30em');
        ?>

        <label id="lblUsuarioSiafem" for="strUsuarioSiafem" accesskey="1"
               class="infraLabelObrigatorio">Usu&aacute;rio SIAFEM</label>
        <input type="text" id="strUsuarioSiafem" name="strUsuarioSiafemf" class="infraText"
               value="<?= PaginaSEI::tratarHTML($strUsuarioSiafem) ?>"
               maxlength="50" tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>"/>

        <label id="lblSenhaSiafem" for="pswSenhaSiafem" accesskey="2"
               class="infraLabelObrigatorio">Senha SIAFEM</label>
        <input type="password" id="pswSenhaSiafem" name="pswSenhaSiafem" class="infraPassword"
               value="<?= PaginaSEI::tratarHTML($pswSenhaSiafem) ?>"
               maxlength="50" tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>"/>

        <input type="hidden" id="hdnSiafDoc" name="hdnSiafDoc" value=<?= $strEncodedSiafDoc ?>/>

    </form>
<?php
require_once('md_intgr_siafem_enviar_processo_js.php');
PaginaSEI::getInstance()->fecharBody();
PaginaSEI::getInstance()->fecharHtml();
?>