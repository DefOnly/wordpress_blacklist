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
define( 'DB_PASSWORD', 'def1992' );

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
define( 'AUTH_KEY',         ';mpat|M9h<8*3LT!P>kcoYK.$rH8@!(TqcZLf yyT98.@YBH!D`L@N=0Q:FQW>g0' );
define( 'SECURE_AUTH_KEY',  'wt+k49jg`a!#;L=cSnWD|`<VQ^g?Ip=.{@!$#dV[;E32/G&%rA8y^4UGL;~ytcO0' );
define( 'LOGGED_IN_KEY',    'Ya&~ZLHOX%kzRV64ml~DbiGqkN*vCEAZri84KKWYg,Ah+U0x*2S@al[]K$exihSU' );
define( 'NONCE_KEY',        '@d9[7(sIpJ}etta20g:Q|[c7m|6DFcHI7X =L=yz#rpJm|`|WE>E%{$*#!CKxB*b' );
define( 'AUTH_SALT',        '6~{G#)hu6cW#FzYG1KP,ayD&D|CBT_.wEcdZrB*pa]zzfEfOi4YyM$pE:tMN,JAt' );
define( 'SECURE_AUTH_SALT', '-#$ $-Wdy%q_k@6up,!K  M Dl5~:0R7e=55**i?,hwC6z4$aoviTl}.BWJF9KeR' );
define( 'LOGGED_IN_SALT',   'eU(c,3_RNNY}<QkJW~D;vx^=rTi1Rx/ DNAZjHR:7g|_!Wt<&{ksakfDg2|_Hl2e' );
define( 'NONCE_SALT',       ' !@9 hmBT r=o<jS:Wr)nA Qu#(j2b)tt0awdgxeJ*#|rMt}cg]h+`8IWeT8-:+?' );

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
