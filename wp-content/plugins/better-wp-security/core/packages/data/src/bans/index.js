/**
 * WordPress dependencies
 */
import { registerStore } from '@wordpress/data';

/**
 * Internal dependencies
 */
import controls from '../controls';
import * as actions from './actions';
import * as selectors from './selectors';
import * as resolvers from './resolvers';
import reducer from './reducers';

registerStore( 'ithemes-security/bans', {
	controls,
	actions,
	selectors,
	resolvers,
	reducer,
} );
