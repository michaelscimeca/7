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
define('DB_NAME', 'db-name');

/** MySQL database username */
define('DB_USER', 'db-username');

/** MySQL database password */
define('DB_PASSWORD', 'db-password');

/** MySQL hostname */
define('DB_HOST', 'rds.redsquareagency.com');

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
define('AUTH_KEY',         '=zgPG|F1%z)=47(`kaj738ODndwcy8aX<rY5oW|.&/$kEV_eT%//6DU]Oh:tPjDY');
define('SECURE_AUTH_KEY',  'y:-TsYVC`I^olYh.{ZQ!l)srg| V%0S*:H2]40ZLYgoi1%MiJNg-JtCnA4k+n.%<');
define('LOGGED_IN_KEY',    'B 8?eN%`w]pDr@Ld}cp^WdgWl5nD4^Hf3-~#@wmu`R)}{(R;&ANuz>{#d?4-GTGR');
define('NONCE_KEY',        'zQ[+mYa=[E:6smB#WF-7<zjN:+H#($wH-t3sz@?0cvz$}<v7eW5y.OZxR+4ZoP=B');
define('AUTH_SALT',        '5a3<^(ps<t`.?^pi8qsnxQXrk?.d|Sv9VGJ{B&-?A{FA+D<?627M]Da[qsPJu.x-');
define('SECURE_AUTH_SALT', '$hJQMinKhvpDSSMsx)@-jDy5w!nNPE:!k.;}AGJl$n!xCOkov/mr!YH:WUMebE,h');
define('LOGGED_IN_SALT',   'ssV^_<2BhktW+8u0aT/vst`UZ1zw_v9jJ,).SSmZviMgS[>C9/SpLw#0qf)VbG9N');
define('NONCE_SALT',       '`_g8l(dzCmLj0^}4[=Ssxh8Mp*I29DzuQ5jPsce32N2%](crMRNA2T=-tYe(#xS}');

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

if ($_ENV['DOMAIN']) {
    $_SERVER['HTTPS']='off';
    define('WP_HOME',$_ENV['DOMAIN']);
    define('WP_SITEURL',$_ENV['DOMAIN']);
} else {
    $_SERVER['HTTPS']='on';
    define('WP_HOME','http://localhost');
    define('WP_SITEURL','http://localhost');
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
