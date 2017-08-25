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
/** The name of the database for WordPress */
define('DB_NAME', 'new_casasoriano');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'M;^M3*nSp@`):^a8SF>+X} 4(%qJ-0eSSJbGH1*ydT4a8?.;=/^k;ig#JoLrhK2J');
define('SECURE_AUTH_KEY',  ';$7+}14}w}Ah/fw6z8LkU`Mq$Z8bS[WWon@yERvw?%Y<#:.De2]YNAL$!j|a{qKf');
define('LOGGED_IN_KEY',    'wo}ybU% eA1C!).N^+djy:|j~$,f/]z^,zo4y Yh^`(Sm7?J.]^Wa6!rXIgZuFA7');
define('NONCE_KEY',        'c?plHpU[()hzdA_XvQ9CBhYOU23f)ZYnyc@IVMkN)q,%c`y3[w6^Ei#~84##blUU');
define('AUTH_SALT',        '+~DBPI0B^IYat*f.-v<KMgfscO<29.x]pw==aldSS.t!bLU|dZ]G>Y]vG&o>12h_');
define('SECURE_AUTH_SALT', 'eT&l{q5<p[_-(lXDZtVP;z9/sARXE?x7af-yNfM{csxyOcAZ5TLujiFdeq$Uf$*T');
define('LOGGED_IN_SALT',   '0@]rEnwL{W{WkRoM#<hs(IWNahe7X8U;Mj~J3I5`yU~8q[JhHXwerDQ 2e&1]$mP');
define('NONCE_SALT',       'r+|%(?dr:Y:@*x}YV5ay}MYiM?uw^bAtsUp?(86NXcAkc|I]&D:;.pex6PdoR>.,');

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
