import { forwardRef, useEffect, useImperativeHandle, useRef } from 'react';
import Select from "react-select";

export default forwardRef(function SearchSelect(
    {
        label = '',
        id = 'selectId',
        name = 'selectName',
        className = '',
        placeholder = '',
        size = 'lg',
        lgLength = 6,
        mdLength = 12,
        smLength = 12,
        isFocused = false,
        error = null,
        options = [],
        value = null,
        onChange,
        isDisabled = false,
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

    const selectClass = `form-control form-control-${size} ${
        error ? 'is-invalid' : ''
    } ${className}`;

    return (
        <div
            className={`form-group col-lg-${lgLength} col-md-${mdLength} col-sm-${smLength}`}
        >
            {children}
            <label htmlFor={id}>{label}</label>
            <Select
                id={id}
                name={name}
                value={value}
                onChange={onChange}
                options={options}
                // className={selectClass}
                isDisabled={isDisabled}
                placeholder={placeholder}
                ref={localRef}
                {...props}
            />
            {error && (
                <span className="invalid-feedback" role="alert">
                    <strong>{error}</strong>
                </span>
            )}
        </div>
    );
});
