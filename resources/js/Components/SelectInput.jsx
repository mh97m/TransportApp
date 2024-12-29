import { forwardRef, useEffect, useImperativeHandle, useRef, useState } from 'react';

export default forwardRef(function SelectInput(
    {
        label = '',
        size = 'lg',
        lgLength = 12,
        mdLength = 12,
        smLength = 12,
        id = 'inputId',
        name = 'inputName',
        disabled = false,
        error = null,
        options = [],
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

    const selectClass = `form-control form-control-${size} text-left ${
        error ? 'is-invalid' : ''
    }`;

    return (
        <div
            className={`form-group col-lg-${lgLength} col-md-${mdLength} col-sm-${smLength}`}
        >
            {children}
            <label className="font-weight-bold text-dark text-2">{label}</label>
            <select
                style={{
                    minHeight: "38px",
                    backgroundColor: "hsl(0, 0%, 100%)",
                    borderColor: isFocusedState ? "#2684FF" : "hsl(0, 0%, 80%)",
                    borderRadius: "4px",
                    borderStyle: "solid",
                    borderWidth: isFocusedState ? "2px" : "1px",
                }}
                dir="rtl"
                id={id}
                name={name}
                className={selectClass}
                disabled={disabled}
                ref={localRef}
                onFocus={handleFocus}
                onBlur={handleBlur}
                {...props}
            >
                <option value="">انتخاب کنید</option>
                {options.length > 0 &&
                    options.map((option) => (
                        <option key={option.id} value={option.id}>
                            {option.title}
                        </option>
                    ))}
            </select>
            {error && (
                <span className="invalid-feedback" role="alert">
                    <strong>{error}</strong>
                </span>
            )}
        </div>
    );
});
