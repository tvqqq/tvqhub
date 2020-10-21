/**
 * External dependencies
 */
import { without } from 'lodash';

/**
 * WordPress dependencies
 */
import { TextareaControl } from '@wordpress/components';

export default function TextareaWidget( {
	schema,
	uiSchema = {},
	id,
	value,
	disabled,
	readonly,
	label,
	onBlur,
	onFocus,
	onChange,
	...inputProps
} ) {
	return (
		<TextareaControl
			id={ id }
			value={ typeof value === 'undefined' ? '' : value }
			onChange={ onChange }
			disabled={ disabled }
			readOnly={ readonly }
			label={ label }
			help={ uiSchema[ 'ui:description' ] || schema.description }
			onBlur={ onBlur && ( ( e ) => onBlur( id, e.target.value ) ) }
			onFocus={ onFocus && ( ( e ) => onFocus( id, e.target.value ) ) }
			{ ...without( inputProps, [ 'autofocus', 'formContext', 'registry', 'rawErrors' ] ) }
		/>
	);
}
