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

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', 'd8b7d72460a49ec3eadc5b498c14bc57b4d01a99dff3e342e7bf12feec6107d7' );


/** Database hostname */

define( 'DB_HOST', 'localhost:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


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

define( 'AUTH_KEY',         'KPff|_Hk.Dm<_0L%HOEI(N-:0Y,9IC=Y)@lRPtI L|7!kVvcC|-?Zxr?9tMQ*!+Q' );

define( 'SECURE_AUTH_KEY',  '.@n:MT?2+L%^h(&:x*Z`#7FY)Mw)+{(8CafF-:tj,H;g9OIK3TUV0Xc KNKE!z)1' );

define( 'LOGGED_IN_KEY',    'YHSuQ2QX8EY1V>jaEtM;VTvogI_o_;cWHOMyCMtTEA!3;h{yWk}].w6D0Che(J3[' );

define( 'NONCE_KEY',        'U|c ! ZvX^Ez6mg!;]@=<{`:LG@jl> ]<r>YyylLA^XmQI37h5Gux&<77RVNc:R@' );

define( 'AUTH_SALT',        '6Dw6WYUuB-3~>jp]b?yjw2Q)NHtJ-/j1|6m?hRfw>mE C%^P>Rb>Q>? )W2U9poQ' );

define( 'SECURE_AUTH_SALT', '##8YjB>Z*;oTfZocx}5)WkL:Kb_#]~Ps}=1QpZZhlRTY_rRD1jn{B5Aw}A)iRJ/G' );

define( 'LOGGED_IN_SALT',   'BbZ3rPI8.T>RJ=k=Oz/;8DgsZ.JBQ68mP7HpXzk0mOnyl w84FNx<IzoS$=1x;XH' );

define( 'NONCE_SALT',       'dHL]e{1X K4s0pi^rr@i%M$c`Nmo 5uFk1(Vw09|X$5$gw38#GYq=JqT--P~e,A_' );


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




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
