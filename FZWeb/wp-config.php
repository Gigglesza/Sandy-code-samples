<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'fuzzytvw_db');
define('DB_PORT', '3306');

/** MySQL database username */
define('DB_USER', 'fuzzytvw_usr');

/** MySQL database password */
define('DB_PASSWORD', 'kxB4Hcn9');

/** MySQL hostname */
define('DB_HOST', 'poisonivy.aserv.co.za');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
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
define('AUTH_KEY',         'V4#s_!iKSc[5p3!E^;P>+#$z3.Gz<FJ^3a^ID]9H^E0VX1BUE%=||2|R~U99^88V');
define('SECURE_AUTH_KEY',  'YPWD2p>ET?gb>nW+:i_;wW6rvWj8bg2,.:s}5?a`+98hZIn_Hsi0J#ns7`Ok`VvA');
define('LOGGED_IN_KEY',    '40A+cm!CX{7Ocl5f+;#hy4>{4-M~&EQZ&9KlBBDD2xSQ^^[zLk#Na~h)`9im``{]');
define('NONCE_KEY',        '8L~@G29C04^=+^LZLb,2&s~V{HZJH#+*po)BlXY|1ol3^!wN*YiYF`WSGkDg2Zt4');
define('AUTH_SALT',        '/~b|NJ`2*fv/084s&_LTu<^S+0G_{C#Xc!kuMPC~|+%f#=a81,_ZJg&|&~N;c|X[');
define('SECURE_AUTH_SALT', '@+BXD%Z4p|Ll@Su3?wr[60V(01XoF$?b-8q+}2yb|p!;:p,V+ky]Fn5mQ!45Aa]b');
define('LOGGED_IN_SALT',   'FDq}j_%E[cQ/vU|kQ#-}T33597ik8*_4r*AGayQ2f2[$Z|kNbyx*,Dz@ )>UG(w>');
define('NONCE_SALT',       '+z14t/L@~4haS=)HnpyRpimiN+KO;(u{|-ML:D(1EI|.EbBk&4|M>9(?)o)//eKA');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
