<?php

class SiafDocAPI
{
    public $UG;
    public $Gestao;
    public $Objeto;
    public $TipoLicitacao;
    public $ATA;
    public $Convenio;
    public $FlagPresencial;
    public $FlagEletronico;
    public $CNPJ;
    public $CodMunicipio;
    public $SignatarioCedente;
    public $SignatarioConvenente;
    public $NaturezaDespesa;
    public $NaturezaDespesa2;
    public $NaturezaDespesa3;
    public $NaturezaDespesa4;
    public $NaturezaDespesa5;
    public $DataVigenciaInicial;
    public $DataVigenciaFinal;
    public $DataCelebracao;
    public $DataPublicacao;
    public $ValorContrapartida;
    public $ValorTotal;
    public $Situacao;
    public $ObjetoResumido1;
    public $ObjetoResumido2;
    public $ObjetoResumido3;
    public $Finalidade;

    /** Processo Utilizado para o processo legado */
    public $Processo;
    /** Desdobramento Utilizado em conjunto com o processo legado */
    public $Desdobramento;

    public $CodUnico;
    public $CodSemPapel;

    /** UnidadeGestora Utilizado para passar parâmetro MUDAPAH2 no formato #ValorUG */
    public $UnidadeGestora;

    /**
     * @return mixed
     */
    public function getUG()
    {
        return $this->UG;
    }

    /**
     * @param mixed $UG
     */
    public function setUG($UG): void
    {
        $this->UG = $UG;
    }

    /**
     * @return mixed
     */
    public function getUnidadeGestora()
    {
        return $this->UnidadeGestora;
    }

    /**
     * @param mixed $UnidadeGestora
     */
    public function setUnidadeGestora($UnidadeGestora): void
    {
        $this->UnidadeGestora = $UnidadeGestora;
    }

    /**
     * @return mixed
     */
    public function getGestao()
    {
        return $this->Gestao;
    }

    /**
     * @param mixed $Gestao
     */
    public function setGestao($Gestao): void
    {
        $this->Gestao = $Gestao;
    }

    /**
     * @return mixed
     */
    public function getObjeto()
    {
        return $this->Objeto;
    }

    /**
     * @param mixed $Objeto
     */
    public function setObjeto($Objeto): void
    {
        $this->Objeto = $Objeto;
    }

    /**
     * @return mixed
     */
    public function getTipoLicitacao()
    {
        return $this->TipoLicitacao;
    }

    /**
     * @param mixed $TipoLicitacao
     */
    public function setTipoLicitacao($TipoLicitacao): void
    {
        $this->TipoLicitacao = $TipoLicitacao;
    }

    /**
     * @return mixed
     */
    public function getATA()
    {
        return $this->ATA;
    }

    /**
     * @param mixed $ATA
     */
    public function setATA($ATA): void
    {
        $this->ATA = $ATA;
    }

    /**
     * @return mixed
     */
    public function getConvenio()
    {
        return $this->Convenio;
    }

    /**
     * @param mixed $Convenio
     */
    public function setConvenio($Convenio): void
    {
        $this->Convenio = $Convenio;
    }

    /**
     * @return mixed
     */
    public function getFlagPresencial()
    {
        return $this->FlagPresencial;
    }

    /**
     * @param mixed $FlagPresencial
     */
    public function setFlagPresencial($FlagPresencial): void
    {
        $this->FlagPresencial = $FlagPresencial;
    }

    /**
     * @return mixed
     */
    public function getFlagEletronico()
    {
        return $this->FlagEletronico;
    }

    /**
     * @param mixed $FlagEletronico
     */
    public function setFlagEletronico($FlagEletronico): void
    {
        $this->FlagEletronico = $FlagEletronico;
    }

    /**
     * @return mixed
     */
    public function getFinalidade()
    {
        return $this->Finalidade;
    }

    /**
     * @param mixed $Finalidade
     */
    public function setFinalidade($Finalidade): void
    {
        $this->Finalidade = $Finalidade;
    }

    /**
     * @return mixed
     */
    public function getCodUnico()
    {
        return $this->CodUnico;
    }

