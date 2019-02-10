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
define('DB_NAME', 'wp_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'WfC1_lkfG`kyWKKH)l/W1w=cwd?2I>.b{~vfZIw~N<}u5)=5dIj98,qOyARZA%k9');
define('SECURE_AUTH_KEY',  'Be|$1${5Qgt[:1;3u}M<%*+FPW T35-Vh)??iro)#g^&p6&EHZ1pqPDYm&-,!F1`');
define('LOGGED_IN_KEY',    'wL d-Ht;r<@BRx?9(%BkeM+LygK_#alS~?[/Pqhz{};?!m&m2DMYL)Y:$/;&AqJ{');
define('NONCE_KEY',        'ZqXnI7i1hfk%is~u r<#o}JDT{RnEf[:Vib2yQU@-DVJea:y+xD#a!hRj$5!<g7S');
define('AUTH_SALT',        '?=Rr56;<(C{_0oJ~RkzB!`pQ3BPlKFcy~66]O.%hsf7LThoJ{36k}[>Hi*JaZ*r7');
define('SECURE_AUTH_SALT', '{h>9?I*6)}/>*tkToSJSta9*%CU#j9,izVc{pL.Zkb`zq0)VZ>Q<eNsS4RRy--ID');
define('LOGGED_IN_SALT',   'DN2_v?h(-Y-sZ7vQzw#h<%xY}v[>NPsAK;p.Y/bFVWD!N4fb$B:cPAf6Kw}5Op=O');
define('NONCE_SALT',       'ia4Y%mRF*TSt79gC[iNZn}Wg %?Sun0mJ.*8h:E7CP6m.lP<`/@ k(hIK$ Z?/c>');

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
