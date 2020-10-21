/**
 * External dependencies
 */
import { utils } from '@rjsf/core';

/**
 * WordPress dependencies
 */
import { Button, TextControl } from '@wordpress/components';

const { ADDITIONAL_PROPERTY_FLAG } = utils;

export default function FieldTemplate( props ) {
	const {
		children,
		errors,
		hidden,
	} = props;

	if ( hidden ) {
		/*return <div className="hidden">{ children }</div>;*/
		return null;
	}

	return (
		<WrapIfAdditional { ...props }>
			{ children }
			{ ( ! props.formContext || ! props.formContext.disableInlineErrors ) && errors }
		</WrapIfAdditional>
	);
}

function WrapIfAdditional( props ) {
	const {
		id,
		classNames,
		disabled,
		label,
		onKeyChange,
		onDropPropertyClick,
		readonly,
		required,
		schema,
	} = props;
	const keyLabel = `${ label } Key`; // i18n ?
	const additional = schema.hasOwnProperty( ADDITIONAL_PROPERTY_FLAG );

	if ( ! additional ) {
		return <div className={ classNames }>{ props.children }</div>;
	}

	return (
		<div className={ classNames }>
			<div className="row">
				<div className="col-xs-5 form-additional">
					<TextControl
						label={ keyLabel }
						required={ required }
						id={ `${ id }-key` }
						onBlur={ ( e ) => onKeyChange( e.target.value ) }
					/>
				</div>
				<div className="form-additional form-group col-xs-5">
					{ props.children }
				</div>
				<div className="col-xs-2">
					<Button
						icon="no-alt"
						isDestrictuve
						disabled={ disabled || readonly }
						onClick={ onDropPropertyClick( label ) }
					/>
				</div>
			</div>
		</div>
	);
}