    /**
     * @param mixed $CodUnico
     */
    public function setCodUnico($CodUnico): void
    {
        $this->CodUnico = $CodUnico;
    }

    /**
     * @return mixed
     */
    public function getCodSemPapel()
    {
        return $this->CodSemPapel;
    }

    /**
     * @param mixed $CodSemPapel
     */
    public function setCodSemPapel($CodSemPapel): void
    {
        $this->CodSemPapel = $CodSemPapel;
    }

    /**
     * @return mixed
     */
    public function getDesdobramento()
    {
        return $this->Desdobramento;
    }

    /**
     * @param mixed $Desdobramento
     */
    public function setDesdobramento($Desdobramento): void
    {
        $this->Desdobramento = $Desdobramento;
    }

    /**
     * @return mixed
     */
    public function getCNPJ()
    {
        return $this->CNPJ;
    }

    /**
     * @param mixed $CNPJ
     */
    public function setCNPJ($CNPJ): void
    {
        $this->CNPJ = $CNPJ;
    }

    /**
     * @return mixed
     */
    public function getCodMunicipio()
    {
        return $this->CodMunicipio;
    }

    /**
     * @param mixed $CodMunicipio
     */
    public function setCodMunicipio($CodMunicipio): void
    {
        $this->CodMunicipio = $CodMunicipio;
    }

    /**
     * @return mixed
     */
    public function getSignatarioCedente()
    {
        return $this->SignatarioCedente;
    }

    /**
     * @param mixed $SignatarioCedente
     */
    public function setSignatarioCedente($SignatarioCedente): void
    {
        $this->SignatarioCedente = $SignatarioCedente;
    }

    /**
     * @return mixed
     */
    public function getSignatarioConvenente()
    {
        return $this->SignatarioConvenente;
    }

    /**
     * @param mixed $SignatarioConvenente
     */
    public function setSignatarioConvenente($SignatarioConvenente): void
    {
        $this->SignatarioConvenente = $SignatarioConvenente;
    }

    /**
     * @return mixed
     */
    public function getNaturezaDespesa()
    {
        return $this->NaturezaDespesa;
    }

    /**
     * @param mixed $NaturezaDespesa
     */
    public function setNaturezaDespesa($NaturezaDespesa): void
    {
        $this->NaturezaDespesa = $NaturezaDespesa;
    }

    /**
     * @return mixed
     */
    public function getNaturezaDespesa2()
    {
        return $this->NaturezaDespesa2;
    }

    /**
     * @param mixed $NaturezaDespesa2
     */
    public function setNaturezaDespesa2($NaturezaDespesa2): void
    {
        $this->NaturezaDespesa2 = $NaturezaDespesa2;
    }

    /**
     * @return mixed
     */
    public function getNaturezaDespesa3()
    {
        return $this->NaturezaDespesa3;
    }

    /**
     * @param mixed $NaturezaDespesa3
     */
    public function setNaturezaDespesa3($NaturezaDespesa3): void
    {
        $this->NaturezaDespesa3 = $NaturezaDespesa3;
    }

    /**
     * @return mixed
     */
    public function getNaturezaDespesa4()
    {
        return $this->NaturezaDespesa4;
    }

    /**
     * @param mixed $NaturezaDespesa4
     */
    public function setNaturezaDespesa4($NaturezaDespesa4): void
    {
        $this->NaturezaDespesa4 = $NaturezaDespesa4;
    }

    /**
     * @return mixed
     */
    public function getNaturezaDespesa5()
    {
        return $this->NaturezaDespesa5;
    }

    /**
     * @param mixed $NaturezaDespesa5
     */
    public function setNaturezaDespesa5($NaturezaDespesa5): void
    {
        $this->NaturezaDespesa5 = $NaturezaDespesa5;
    }

    /**
     * @return mixed
     */
    public function getDataVigenciaInicial()
    {
        return $this->DataVigenciaInicial;
    }

    /**
     * @param mixed $DataVigenciaInicial
     */
    public function setDataVigenciaInicial($DataVigenciaInicial): void
    {
        $this->DataVigenciaInicial = $DataVigenciaInicial;
    }

