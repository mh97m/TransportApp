import { forwardRef, useEffect, useImperativeHandle, useRef, useState } from 'react';

export default forwardRef(function TextAreaInput(
    {
        label = '',
        type = 'text',
        id = 'inputId',
        name = 'inputName',
        className = '',
        placeholder = '',
        size = 'md',
        rows = '8',
        lgLength = 12,
        mdLength = 12,
        smLength = 12,
        isFocused = false,
        error = null,
        children,
        ...props
    },
    ref,
) {
    const localRef = useRef(null);
    const [isFocusedState, setIsFocusedState] = useState(isFocused);

    useImperativeHandle(ref, () => ({
        focus: () => localRef.current?.focus(),
    }));

    useEffect(() => {
        if (isFocused) {
            localRef.current?.focus();
        }
    }, [isFocused]);

    const handleFocus = () => setIsFocusedState(true);
    const handleBlur = () => setIsFocusedState(false);

    const inputClass = `form-control form-control-${size} ${
        error ? 'is-invalid' : ''
    } ${className}`;

    return (
        <div
            className={`form-group col-lg-${lgLength} col-md-${mdLength} col-sm-${smLength}`}
        >
            {children}
            <label htmlFor={id}>{label}</label>
            <textarea
                style={{
                    minHeight: "38px",
                    backgroundColor: "hsl(0, 0%, 100%)",
                    borderColor: isFocusedState ? "#2684FF" : "hsl(0, 0%, 80%)",
                    borderRadius: "4px",
                    borderStyle: "solid",
                    borderWidth: isFocusedState ? "2px" : "1px",
                }}
                maxLength="5000"
                rows={rows}
                dir="rtl"
                type={type}
                id={id}
                name={name}
                className={inputClass}
                placeholder={placeholder}
                ref={localRef}
                onFocus={handleFocus}
                onBlur={handleBlur}
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
