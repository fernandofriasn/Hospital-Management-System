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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '[lFpO<;M&J}*(wA;kNareL4fcx{gc6{UTu/3Ch7O)fdWvLla>b{d$]obFFHy#h.1' );
define( 'SECURE_AUTH_KEY',  '<D:Lm?ZbM;FtW S}8/RFY =MRr!-Z!u;?r)V@4:}P}$5HI>u&boOj^pq<]g.MKBZ' );
define( 'LOGGED_IN_KEY',    'D:L-m0[9.19SOo@Xg!~&0T)@2: xBCWF^+-_~eP[z@U}/yAG2uf_IGyjn+1YQcfC' );
define( 'NONCE_KEY',        'RVi!,Z^;]yUX8Z`%+pZAIAea^J9Qy=df3f.2jR_/4AI:])U85_)&]y_j!YuS1VwD' );
define( 'AUTH_SALT',        'WM^3k7++/4d.j2:fx:, |qqvXS-!7*wiF$aAJa~/}/H@D0D!o)1NzPURc=%0i2[U' );
define( 'SECURE_AUTH_SALT', 't ?t^4j7]pj*ps];.#C*c|i+bbIzL&3 luLY:/F&41(MM&?<Gmxi3VoV)GR{K;*g' );
define( 'LOGGED_IN_SALT',   'XnDG+LKz8tMAzZ.XJ!EYDI% k::hTC(g8eO$Q+iI(8ab+%38F&Hae$M2J}lQBvC%' );
define( 'NONCE_SALT',       '3@UUBWl,oD;DSOk=LE4a-}~I.yxHthndRUx.*T]_0uQn$0:Qml$}e(NR?,TW1BpH' );

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
