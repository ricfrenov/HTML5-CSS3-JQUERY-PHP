<?php
/**
 * Classe Breadcrumb
 * --------------------------------------------------------------------------------------------------------
 * Implementa o caminho da url na p�gina corrente, direcionando cada parte para seu endere�o dentro do site
 * --------------------------------------------------------------------------------------------------------
 * @author Josean Matias
 * @link http://www.joseanmatias.com.br
 * @copyright 2011
 * @version 1.0.2
 * @example
 * A seguinte url: www.dominio.com.br/noticias/titulo-da-noticia
 * Ser� automaticamente particionada pela classe para apontamento de link
 * Onde:
 * www.dominio.com.br   -> apontar� para a p�gina inicial
 * noticias             -> apontar� para a p�gina de listagem de noticias
 * titulo-da-noticia    -> ser� a p�gina espec�fica da not�cia, neste caso n�o tem link.
 * -------------------------------
 * Caso a url n�o esteja no formato amig�vel, os fragmentos e links devem ser passados utilizando o m�todo set()
 * Sendo:
 * $crumb->set( array(
 *      'www.dominio.com.br'=>'Home',
 *      'noticias'          =>'Not�cias',
 *      ''                  =>'T�tulo da not�cia'
 * ) )
 */
class Breadcrumb {

    /**
     * o URL atual no endere�o do navegador, sem o protocolo
     * @var <string>
     */
    private $current_url    = '';

    /**
     * o protocolo de navega��o. Testados apenas HTTP e HTTPS
     * @var <string>
     */
    private $protocol       = '';

    /**
     * o separador dos crumbs
     * especificamente um caractere
     * @var <string>
     */
    private $separator      = '';

    /**
     * os fragmentos da url
     * @var <array>
     */
    private $crumbs         = array();

    /**
     * O conte�do HTML gerado pela classe e colocado na sa�da dos dados
     * @var <string>
     */
    private $html           = '';

    /**
     * m�todo Construtor
     * faz todo o trabalho sujo da classe, chamando os m�todos internos e confeccionando os crumbs
     * por fim chama o m�todo makeCrumbs() que gera o HTML de sa�da
     * @param <string> $separator
     */
    public function  __construct( $separator = '>' ) {

        $this->separator = $separator;
        $this->protocol = $this->getProtocol();

        $this->current_url = $this->getCurrentUrl();

        $this->crumbs = $this->fragmentUrl( $this->current_url );

        $this->makeCrumbs();
    }

    /**
     * m�todo set()
     * utilizado para passar par�metros para criar os crumbs
     * @example
     * Sendo:
     * $crumb->set( array(
     *      'www.dominio.com.br'=>'Home',
     *      'noticias'          =>'Not�cias',
     *      ''                  =>'T�tulo da not�cia'
     * ) )
     * @param array $crumbs
     */
    public function set( array $crumbs ) {

        $this->crumbs = $crumbs;

        $this->makeCrumbs();
    }

    /**
     * m�todo get()
     * resgata os crumbs gerados
     * @return <array>
     */
    public function get() {

        return $this->crumbs;
    }

    /**
     * m�todo getProtocol()
     * Resgata o protocolo utilizado no acesso, testados HTTP e HTTPS
     * @return string
     */
    public function getProtocol() {

        if( isset( $_SERVER["HTTPS"] ) && $_SERVER["HTTPS"] === 'on' ) {

            $protocol = 'https://';
        } else {

            $protocol = 'http://';
        }
        return $protocol;
    }

    /**
     * m�todo getCurrentUrl()
     * Resgata o URL atual no endere�o do navegador, sem o protocolo
     * @return <string>
     */
    public function getCurrentUrl() {

        return $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    }

    /**
     * m�todo fragmentUrl()
     * Particiona um URL para montar os crumbs
     * Para criar crumbs personalizados utilize o m�todo set()
     * @param <string> $url
     * @return array
     */
    public function fragmentUrl( $url ) {

        $fragments  = array();
        $crumbs     = array();

        $_url = preg_replace( array( "/[http]s?:\/\//", "/\/$/" ), array( "", "" ), $url );

        $fragments = explode( "/", $_url );

        foreach( $fragments as $fragment ) {

            $crumbs[$fragment] = $fragment;
        }

        return $crumbs;
    }

    /**
     * m�todo makeCrumbs()
     * A m�gica final de cria��o dos breadcrumbs
     * Percorre os crumbs e gera o HTML  de sa�da
     */
    private function makeCrumbs() {

        $href = '';

        $crumbs_count = sizeof( $this->crumbs );
        $i = 1;

        $this->html = '<div class="breadcrumb">';
        foreach( $this->crumbs as $link => $inner ) {

            $href .= ( $i === 1 ) ? $this->protocol . $link : "/$link";

            if( $i === $crumbs_count ) {

                $this->html .= "<span>$inner</span>";
            } else {

                $this->html .= "<a href=\"$href\" title=\"$inner\">$inner</a> {$this->separator} ";
            }
            $i++;
        }
        $this->html .= '</div>';
    }

    /**
     * m�todo out()
     * sa�da do HTML gerado pela classe
     */
    public function out() {

        echo $this->html;
    }
}
?>