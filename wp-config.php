<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpressAPI' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '$3aH/gJ/s2C/rWiILUR+>UdT_0FIr BgzZ%a:u]v Are%oZY.}HJI5T%h_&:TTn)' );
define( 'SECURE_AUTH_KEY',  'D]Reh<[8dNaI:U!hL`>p ^/^xjQ2::y_c&.Es!R(TQ#ba;Z[C= ?M#4F (mLVwcI' );
define( 'LOGGED_IN_KEY',    'VwD2am%T&F_qhnQ&0(< W2[qkLa/$=_V8?4~@P@X;~q%)aC(7SL+jdy[?9(;`Mec' );
define( 'NONCE_KEY',        '-82PUgtjnxqfny+x!P=W Bl*ebday@a:Y!|gB2kxw53/UVP9j9to&*?sCrc]?,A ' );
define( 'AUTH_SALT',        '[K~j+S,(5TA[yn^e)i4On*:VylDo8Z>iV>GT%k(! q8%h8sE~6mu=3_lGv`p>6C.' );
define( 'SECURE_AUTH_SALT', 'NOCB0kD];Axp4`LkD>Eo)1R6Y+63tF|a={Ilt(+bsYlXkC:5$Wv{~`7VeIE?L3^~' );
define( 'LOGGED_IN_SALT',   '=w8d7[P#wv8:J@ydPD{nN~Pu%tYa,!ACdS6L}6`h`#jnC_7LTH2X:5<VuP}T?J2U' );
define( 'NONCE_SALT',       'Mcg:H|6pC)#r1//G^ a6S&[sn7UK}._`_AOn4;:DljMGrr$swdZ[Pe|2AYHQ;!MI' );
define( 'API_URL', 'https://www.biddetail.com/kenya/C62A8CB5DD405E768CAD792637AC0446/F4454993C1DE1AB1948A9D33364FA9CC');

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
