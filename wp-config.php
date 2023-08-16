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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'machava' );

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
define( 'AUTH_KEY',         'CbykK+S6lsO[%<7f8_tN9MH|BJ2:KvS^5BwN^tpyGBd}R@j=IK>[NC[hTM3;^U%2' );
define( 'SECURE_AUTH_KEY',  '{uTT|$9Y!Om$Sz*`gTKs9?La5Cto0}d|6]5ky]m!AmM%aMhyajs)IcqT@ y`)k#J' );
define( 'LOGGED_IN_KEY',    'N,FK(*ih4vlLWg)0EfAf0x IV7H1p:$xahkCsVZVu0.diLD!]o/-lAU)Mqx}UW=~' );
define( 'NONCE_KEY',        'ak/FbSMbW4xrv[=:E0CRa$2E0W9u6*0la[|K;UI,AS%mr#.w&Lhral7*px{@4/<l' );
define( 'AUTH_SALT',        'y6&&qc?jMj#;&6T0CpZ!u`ta)pCIl#geDo^B9F9/O4[^!&/9FQ+cm3`H6|3N*)Z[' );
define( 'SECURE_AUTH_SALT', 'm^&]$h9@Va:FTVE8sAhmlKk<AnOZ%U1-M{z-fG5o/J.oh78>la-lruIyhQLjUTt+' );
define( 'LOGGED_IN_SALT',   'w1Sn7Y*]Rm+_<J/,!FiI%#0GXxrab2U(foj;P3pTSQKVyRptBz4v8d-tOTk_{,}*' );
define( 'NONCE_SALT',       'OQ(0CAy!X3:x?$24TblWj.sOR4K9[TJ?Fma5 #nUi6c34[u3teZp4q$MG{20&u^ ' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
