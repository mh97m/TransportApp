import React from 'react';

export default function TextAreaInput({
    size = 'lg',
    lgLength = '12',
    mdLength = '12',
    smLength = '12',
    rows = '8',
    label = '',
    disabled = false,
    errors = null,
    ...props
}) {
    return (
        <div className={`form-group col-lg-${lgLength} col-md-${mdLength} col-sm-${smLength}`}>
            {label && (
                <label className="font-weight-bold text-dark text-2">
                    {label}
                </label>
            )}
            <textarea
                dir="rtl"
                className={`form-control form-control-${size} text-left ${errors ? 'is-invalid' : ''}`}
                maxLength="5000"
                rows={rows}
                disabled={disabled}
                {...props}
            />
            {errors && errors.map((error, index) => (
                <span key={index} className="invalid-feedback" role="alert">
                    <strong>{error}</strong>
                </span>
            ))}
        </div>
    );
}
