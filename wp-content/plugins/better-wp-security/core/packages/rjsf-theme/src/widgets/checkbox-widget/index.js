/**
 * External dependencies
 */
import { utils } from '@rjsf/core';

/**
 * WordPress dependencies
 */
import { CheckboxControl } from '@wordpress/components';

export default function CheckboxWidget( {
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
} ) {
	const required = utils.schemaRequiresTrueValue( schema );

	return (
		<CheckboxControl
			id={ id }
			value={ value }
			onChange={ onChange }
			required={ required }
			disabled={ disabled }
			readonly={ readonly }
			label={ label }
			help={ uiSchema[ 'ui:description' ] || schema.description }
			onBlur={ onBlur && ( ( e ) => onBlur( id, e.target.checked ) ) }
			onFocus={ onFocus && ( ( e ) => onFocus( id, e.target.checked ) ) }
		/>
	);
}