    /**
     * @return mixed
     */
    public function getDataVigenciaFinal()
    {
        return $this->DataVigenciaFinal;
    }

    /**
     * @param mixed $DataVigenciaFinal
     */
    public function setDataVigenciaFinal($DataVigenciaFinal): void
    {
        $this->DataVigenciaFinal = $DataVigenciaFinal;
    }

    /**
     * @return mixed
     */
    public function getDataCelebracao()
    {
        return $this->DataCelebracao;
    }

    /**
     * @param mixed $DataCelebracao
     */
    public function setDataCelebracao($DataCelebracao): void
    {
        $this->DataCelebracao = $DataCelebracao;
    }

    /**
     * @return mixed
     */
    public function getDataPublicacao()
    {
        return $this->DataPublicacao;
    }

    /**
     * @param mixed $DataPublicacao
     */
    public function setDataPublicacao($DataPublicacao): void
    {
        $this->DataPublicacao = $DataPublicacao;
    }

    /**
     * @return mixed
     */
    public function getValorContrapartida()
    {
        return $this->ValorContrapartida;
    }

    /**
     * @param mixed $ValorContrapartida
     */
    public function setValorContrapartida($ValorContrapartida): void
    {
        $this->ValorContrapartida = $ValorContrapartida;
    }

    /**
     * @return mixed
     */
    public function getValorTotal()
    {
        return $this->ValorTotal;
    }

    /**
     * @param mixed $ValorTotal
     */
    public function setValorTotal($ValorTotal): void
    {
        $this->ValorTotal = $ValorTotal;
    }

    /**
     * @return mixed
     */
    public function getSituacao()
    {
        return $this->Situacao;
    }

    /**
     * @param mixed $Situacao
     */
    public function setSituacao($Situacao): void
    {
        $this->Situacao = $Situacao;
    }

    /**
     * @return mixed
     */
    public function getObjetoResumido1()
    {
        return $this->ObjetoResumido1;
    }

    /**
     * @param mixed $ObjetoResumido1
     */
    public function setObjetoResumido1($ObjetoResumido1): void
    {
        $this->ObjetoResumido1 = $ObjetoResumido1;
    }

    /**
     * @return mixed
     */
    public function getObjetoResumido2()
    {
        return $this->ObjetoResumido2;
    }

    /**
     * @param mixed $ObjetoResumido2
     */
    public function setObjetoResumido2($ObjetoResumido2): void
    {
        $this->ObjetoResumido2 = $ObjetoResumido2;
    }

    /**
     * @return mixed
     */
    public function getObjetoResumido3()
    {
        return $this->ObjetoResumido3;
    }

    /**
     * @param mixed $ObjetoResumido3
     */
    public function setObjetoResumido3($ObjetoResumido3): void
    {
        $this->ObjetoResumido3 = $ObjetoResumido3;
    }

    /**
     * @return mixed
     */
    public function getProcesso()
    {
        return $this->Processo;
    }

    /**
     * @param mixed $Processo
     */
    public function setProcesso($Processo): void
    {
        $this->Processo = $Processo;
    }

    /**
     * @throws ReflectionException
     */
    public static function gerarSiafDocAPartirDaFichaDeIntegracao($idDocumento)
    {
        $objEntradaConsultarDocumentoAPI = new EntradaConsultarDocumentoAPI();
        $objEntradaConsultarDocumentoAPI->setIdDocumento($idDocumento);
        $objEntradaConsultarDocumentoAPI->setSinRetornarCampos('S');
        $objSeiRN = new SeiRN();
        $objSaidaConsultarDocumentoAPI = $objSeiRN->consultarDocumento($objEntradaConsultarDocumentoAPI);
        $arrCampos = $objSaidaConsultarDocumentoAPI->getCampos();

        $objSiafDocAPI = new SiafDocAPI();

        foreach ($arrCampos as $campo) {
            $method = new ReflectionMethod($objSiafDocAPI, 'set' . $campo->getNome());
            $method->invoke($objSiafDocAPI, $campo->getValor());
        }

        return json_encode((object)array_filter((array)$objSiafDocAPI));
        //return json_encode($objSiafDocAPI);
    }




}