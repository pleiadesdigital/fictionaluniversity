<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //

if (file_exists(dirname(__FILE__) . '/local.php')) {
  // Local database settings
  define('DB_NAME', 'fictionaluniversity');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'n1col3');
  define('DB_HOST', 'localhost');
} else {
  // Live database settings
  define('DB_NAME', 'pleiades_universitydata');
  define('DB_USER', 'pleiades_admin');
  define('DB_PASSWORD', 't3l3cast3r');
  define('DB_HOST', 'localhost');
}

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '2+H?r>MO!zu=j!t|&.3tS(i-&R<]*ju`5-)B.Akb8C5q!`TEqhL+7S<PRrz[}9`e');
define('SECURE_AUTH_KEY', 'r-3nSFv;zwE8Xos9]Z8)3r#tD$Maw@Zl_4Pi1;Zf}0z5%Ya;V^W#M<|$.{(uXpJ?');
define('LOGGED_IN_KEY', '.wAi@pa<izJyG3iTV~DWOGM&0<5#|y] K}H_xd)8$m+uhUxc+qX_zS?>j8dL3f3g');
define('NONCE_KEY', 'El#&y_4QwC)dDMuA!&<h29-~D|c2@c~Pp+Tbb<UgrE S@C1 |gD.S-v?**($M/,W');
define('AUTH_SALT', '6[L,7r y9wdv-7FGGQl@I@E0ftZv^]U$#wfG Q:C{2+kr^+9-*6Bt`47@_gyAW%%');
define('SECURE_AUTH_SALT', '!3l#9 y0WImoXa`YZ^Z[&=$ghIjpY{Oyjybp7c]Z7j1VY*K4X8{|D{B+iHC$||41');
define('LOGGED_IN_SALT', '/*RDEq 8|Xv@|xEh:Oej6F!~,8-^NLI5b%+V;M|cx0z~y4I|efyaMcB_e,RZZyIF');
define('NONCE_SALT', '{rl3.5I,k.GMnWII6[%0|!hLi{MwY#*nm4n^6t4%.!GrLhCy-Zn|2(CQs{zIN&,t');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
