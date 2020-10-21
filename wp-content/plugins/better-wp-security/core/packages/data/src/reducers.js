/**
 * Internal dependencies
 */
import { RECEIVE_ACTOR_TYPES, RECEIVE_ACTORS, RECEIVE_INDEX, RECEIVE_USER } from './actions';

const DEFAULT_STATE = {
	users: {
		byId: {},
	},
	index: null,
	actors: {
		types: [],
		byType: {},
	},
};

export default function reducer( state = DEFAULT_STATE, action ) {
	switch ( action.type ) {
		case RECEIVE_INDEX:
			return {
				...state,
				index: action.index,
			};
		case RECEIVE_USER:
			return {
				...state,
				users: {
					...state.users,
					byId: {
						...state.users.byId,
						[ action.user.id ]: action.user,
					},
				},
			};
		case RECEIVE_ACTOR_TYPES:
			return {
				...state,
				actors: {
					...state.actors,
					types: action.types,
				},
			};
		case RECEIVE_ACTORS:
			return {
				...state,
				actors: {
					...state.actors,
					byType: {
						...state.actors.byType,
						[ action.actorType ]: action.actors,
					},
				},
			};
		default:
			return state;
	}
}
