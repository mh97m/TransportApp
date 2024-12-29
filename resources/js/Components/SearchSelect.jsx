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

    const customStyles = {
        // option: (base, { isFocused }) => ({
        //     ...base,
        //     backgroundColor: isFocused ? '#014e2c' : base.backgroundColor,
        //     textAlign: 'right',
        // }),
        // placeholder: (provided) => ({ ...provided, color: '#47404f' }),
        control: (base) => ({
            ...base,
            borderColor: error ? "#f96a74" : "#dee2e6",
        }),
        // singleValue: (provided) => ({ ...provided, color: '#47404f' }),
    };
    return (
        <div
            className={`form-group col-lg-${lgLength} col-md-${mdLength} col-sm-${smLength}`}
        >
            {children}
            <label htmlFor={id}>{label}</label>
            <Select
                id={id}
                styles={customStyles}
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
