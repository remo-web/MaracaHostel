<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'maraca-db');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'remo-maraca-db');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'REMO-maraca#1');

/** Nome do host do MySQL */
define('DB_HOST', 'mysql785.umbler.com ');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ':->~[:)5]CGJ>(?coBJqd[!@Sb0NOQ-vo8<|!DyTAH$4K1y0!kw;_T!@fM2ozs3b');
define('SECURE_AUTH_KEY',  'a3!?-]rw~YWvX9 xyr56}0V{61uLZ)5(!HqI@MR/t{DHHAd?33&+T/moJvdb0^t6');
define('LOGGED_IN_KEY',    'Dm@2lGt`Od+XOph>JlScEjgYgyx9%2l/+d|RC-;luK,x0z$MwdrXc@g#80B{oMAD');
define('NONCE_KEY',        'lz3/FMuD%!DdcTv!N8rWjzu7I]7W%5C02<|^1}x]AM o(-g/bW/dnev?+l:iW]Pg');
define('AUTH_SALT',        '?Mj|;;5{ tRv>a<d<0Q-1,MYq@P?M>}8DVrpi%ODM;eXo}]D*+yjpWn881tM4HTE');
define('SECURE_AUTH_SALT', 'F1GjrW5V/3LcIWw NkKk2.Mx8B&U9&Z@ccZb90p$/Z*uUc [{aCM4frEZVnW1{4_');
define('LOGGED_IN_SALT',   'e.y+^p}-k+dgX)({FaT]Hte>c%TKe[UFe0.5r>=a%Gm*8?8o*IL; JCnUJ(yi-Zp');
define('NONCE_SALT',       'A&)+`tE=$vS9n/{WsK4m04Us8_!1`70e)pQu:_BNsJ}%1Vnn+/[3[W6),O$5%P|b');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
