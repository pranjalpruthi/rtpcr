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
define('AUTH_KEY',         'A M(pxK}+TI|<mp0S<n,A!`8)J21}G/lD6b,lgCT0(+;J=~+YU2c?<p:>ym8VNS]');
define('SECURE_AUTH_KEY',  'Kq1kj%P8[g;/=X:~c77lM1mTvrrBe_G4iL/k(%hbW@H!KBAm |QYD)72 8g_3!ur');
define('LOGGED_IN_KEY',    ',s=[f-~NFKF)@{25cI^+v$;RW]W544#6PSD6VJwcM|.~nw!-_!rlw)6iz~OD>if_');
define('NONCE_KEY',        'v#YrH;l0C`IB=C)a^}5>6q<Q9.GvE.l@WQuBZK[WzU>M8ZO!.1BuT*|$?BopIV?s');
define('AUTH_SALT',        'Q]>PHi{v.0?[D]UB6V&j~xr[-nv^kF1BulU4?0Tgj#eUXPDZ~aT!3.Y.Jy=r|yi6');
define('SECURE_AUTH_SALT', 'Of$W$<w++:kWZk9;02%v/Z|E-,zMa91G}cHv}2#p3GCL@:zjX:(LBM{*/Mz10m6D');
define('LOGGED_IN_SALT',   'R|(IGq@!oqBKYvD]s#[%9Nb<{Fn#-VmRof=c&>H~EH{fQV>]gAKt1)ITzgCx~:R2');
define('NONCE_SALT',       'e4,_aGr%(Mw@zD5z!Sn|Mg|?IP&Lk&16z2Olyl,qxOxcv):v,ZCr0j-Ch,c.Z$5V');

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
