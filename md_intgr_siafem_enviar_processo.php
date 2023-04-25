<?php


try {
    require_once dirname(__FILE__) . '/../../../SEI.php';

    session_start();

    //////////////////////////////////////////////////////////////////////////////
    //InfraDebug::getInstance()->setBolLigado(false);
    //InfraDebug::getInstance()->setBolDebugInfra(true);
    //InfraDebug::getInstance()->limpar();
    //////////////////////////////////////////////////////////////////////////////

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
    $codUnico = null;

    switch ($_GET['acao']) {

        case SiafemIntegracao::$ACAO_ENVIAR_PROCESSO:

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

            if (isset($_POST['sbmEnviar'])) {
                try {
                    $objSiafDocAPI = SiafDocAPI::gerarSiafDocAPartirDaFichaDeIntegracao($numeroProtocolo, $idDocumento);
                    if ($objSiafDocAPI->getCodSemPapel() == null) {
                        throw new InfraException('Não foi possível gerar SIAFDOC a partir da ' . SiafemIntegracao::$FICHA_INTEGRACAO_SIAFEM);
                    }

                    $unidadeGestora = $objSiafDocAPI->getUnidadeGestora();
                    if (isset($unidadeGestora)) {
                        $objSiafDocAPI->setUnidadeGestora(null);
                    } else {
                        $unidadeGestora = '';
                    }


                    $siafemRequestData = [
                        'Usuario' => $strUsuarioSiafem,
                        'Senha' => $pswSenhaSiafem,
                        'AnoBase' => (new DateTime())->format('Y'),
                        'UnidadeGestora' => $unidadeGestora,
                        'Documento' => array_filter((array) $objSiafDocAPI)
                    ];

                    $result = enviarProcessoSiafemPost($siafemRequestData);
                    $codUnico = $result->codUnico;

                    if (!isset($codUnico)) {
                        throw new InfraException('Não foi possível enviar o SIAFDOC ao SIAFEM');
                    }
                    $objSiafDocAPI->setCodUnico($codUnico);
                    lancarAndamentoProcessoEnviadoAoSiafem($idProcedimento, $objSiafDocAPI->getCodUnico());

                    PaginaSEI::getInstance()->adicionarMensagem('Operação realizada com sucesso.');
                } catch (Exception $e) {
                    PaginaSEI::getInstance()->processarExcecao($e);
                }
                header('Location: ' . SessaoSEI::getInstance()->assinarLink('controlador.php?acao=procedimento_visualizar&acao_origem=' . $_GET['acao'] . '&id_procedimento=' . $_GET['id_procedimento'] . '&id_documento=' . $_GET['id_documento'] . '&montar_visualizacao=1'));
                die;
            }
            break;

        default:
            throw new InfraException("Ação '" . $_GET['acao'] . "' não reconhecida.");
    }

} catch (Exception $e) {
    PaginaSEI::getInstance()->processarExcecao($e);
}

/**
 * @throws InfraException
 */
function enviarProcessoSiafemPost($siafemRequestData)
{
    $siafemRequestData = mb_convert_encoding($siafemRequestData, 'UTF-8', 'ISO-8859-1');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, false);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt(
        $ch,
        CURLOPT_URL,
        SiafemIntegracao::$URL_SERVICO_SIAFEM_BASE . '/enviar-processo'
    );
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        ['accept: application/json', 'content-type: application/json']
    );

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($siafemRequestData));

    $responseBody = curl_exec($ch);

    /*
     * if curl_exec failed then
     * $responseBody is false
     * curl_errno() returns non-zero number
     * curl_error() returns non-empty string
     * which one to use is up too you
     */
    $curlErrNo = curl_errno($ch);
    $error = curl_error($ch);

    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($curlErrNo != 0) {
        throw new InfraException($error);
    }

    $responseBody = json_decode($responseBody);
    /*
     * 4xx status codes are client errors
     * 5xx status codes are server errors
     */
    if ($responseCode >= 400) {
        $msgErro = $responseBody->erro;
        $msgErro = mb_convert_encoding($msgErro, 'ISO-8859-1', 'UTF-8');
        if (is_array($msgErro)) {
            $msgErro = implode(' ', $msgErro);
        }

        throw new InfraException($msgErro);
    }

    return $responseBody;

}

function lancarAndamentoProcessoEnviadoAoSiafem($idProcedimento, $codUnico)
{
    $objEntradaLancarAndamentoAPI = new EntradaLancarAndamentoAPI();
    $objEntradaLancarAndamentoAPI->setIdProcedimento($idProcedimento);
    $objEntradaLancarAndamentoAPI->setIdTarefa(TarefaRN::$TI_ATUALIZACAO_ANDAMENTO);

    $arrObjAtributoAndamentoAPI = array();
    $objAtributoAndamentoAPI = new AtributoAndamentoAPI();
    $objAtributoAndamentoAPI->setNome('DESCRICAO');
    $objAtributoAndamentoAPI->setValor('Processo enviado ao SIAFEM. CodUnico: ' . $codUnico);
    $arrObjAtributoAndamentoAPI[] = $objAtributoAndamentoAPI;

    $objEntradaLancarAndamentoAPI->setAtributos($arrObjAtributoAndamentoAPI);
    $objSeiRN = new SeiRN();
    $objAndamentoAPI = $objSeiRN->lancarAndamento($objEntradaLancarAndamentoAPI);
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

    <label id="lblUsuarioSiafem" for="strUsuarioSiafem" accesskey="1" class="infraLabelObrigatorio">Usu&aacute;rio
        SIAFEM</label>
    <input type="text" id="strUsuarioSiafem" name="strUsuarioSiafem" class="infraText"
        value="<?= PaginaSEI::tratarHTML($strUsuarioSiafem) ?>" maxlength="50"
        tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>" />

    <label id="lblSenhaSiafem" for="pswSenhaSiafem" accesskey="2" class="infraLabelObrigatorio">Senha SIAFEM</label>
    <input type="password" id="pswSenhaSiafem" name="pswSenhaSiafem" class="infraPassword"
        value="<?= PaginaSEI::tratarHTML($pswSenhaSiafem) ?>" maxlength="50"
        tabindex="<?= PaginaSEI::getInstance()->getProxTabDados() ?>" />

</form>
<?php
require_once('md_intgr_siafem_enviar_processo_js.php');
PaginaSEI::getInstance()->fecharBody();
PaginaSEI::getInstance()->fecharHtml();
?>