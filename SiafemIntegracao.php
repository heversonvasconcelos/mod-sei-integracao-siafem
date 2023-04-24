<?php

class SiafemIntegracao extends SeiIntegracao
{
    public static $FICHA_INTEGRACAO_SIAFEM = 'Ficha de Integração SIAFEM';

    public static $ACAO_ENVIAR_PROCESSO = 'md_intgr_siafem_enviar_processo';

    public static $PROCESSO_ENVIADO_SIAFEM = 'md_intgr_siafem_processo_enviado';
    public static $URL_SERVICO_SIAFEM_BASE = 'http://localhost:3080/siafem';

    public function getNome()
    {
        return 'Módulo de integração para envio dos processos do SEI ao SIAFEM';
    }

    public function getVersao()
    {
        return '1.0.0';
    }

    public function getInstituicao()
    {
        return 'Prodesp';
    }

    public function montarBotaoProcesso(ProcedimentoAPI $objProcedimentoAPI): array
    {
        $arrBotoes = array();

        //$arrBotoes[] = '<a href="#" onclick="location.href=\\\'' . SessaoSEI::getInstance()->assinarLink('controlador.php?acao=md_intgr_siafem_enviar_processo&id_procedimento=' . $objProcedimentoAPI->getIdProcedimento() . '&arvore=1') . '\\\';" tabindex="' . PaginaSEI::getInstance()->getProxTabBarraComandosSuperior() . '" ><img  src="modulos/prodesp/integracao-siafem/svg/siafem.svg" alt="Enviar processo ao SIAFEM" title="Enviar processo ao SIAFEM" /></a>';

        return $arrBotoes;
    }

    public function montarBotaoDocumento(ProcedimentoAPI $objProcedimentoAPI, $arrObjDocumentoAPI): array
    {
        $arrBotoes = array();
        $numeroProtocolo = $objProcedimentoAPI->getNumeroProtocolo();

        foreach ($arrObjDocumentoAPI as $objDocumentoAPI) {
            $nomeSerie = $objDocumentoAPI->getNomeSerie();
            $sinAssinado = $objDocumentoAPI->getSinAssinado();

            //Verifica se o documento é uma ficha de integração SIAFEM e se está assinado
            if (SiafemIntegracao::$FICHA_INTEGRACAO_SIAFEM == $nomeSerie && $sinAssinado == 'S') {
//            if (SiafemIntegracao::$FICHA_INTEGRACAO_SIAFEM == $nomeSerie) {
                $dblIdDocumento = $objDocumentoAPI->getIdDocumento();
                $arrBotoes[$dblIdDocumento] = array();
                $arrBotoes[$dblIdDocumento][] = ('<a href="#" onclick="location.href=\\\'' .
                    SessaoSEI::getInstance()->assinarLink('controlador.php?acao=md_intgr_siafem_enviar_processo' .
                        '&id_procedimento=' . $objProcedimentoAPI->getIdProcedimento() .
                        '&nmr_protocolo=' . $numeroProtocolo .
                        '&id_documento=' . $dblIdDocumento . '&arvore=1') . '\\\';" tabindex="' .
                    PaginaSEI::getInstance()->getProxTabBarraComandosSuperior() . '"><img  src="modulos/prodesp/mod-sei-integracao-siafem/svg/siafem.svg" alt="Enviar processo ao SIAFEM" title="Enviar processo ao SIAFEM" /></a>');

                return $arrBotoes;
            }
        }

        return $arrBotoes;
    }

    public function processarControlador($strAcao)
    {
        switch ($strAcao) {
            case 'md_intgr_siafem_enviar_processo':
                require_once dirname(__FILE__) . '/md_intgr_siafem_enviar_processo.php';
                return true;
        }
        return false;
    }


}



