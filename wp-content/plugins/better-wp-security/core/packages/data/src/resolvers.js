/**
 * External dependencies
 */
import { get } from 'lodash';

/**
 * Internal dependencies
 */
import { apiFetch, select } from './controls';
import { receiveActors, receiveActorTypes, receiveIndex, receiveUser } from './actions';

export function* getIndex() {
	const index = yield apiFetch( { path: '/ithemes-security/v1?context=help' } );
	yield receiveIndex( index );
}

export const getUser = {
	* fulfill( userId ) {
		const user = yield apiFetch( {
			path: `/wp/v2/users/${ userId }`,
		} );

		yield receiveUser( user );
	},
	isFulfilled( state, userId ) {
		return !! state.users.byId[ userId ];
	},
};

export const getActorTypes = {
	* fulfill() {
		const response = yield apiFetch( {
			path: '/ithemes-security/v1/actors?_embed=1',
		} );

		const types = [];

		for ( const type of response ) {
			const actors = get( type, [ '_embedded', 'wp:items', 0 ], [] );

			yield receiveActors( type.slug, actors );
			types.push( { slug: type.slug, label: type.label } );
		}

		yield receiveActorTypes( types );
	},

	isFulfilled( state ) {
		return state.actors.types.length > 0;
	},
};

export const getActors = {
	*fulfill() {
		yield select( 'ithemes-security/core', 'getActorTypes' );
	},
	isFulfilled( state, type ) {
		return !! state.actors.byType[ type ];
	},
};
