import { forwardRef, useEffect, useImperativeHandle, useRef } from 'react';

export default forwardRef(function Input(
    {
        label = '',
        type = 'text',
        id = 'inputId',
        name = 'inputName',
        className = '',
        placeholder = '',
        size = 'lg',
        lgLength = 12,
        mdLength = 12,
        smLength = 12,
        isFocused = false,
        errors = null,
        children,
        ...props
    },
    ref,
) {
    const localRef = useRef(null);

    useImperativeHandle(ref, () => ({
        focus: () => localRef.current?.focus(),
    }));

    useEffect(() => {
        if (isFocused) {
            localRef.current?.focus();
        }
    }, [isFocused]);

    const inputClass = `form-control form-control-${size} ${
        errors ? 'is-invalid' : ''
    } ${className}`;

    return (
        <div
            className={`col-lg-${lgLength} col-md-${mdLength} col-sm-${smLength}`}
        >
            {children}
            <label htmlFor={id}>{label}</label>
            <input
                dir="rtl"
                type={type}
                id={id}
                name={name}
                className={inputClass}
                placeholder={placeholder}
                ref={localRef}
                {...props}
            />
            {errors &&
                errors.map((error, index) => (
                    <span key={index} className="invalid-feedback" role="alert">
                        <strong>{error}</strong>
                    </span>
                ))}
        </div>
    );
});
