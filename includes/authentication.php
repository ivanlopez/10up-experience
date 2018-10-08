<?php
/**
 * Authentication functionality
 *
 * @package  10up-experience
 */

namespace tenup;

/**
 * Prevent users from authenticating if they are using a weak password
 *
 * @param \WP_User $user     WordPress user object
 * @param string   $username User provided username during login
 * @param string   $password User provided password during login
 *
 * @return \WP_User|\WP_Error
 */
function prevent_weak_password_auth( $user, $username, $password ) {
	if ( in_array( $password, weak_passwords(), true ) ) {
		return new \WP_Error( 'Auth Error', sprintf( '%s <a href="%s">%s</a> %s',
			__( 'Please', 'tenup' ),
			esc_url( wp_lostpassword_url() ),
			__( 'reset your password', 'tenup' ),
			__( 'in order to meet recently improved security measures.', 'tenup' )
		) );
	}

	return $user;
}

add_filter( 'authenticate', __NAMESPACE__ . '\prevent_weak_password_auth', 30, 3 );

/**
 * List of the most popular weak passwords
 *
 * @return array
 */
function weak_passwords() {
	return array(
		'123456',
		'Password',
		'password',
		'12345678',
		'qwerty',
		'12345',
		'123456789',
		'letmein',
		'1234567',
		'football',
		'iloveyou',
		'admin',
		'welcome',
		'monkey',
		'login',
		'abc123',
		'starwars',
		'123123',
		'dragon',
		'passw0rd',
		'master',
		'hello',
		'freedom',
		'whatever',
		'qazwsx',
		'trustno1',
		'654321',
		'jordan23',
		'harley',
		'password1',
		'1234',
		'robert',
		'matthew',
		'jordan',
		'asshole',
		'daniel',
	);
}
