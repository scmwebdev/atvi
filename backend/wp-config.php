<?php
include 'env.php';

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
define('DB_NAME', $env_config['db_name']);

/** MySQL database username */
// define('DB_USER', 'root');
define('DB_USER', $env_config['db_user']);

/** MySQL database password */
define('DB_PASSWORD', $env_config['db_pass']);

/** MySQL hostname */
define('DB_HOST', $env_config['db_host']);

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
define('AUTH_KEY',         '_rep{H[+9E5|6<+{-0%!4-]yMNS5neDMxP*qgHrnz$w1<|4r3()(|?h/l)nV|l)g');
define('SECURE_AUTH_KEY',  'C2RY;h(JN,-JBtw36zM(J7cx{)yQpnY>slPgUqF|nKJEYBje{N_DKL>|rF=pA.J&');
define('LOGGED_IN_KEY',    '8`8Qc&K1zO0>`*Hj&t$h&E7s(QX*sTv<#aOaJq$L!qa6UI8~H15lGRgO$L5#|X^y');
define('NONCE_KEY',        'w]f9tn|}hc;MwofnRgFF-{DV0u=D/qq<Ax8-KHxqHjpdmu|(+`)u%R[:WU;$M0V-');
define('AUTH_SALT',        '@3WoN|BYIDkdEuxePe}b5ZLl|AaI%9M)uE./8#cmlo[-hTn+-_-M?-14}jTwsjnF');
define('SECURE_AUTH_SALT', '-9U{G|+MDTZmzRLuhFIs;V}5505TM<[zI~%w >;xXx2LtrIg40K=jeZWFd,ZZEy1');
define('LOGGED_IN_SALT',   'GQ*Ic}g0esXn~(^SBjO-+uV>R0nOkjyD-{|9*^?V.>!JYGgJ]+0+V^(Zy(2J{HZ?');
define('NONCE_SALT',       'Zr)~|gd{#?-.}-W4x)`Z&x*CA5:LU8qTTFL7@YY2u17&_0znR%:89&|/$R0UzJFH');

/* ** set wordpress folder and site url dynamic ** */
define('WP_HOME', 'http://'. $env_config['home'] );
define('WP_SITEURL', 'http://'. $env_config['host'] );
/* ** end ** */

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
