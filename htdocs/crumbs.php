<?php
/**
 * Classe Breadcrumb
 * --------------------------------------------------------------------------------------------------------
 * Implementa o caminho da url na página corrente, direcionando cada parte para seu endereço dentro do site
 * --------------------------------------------------------------------------------------------------------
 * @author Josean Matias
 * @link http://www.joseanmatias.com.br
 * @copyright 2011
 * @version 1.0.2
 * @example
 * A seguinte url: www.dominio.com.br/noticias/titulo-da-noticia
 * Será automaticamente particionada pela classe para apontamento de link
 * Onde:
 * www.dominio.com.br   -> apontará para a página inicial
 * noticias             -> apontará para a página de listagem de noticias
 * titulo-da-noticia    -> será a página específica da notícia, neste caso não tem link.
 * -------------------------------
 * Caso a url não esteja no formato amigável, os fragmentos e links devem ser passados utilizando o método set()
 * Sendo:
 * $crumb->set( array(
 *      'www.dominio.com.br'=>'Home',
 *      'noticias'          =>'Notícias',
 *      ''                  =>'Título da notícia'
 * ) )
 */
class Breadcrumb {

    /**
     * o URL atual no endereço do navegador, sem o protocolo
     * @var <string>
     */
    private $current_url    = '';

    /**
     * o protocolo de navegação. Testados apenas HTTP e HTTPS
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
     * O conteúdo HTML gerado pela classe e colocado na saída dos dados
     * @var <string>
     */
    private $html           = '';

    /**
     * método Construtor
     * faz todo o trabalho sujo da classe, chamando os métodos internos e confeccionando os crumbs
     * por fim chama o método makeCrumbs() que gera o HTML de saída
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
     * método set()
     * utilizado para passar parâmetros para criar os crumbs
     * @example
     * Sendo:
     * $crumb->set( array(
     *      'www.dominio.com.br'=>'Home',
     *      'noticias'          =>'Notícias',
     *      ''                  =>'Título da notícia'
     * ) )
     * @param array $crumbs
     */
    public function set( array $crumbs ) {

        $this->crumbs = $crumbs;

        $this->makeCrumbs();
    }

    /**
     * método get()
     * resgata os crumbs gerados
     * @return <array>
     */
    public function get() {

        return $this->crumbs;
    }

    /**
     * método getProtocol()
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
     * método getCurrentUrl()
     * Resgata o URL atual no endereço do navegador, sem o protocolo
     * @return <string>
     */
    public function getCurrentUrl() {

        return $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    }

    /**
     * método fragmentUrl()
     * Particiona um URL para montar os crumbs
     * Para criar crumbs personalizados utilize o método set()
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
     * método makeCrumbs()
     * A mágica final de criação dos breadcrumbs
     * Percorre os crumbs e gera o HTML  de saída
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
     * método out()
     * saída do HTML gerado pela classe
     */
    public function out() {

        echo $this->html;
    }
}
?>