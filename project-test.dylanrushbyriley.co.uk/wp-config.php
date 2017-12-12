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
define('DB_NAME', 'dylanrushbyriley_project-test');

/** MySQL database username */
define('DB_USER', 'dylanrushbyriley_sysadmin');

/** MySQL database password */
define('DB_PASSWORD', 'Nmhardcastle02');

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
define('AUTH_KEY',         'AVBK3GskVCZY|x8PeYBMbo4!.ftVkdxTc[(hvbxZ$/f1vfm(HU0#+Uy<N6jQfwO;');
define('SECURE_AUTH_KEY',  'Z;CVx)M/Yx7WkzSMx%04*UwshA5GN8nzUXZkz1`xQhOTIY1xX;F;8i214<hOAD_e');
define('LOGGED_IN_KEY',    '~@+7Y4^UMe+Q{^0@&StZl.&_^Pm^raK;Ou gX6%$zx%|Q:n<5N3V/|Wi6kv%8r%h');
define('NONCE_KEY',        'mUZ2yfThB!u k0!9QhYpSBUlwx+4t;Og1u{#[&xOTDDc}M!Qq3)8]XH16=gG+rXC');
define('AUTH_SALT',        'L,fqJA=,Ki5V}}gasPfKl=MO:5zzXxm2ky6~Zezq?i>J_HXz2efaGOKd%V=_0<q#');
define('SECURE_AUTH_SALT', 'Sv04V$<?80|]@`^NJZlp(~^t86)F)bCY,t{aRsr$;{ZQypJQX0zM(/-ix},&:p`c');
define('LOGGED_IN_SALT',   'XMYr4E?_SwAlG]y]F .%oFH`fU!F9%5_}0-.Ma]IVC^2Ki6V/I%yBon]3~rg^usO');
define('NONCE_SALT',       'd}Twsf1j4@?FB0HLU->3nYFZO[$n7m_7+d{r2ehF.ALKTg42UyE6#;BeB[-XY,JI');

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
