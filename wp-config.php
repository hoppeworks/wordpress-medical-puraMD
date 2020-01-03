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
define( 'DB_NAME', 'post' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'lcbab.8)g|,]9pC+Um9BU!XvWb5JzUM8g|;c`-95ut*WWMXRkDXtNFi!Wc:dq$aF' );
define( 'SECURE_AUTH_KEY',  'S`3!0[7<p|PNM/^7p&8Vmw!MndE@g2WT1j,!(boy<LqkF7`*g:qXbT~H/]jW.zYH' );
define( 'LOGGED_IN_KEY',    '7_=-B#kmq@_|;bjQZ6M8~E)t.g(el+JRzH1AAPmWZ5}kjWzrpzO+q<oQ4H<[~pqU' );
define( 'NONCE_KEY',        'Hn+b_6>-Clgnu2fhR=5{?oB+ 2,9Ms*rC&dxpSRVP)ya=j^q ce]rx:xUxL*MbU#' );
define( 'AUTH_SALT',        'K=[PmgU:Tl*(_X^Zi@S$j@d,!X=<Y_s?i.16mRVg#!t-tYy^s%{>GX9*Er6Y]W04' );
define( 'SECURE_AUTH_SALT', 'T2?v>Jow q<d#||YB.M;z|iUyNV?{UK!<3n%ry&ThzPa9`Zlk#<+uHx_2kW4mYtM' );
define( 'LOGGED_IN_SALT',   'KnqL:Wcp^4xk|;={O.tGCABbsV3;N29vUnmmwaRY.d[{}t|+13n[l`ECvj7sg@[h' );
define( 'NONCE_SALT',       'IjR=6wS|g8p@1ow&[AAaU,K7-PNlQOptEEsbi}Y5D#]opfrk{A|GClqumrq|G*@M' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
